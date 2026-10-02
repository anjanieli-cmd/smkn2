<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeritaArticle;
use App\Models\BeritaCategory;
use App\Models\BeritaPlacement;
use App\Models\BeritaSetting;
use App\Models\BeritaStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaAdminController extends Controller
{
    private const TABS = [
        'artikel'     => ['Daftar Berita', 'fa-newspaper'],
        'penempatan'  => ['Penempatan', 'fa-table-cells'],
        'cerita'      => ['Cerita Skaneda', 'fa-book-open'],
        'kategori'    => ['Kategori', 'fa-tags'],
        'teks'        => ['Teks Halaman', 'fa-pen-to-square'],
    ];

    private const SETTINGS_FIELDS = [
        'hero_kicker' => false, 'hero_title_1' => true, 'hero_title_2' => true,
        'hero_pill_1' => false, 'hero_pill_2' => false, 'hero_pill_3' => false,
        'strip_label' => true, 'strip_text' => false,
        'cta_title' => true, 'cta_title_gold' => false, 'cta_text' => false,
        'cta_btn_text' => true, 'cta_btn_url' => false, 'cta_note' => false,
    ];

    public function index(Request $request)
    {
        $tab = $request->query('tab', 'artikel');
        if (!array_key_exists($tab, self::TABS)) {
            $tab = 'artikel';
        }

        $categories = BeritaCategory::orderBy('order')->orderBy('id')->get();
        $articles = BeritaArticle::ordered()->get();

        $placements = BeritaPlacement::orderBy('slot')->orderBy('position')->get()
            ->groupBy('slot')
            ->map(fn ($rows) => $rows->pluck('article_id', 'position'));

        return view('admin.berita.index', [
            'tabs'       => self::TABS,
            'tab'        => $tab,
            's'          => BeritaSetting::allValues(),
            'articles'   => $articles,
            'categories' => $categories,
            'placements' => $placements,
            'stories'    => BeritaStory::ordered()->get(),
        ]);
    }

    /* ===================== TEKS ===================== */

    public function updateSettings(Request $request)
    {
        $rules = [];
        foreach (self::SETTINGS_FIELDS as $key => $required) {
            $rules[$key] = [$required ? 'required' : 'nullable', 'string', 'max:2000'];
        }
        $rules['cta_btn_url'] = ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/|#).*/i'];

        $data = $request->validate($rules, [
            'cta_btn_url.regex' => 'Link tombol harus diawali http://, https://, / atau #.',
        ]);

        BeritaSetting::putMany(array_map(fn ($v) => (string) $v, $data));

        return $this->back('teks', 'Perubahan berhasil disimpan.');
    }

    /* ===================== ARTIKEL ===================== */

    public function storeArticle(Request $request)
    {
        $data = $this->validateArticle($request);

        $data['order'] = ((int) BeritaArticle::max('order')) + 1;
        $data['photo'] = $request->hasFile('photo') ? $request->file('photo')->store('berita', 'public') : null;

        BeritaArticle::create($data);

        return $this->back('artikel', 'Berita berhasil ditambahkan.');
    }

    public function updateArticle(Request $request, BeritaArticle $article)
    {
        $data = $this->validateArticle($request);

        if ($request->hasFile('photo')) {
            $this->deletePhoto($article->photo);
            $data['photo'] = $request->file('photo')->store('berita', 'public');
        } elseif ($request->boolean('remove_photo')) {
            $this->deletePhoto($article->photo);
            $data['photo'] = null;
        }

        $article->update($data);

        return $this->back('artikel', 'Berita berhasil diperbarui.');
    }

    public function destroyArticle(BeritaArticle $article)
    {
        $this->deletePhoto($article->photo);
        BeritaPlacement::where('article_id', $article->id)->delete();
        $article->delete();

        return $this->back('artikel', 'Berita berhasil dihapus beserta penempatannya.');
    }

    public function toggleArticle(BeritaArticle $article)
    {
        $article->update(['is_active' => !$article->is_active]);

        return $this->back('artikel', $article->is_active ? 'Berita ditampilkan.' : 'Berita disembunyikan dari halaman publik.');
    }

    public function moveArticle(BeritaArticle $article, string $direction)
    {
        $list = BeritaArticle::ordered()->get()->values();
        $i = $list->search(fn ($x) => $x->id === $article->id);
        $j = $direction === 'up' ? $i - 1 : $i + 1;

        if ($i !== false && isset($list[$j])) {
            $tmp = $list[$i];
            $list[$i] = $list[$j];
            $list[$j] = $tmp;

            foreach ($list as $idx => $row) {
                if ($row->order !== $idx) {
                    $row->update(['order' => $idx]);
                }
            }
        }

        return redirect()->route('admin.berita.index', ['tab' => 'artikel']);
    }

    /* ===================== PENEMPATAN ===================== */

    public function updatePlacements(Request $request)
    {
        $data = $request->validate([
            'featured'   => ['nullable', 'array', 'max:1'],
            'featured.*' => ['nullable', 'exists:berita_articles,id'],
            'side'       => ['nullable', 'array', 'max:4'],
            'side.*'     => ['nullable', 'exists:berita_articles,id'],
            'most_read'  => ['nullable', 'array', 'max:5'],
            'most_read.*'=> ['nullable', 'exists:berita_articles,id'],
        ]);

        foreach (['featured', 'side', 'most_read'] as $slot) {
            BeritaPlacement::where('slot', $slot)->delete();

            foreach (($data[$slot] ?? []) as $position => $articleId) {
                if (!$articleId) {
                    continue;
                }
                BeritaPlacement::create([
                    'slot'       => $slot,
                    'position'   => $position,
                    'article_id' => $articleId,
                ]);
            }
        }

        return $this->back('penempatan', 'Penempatan berhasil disimpan.');
    }

    /* ===================== CERITA SKANEDA ===================== */

    public function storeStory(Request $request)
    {
        $data = $this->validateStory($request);
        $data['order'] = ((int) BeritaStory::max('order')) + 1;
        BeritaStory::create($data);

        return $this->back('cerita', 'Cerita berhasil ditambahkan.');
    }

    public function updateStory(Request $request, BeritaStory $story)
    {
        $story->update($this->validateStory($request));

        return $this->back('cerita', 'Cerita berhasil diperbarui.');
    }

    public function destroyStory(BeritaStory $story)
    {
        $story->delete();

        return $this->back('cerita', 'Cerita berhasil dihapus.');
    }

    public function toggleStory(BeritaStory $story)
    {
        $story->update(['is_active' => !$story->is_active]);

        return $this->back('cerita', $story->is_active ? 'Cerita ditampilkan.' : 'Cerita disembunyikan dari halaman publik.');
    }

    public function moveStory(BeritaStory $story, string $direction)
    {
        $list = BeritaStory::ordered()->get()->values();
        $i = $list->search(fn ($x) => $x->id === $story->id);
        $j = $direction === 'up' ? $i - 1 : $i + 1;

        if ($i !== false && isset($list[$j])) {
            $tmp = $list[$i];
            $list[$i] = $list[$j];
            $list[$j] = $tmp;

            foreach ($list as $idx => $row) {
                if ($row->order !== $idx) {
                    $row->update(['order' => $idx]);
                }
            }
        }

        return redirect()->route('admin.berita.index', ['tab' => 'cerita']);
    }

    /* ===================== KATEGORI ===================== */

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:60'],
            'color' => ['required', 'string', 'in:' . implode(',', BeritaCategory::COLORS)],
            'icon'  => ['nullable', 'string', 'max:60', 'regex:/^fa-[a-z0-9-]+$/'],
        ]);

        $base = Str::slug($data['label']) ?: 'kategori';
        $key = $base;
        $n = 2;
        while (BeritaCategory::where('key', $key)->exists()) {
            $key = $base . '-' . $n++;
        }

        BeritaCategory::create([
            'key'   => $key,
            'label' => $data['label'],
            'color' => $data['color'],
            'icon'  => $data['icon'] ?: 'fa-newspaper',
            'order' => ((int) BeritaCategory::max('order')) + 1,
        ]);

        return $this->back('kategori', 'Kategori berhasil ditambahkan.');
    }

    public function updateCategory(Request $request, BeritaCategory $category)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:60'],
            'color' => ['required', 'string', 'in:' . implode(',', BeritaCategory::COLORS)],
            'icon'  => ['nullable', 'string', 'max:60', 'regex:/^fa-[a-z0-9-]+$/'],
        ]);

        $category->update(['label' => $data['label'], 'color' => $data['color'], 'icon' => $data['icon'] ?: 'fa-newspaper']);

        return $this->back('kategori', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory(BeritaCategory $category)
    {
        BeritaArticle::where('category_key', $category->key)->update(['category_key' => null]);
        BeritaStory::where('category_key', $category->key)->update(['category_key' => null]);
        $category->delete();

        return $this->back('kategori', 'Kategori dihapus. Berita yang memakainya kini tanpa kategori.');
    }

    public function moveCategory(BeritaCategory $category, string $direction)
    {
        $list = BeritaCategory::orderBy('order')->orderBy('id')->get()->values();
        $i = $list->search(fn ($x) => $x->id === $category->id);
        $j = $direction === 'up' ? $i - 1 : $i + 1;

        if ($i !== false && isset($list[$j])) {
            $tmp = $list[$i];
            $list[$i] = $list[$j];
            $list[$j] = $tmp;

            foreach ($list as $idx => $row) {
                if ($row->order !== $idx) {
                    $row->update(['order' => $idx]);
                }
            }
        }

        return redirect()->route('admin.berita.index', ['tab' => 'kategori']);
    }

    /* ===================== HELPERS ===================== */

    private function validateArticle(Request $request): array
    {
        $data = $request->validate([
            'title'                => ['required', 'string', 'max:255'],
            'category_key'         => ['nullable', 'string', 'exists:berita_categories,key'],
            'date_label'           => ['nullable', 'string', 'max:120'],
            'excerpt'              => ['nullable', 'string', 'max:1000'],
            'content'              => ['nullable', 'string', 'max:8000'],
            'photo'                => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_photo'         => ['nullable', 'boolean'],
            'show_in_initial_ten'  => ['nullable', 'boolean'],
            'is_active'            => ['nullable', 'boolean'],
        ], [
            'photo.image' => 'File foto harus berupa gambar.',
            'photo.mimes' => 'Foto harus berformat JPG, PNG, atau WEBP.',
            'photo.max'   => 'Ukuran foto maksimal 4 MB.',
        ]);

        $data['show_in_initial_ten'] = $request->boolean('show_in_initial_ten');
        $data['is_active'] = $request->boolean('is_active');
        unset($data['photo'], $data['remove_photo']);

        return $data;
    }

    private function validateStory(Request $request): array
    {
        $data = $request->validate([
            'category_key' => ['nullable', 'string', 'exists:berita_categories,key'],
            'title'        => ['required', 'string', 'max:255'],
            'teaser'       => ['nullable', 'string', 'max:500'],
            'content'      => ['nullable', 'string', 'max:6000'],
            'is_active'    => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function deletePhoto(?string $path): void
    {
        if ($path && !str_starts_with($path, 'images/')) {
            Storage::disk('public')->delete($path);
        }
    }

    private function back(string $tab, string $message)
    {
        return redirect()->route('admin.berita.index', ['tab' => $tab])->with('status', $message);
    }
}
