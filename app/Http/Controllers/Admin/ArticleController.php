<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
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

        // Generate a unique slug (handles duplicates automatically)
        $validated['slug'] = Article::generateUniqueSlug($validated['title']);

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

        // Only regenerate slug if title changed, and keep it unique
        if ($validated['title'] !== $article->title) {
            $validated['slug'] = Article::generateUniqueSlug($validated['title'], $article->id);
        } else {
            $validated['slug'] = $article->slug;
        }

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

    /**
     * Remove an image uploaded via CKEditor.
     *
     * SECURITY FIX: Instead of accepting a full URL and resolving it to a
     * filesystem path (path-traversal risk), we now accept only the relative
     * storage path that was returned by uploadImage(). We then verify the path
     * is confined to the 'articles/content' directory before deleting.
     */
    public function removeImage(Request $request)
    {
        $request->validate([
            'image_path' => ['required', 'string', 'max:500'],
        ]);

        $relativePath = ltrim($request->input('image_path'), '/');

        // Restrict deletion to the articles/content directory only
        if (! str_starts_with($relativePath, 'articles/content/')) {
            return response()->json(['error' => 'Akses ditolak.'], 403);
        }

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
            return response()->json(['message' => 'Gambar berhasil dihapus.']);
        }

        return response()->json(['error' => 'Gambar tidak ditemukan.'], 404);
    }
}
