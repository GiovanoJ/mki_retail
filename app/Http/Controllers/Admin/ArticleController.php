<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::notDeleted()
            ->latest()
            ->get();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'sinopsis'  => 'required|string|max:500',
            'content'   => 'required|string',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('articles/thumbnails', 'public');
        }

        Article::create($validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    public function edit(Article $article)
    {
        abort_if($article->deleted_status, 404);

        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        abort_if($article->deleted_status, 404);

        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'sinopsis'  => 'required|string|max:500',
            'content'   => 'required|string',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('articles/thumbnails', 'public');
        }

        $article->update($validated);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->update(['deleted_status' => true]);

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    // ── CKEditor image upload ────────────────────────────────────────────────
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('articles/content', 'public');

            return response()->json([
                'uploaded' => true,
                'url'      => asset('storage/' . $path),
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error'    => ['message' => 'Gagal mengunggah file.'],
        ]);
    }

    public function removeImage(Request $request)
    {
        $request->validate(['image_url' => 'required|string']);

        $imagePath    = parse_url($request->image_url, PHP_URL_PATH);
        $relativePath = ltrim(str_replace('/storage/', '', $imagePath), '/');
        $filePath     = storage_path('app/public/' . $relativePath);

        if (file_exists($filePath)) {
            unlink($filePath);
            return response()->json(['message' => 'Gambar berhasil dihapus.']);
        }

        return response()->json(['error' => 'Gambar tidak ditemukan.'], 400);
    }
}
