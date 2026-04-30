<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::orderBy('order')->orderBy('id')->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => ['nullable', 'string', 'max:150'],
            'subtitle' => ['nullable', 'string', 'max:300'],
            'image'    => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'order'    => ['nullable', 'integer', 'min:0'],
            'is_active'=> ['boolean'],
        ]);

        $path = $request->file('image')->store('promos', 'public');

        Promo::create([
            'title'     => $validated['title'] ?? null,
            'subtitle'  => $validated['subtitle'] ?? null,
            'image_path'=> $path,
            'order'     => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil ditambahkan.');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'title'    => ['nullable', 'string', 'max:150'],
            'subtitle' => ['nullable', 'string', 'max:300'],
            'image'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'order'    => ['nullable', 'integer', 'min:0'],
            'is_active'=> ['boolean'],
        ]);

        $data = [
            'title'     => $validated['title'] ?? null,
            'subtitle'  => $validated['subtitle'] ?? null,
            'order'     => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($promo->image_path);
            $data['image_path'] = $request->file('image')->store('promos', 'public');
        }

        $promo->update($data);

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        Storage::disk('public')->delete($promo->image_path);
        $promo->delete();

        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil dihapus.');
    }
}
