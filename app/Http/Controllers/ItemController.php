<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_barang', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Items/Index', [
            'items' => $items,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return Inertia::render('Items/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:50|unique:items,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:0',
            'lokasi_simpan' => 'required|string|max:255',
        ]);

        Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(Item $item)
    {
        return Inertia::render('Items/Edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:50|unique:items,kode_barang,' . $item->id,
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:0',
            'lokasi_simpan' => 'required|string|max:255',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}