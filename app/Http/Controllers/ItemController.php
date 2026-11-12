<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Condition;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function item_data(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category');
        $status = $request->query('status');

        $items = Item::with(['category', 'location', 'condition'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->when($status === 'low', fn ($q) => $q->whereColumn('stock', '<=', 'min_stock'))
            ->orderBy('name')
            ->paginate(7)
            ->withQueryString();

        return view('pages.items.index', [
            'title' => 'Daftar Barang',
            'items' => $items,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function item_detail(Item $item)
    {
        $item->load(['category', 'location', 'condition']);
        $item->loadCount(['stockIns', 'stockOuts', 'histories']);

        return view('pages.items.detail', [
            'title' => 'Detail Barang',
            'item' => $item,
        ]);
    }

    public function item_add(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate($this->rules());

            $validated['stock'] = 0;

            Item::create($validated);

            return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
        }

        return view('pages.items.form', [
            'title' => 'Tambah Barang',
            'item' => null,
            'categories' => Category::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
            'conditions' => Condition::orderBy('name')->get(),
        ]);
    }

    public function item_edit(Request $request, Item $item)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate($this->rules($item));

            // stok hanya berubah lewat transaksi masuk/keluar
            unset($validated['stock']);

            $item->update($validated);

            return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
        }

        return view('pages.items.form', [
            'title' => 'Edit Barang',
            'item' => $item,
            'categories' => Category::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
            'conditions' => Condition::orderBy('name')->get(),
        ]);
    }

    public function item_delete(Item $item)
    {
        if ($item->stockIns()->exists() || $item->stockOuts()->exists() || $item->histories()->exists()) {
            return back()->with('error', 'Barang tidak dapat dihapus karena sudah memiliki transaksi/riwayat stok.');
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }

    private function rules(?Item $item = null): array
    {
        return [
            'code' => ['required', 'string', 'max:80', 'unique:items,code' . ($item ? ',' . $item->id : '')],
            'name' => ['required', 'string', 'max:150'],
            'category_id' => ['required', 'exists:categories,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'condition_id' => ['required', 'exists:conditions,id'],
            'unit' => ['nullable', 'string', 'max:50'],
            'min_stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }
}
