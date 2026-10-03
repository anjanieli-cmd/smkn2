<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Support\AphpContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Admin khusus halaman publik jurusan APHP.
 * Untuk jurusan lain: salin file ini, ganti "Aphp" -> "Dkv" dan "APHP" -> "DKV".
 */
class AphpAdminController extends Controller
{
    private const PATH_REGEX = '/^(https?:\/\/\S+|[A-Za-z0-9_\-.\/ ()]+)$/';

    public function index(Request $request)
    {
        $major    = AphpContent::major();
        $sections = AphpContent::sections();

        $tab = $request->query('tab', 'hero');
        if (!isset($sections[$tab])) {
            $tab = 'hero';
        }

        return view('admin.aphp.index', [
            'major'    => $major,
            'tab'      => $tab,
            'sections' => $sections,
            'content'  => AphpContent::get($major),
        ]);
    }

    public function updateSection(Request $request, string $section)
    {
        $major = AphpContent::major();
        $def = AphpContent::sections()[$section] ?? null;
        abort_if($def === null, 404);

        $this->pruneBlankRows($request, $def);

        [$rules, $attributes] = $this->rulesFor($def);
        $request->validate($rules, [
            'regex'          => ':attribute berisi karakter yang tidak diizinkan.',
            'image'          => ':attribute harus berupa gambar.',
            'mimes'          => ':attribute harus berformat :values.',
            'max.file'       => ':attribute terlalu besar (maksimal :max KB).',
            'required'       => ':attribute wajib diisi.',
            'cta_btn_url.regex' => 'Link tombol harus diawali http://, https://, / atau #.',
        ], $attributes);

        $details = is_array($major->details) ? $major->details : [];
        $before  = $this->uploadedPaths($details, $def);
        $dir     = AphpContent::UPLOAD_DIR . '/' . $major->id;

        foreach ($def['blocks'] as $block) {
            if (isset($block['repeater'])) {
                $key  = $block['repeater'];
                $rows = [];
                foreach ((array) $request->input($key, []) as $i => $row) {
                    $out = [];
                    foreach ($block['fields'] as $f) {
                        $out[$f['key']] = $this->valueOf($request, $f, $row[$f['key']] ?? null, "{$key}.{$i}.{$f['key']}", $dir);
                    }
                    $rows[] = $out;
                }
                $details[$key] = $rows;
            } else {
                foreach ($block['fields'] as $f) {
                    $details[$f['key']] = $this->valueOf($request, $f, $request->input($f['key']), $f['key'], $dir);
                }
            }
        }

        $major->details = $details;
        $major->save();

        // hapus file upload yang sudah tidak dipakai
        foreach (array_diff($before, $this->uploadedPaths($details, $def)) as $path) {
            Storage::disk('public')->delete($path);
        }

        return $this->back($major, $section, 'Perubahan ' . $def['label'] . ' disimpan.');
    }

    /* ===================== HELPERS ===================== */

    /** Baris repeater yang semua kolom teks/gambarnya kosong dibuang sebelum validasi. */
    private function pruneBlankRows(Request $request, array $def): void
    {
        foreach ($def['blocks'] as $block) {
            if (!isset($block['repeater'])) {
                continue;
            }
            $key  = $block['repeater'];
            $rows = (array) $request->input($key, []);

            foreach ($rows as $i => $row) {
                $filled = false;
                foreach ($block['fields'] as $f) {
                    if (in_array($f['type'], ['text', 'textarea', 'image', 'video'], true)) {
                        if (trim((string) ($row[$f['key']] ?? '')) !== '') {
                            $filled = true;
                        }
                        if (in_array($f['type'], ['image', 'video'], true) && $request->hasFile("{$key}.{$i}.{$f['key']}_file")) {
                            $filled = true;
                        }
                    }
                }
                if (!$filled) {
                    unset($rows[$i]);
                }
            }

            $request->merge([$key => $rows]);
        }
    }

    private function rulesFor(array $def): array
    {
        $rules = [];
        $attrs = [];

        foreach ($def['blocks'] as $block) {
            if (isset($block['repeater'])) {
                $r = $block['repeater'];
                $rules[$r] = ['nullable', 'array', 'max:' . ($block['max'] ?? 20)];
                foreach ($block['fields'] as $f) {
                    $this->addFieldRules($rules, $attrs, "{$r}.*.{$f['key']}", $f, $block['title']);
                }
            } else {
                foreach ($block['fields'] as $f) {
                    $this->addFieldRules($rules, $attrs, $f['key'], $f, $block['title']);
                }
            }
        }

        return [$rules, $attrs];
    }

    private function addFieldRules(array &$rules, array &$attrs, string $name, array $f, string $blockTitle): void
    {
        $presence = $f['required'] ? 'required' : 'nullable';
        $attrs[$name] = "{$f['label']} ({$blockTitle})";

        switch ($f['type']) {
            case 'check':
                $rules[$name] = ['nullable', 'boolean'];
                break;

            case 'icon':
                $rules[$name] = ['nullable', 'string', 'max:60', 'regex:/^fa-[a-z0-9-]+$/'];
                break;

            case 'tone':
                $rules[$name] = ['nullable', 'in:green,gold,blue'];
                break;

            case 'select':
                $rules[$name] = ['nullable', Rule::in(array_keys($f['options']))];
                break;

            case 'image':
            case 'video':
                $rules[$name] = ['nullable', 'string', 'max:255', 'regex:' . self::PATH_REGEX, 'not_regex:/\.\./'];
                $rules[$name . '_file'] = $f['type'] === 'image'
                    ? ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096']
                    : ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:51200'];
                $attrs[$name . '_file'] = $f['label'] . ' (file upload)';
                break;

            default: // text, textarea
                $rules[$name] = [$presence, 'string', 'max:' . $f['max']];
                if ($f['key'] === 'cta_btn_url') {
                    $rules[$name][] = 'regex:/^(https?:\/\/|\/|#).*/i';
                }
        }
    }

    private function valueOf(Request $request, array $f, mixed $raw, string $dotKey, string $dir): mixed
    {
        switch ($f['type']) {
            case 'check':
                return filter_var($raw, FILTER_VALIDATE_BOOLEAN);

            case 'image':
            case 'video':
                $file = $request->file($dotKey . '_file');
                if ($file) {
                    return $file->store($dir, 'public');
                }

                return trim((string) $raw);

            default:
                return trim((string) $raw);
        }
    }

    /** Semua path file hasil upload yang sedang dipakai oleh section ini. */
    private function uploadedPaths(array $details, array $def): array
    {
        $paths = [];

        foreach ($def['blocks'] as $block) {
            $media = array_filter($block['fields'], fn ($f) => in_array($f['type'], ['image', 'video'], true));
            if (!$media) {
                continue;
            }

            if (isset($block['repeater'])) {
                foreach ((array) ($details[$block['repeater']] ?? []) as $row) {
                    foreach ($media as $f) {
                        $v = $row[$f['key']] ?? null;
                        if (AphpContent::isUploaded($v)) {
                            $paths[] = $v;
                        }
                    }
                }
            } else {
                foreach ($media as $f) {
                    $v = $details[$f['key']] ?? null;
                    if (AphpContent::isUploaded($v)) {
                        $paths[] = $v;
                    }
                }
            }
        }

        return array_values(array_unique($paths));
    }

    private function back(Major $major, string $tab, string $message)
    {
        return redirect()->route('admin.aphp.index', ['tab' => $tab])->with('status', $message);
    }
}
