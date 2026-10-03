<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Major;
use App\Models\NewsArticle;
use App\Models\StudentWork;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MajorPublicController extends Controller
{
    /**
     * Tampilkan halaman detail jurusan publik secara dinamis berdasarkan slug atau kode.
     */
    public function show(string $slugOrCode): View
    {
        $codeUpper = strtoupper($slugOrCode);
        $major = Major::where('slug', strtolower($slugOrCode))
            ->orWhere('code', $codeUpper)
            ->firstOrFail();

        // Data dinamis terkait jurusan
        $studentWorks = StudentWork::where('major_id', $major->id)->latest()->take(8)->get();
        if ($studentWorks->isEmpty()) {
            $studentWorks = StudentWork::latest()->take(6)->get();
        }

        $alumni = Alumni::where('major_id', $major->id)->latest()->take(6)->get();
        if ($alumni->isEmpty()) {
            $alumni = Alumni::latest()->take(6)->get();
        }

        $news = NewsArticle::where('title', 'like', "%{$major->name}%")
            ->orWhere('title', 'like', "%{$major->code}%")
            ->latest()
            ->take(3)
            ->get();

        if ($news->isEmpty()) {
            $news = NewsArticle::latest()->take(3)->get();
        }

        $viewName = 'keahlian.' . strtolower($major->code);
        if (view()->exists($viewName)) {
            return view($viewName, compact('major', 'studentWorks', 'alumni', 'news'));
        }

        return view('keahlian.show', compact('major', 'studentWorks', 'alumni', 'news'));
    }
}
