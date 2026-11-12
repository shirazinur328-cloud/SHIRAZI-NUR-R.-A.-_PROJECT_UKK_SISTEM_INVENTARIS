<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_index(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter');

        $categories = Category::withCount('items')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filter === 'with_items', fn ($q) => $q->having('items_count', '>', 0))
            ->when($filter === 'without_items', fn ($q) => $q->having('items_count', '=', 0))
            ->orderBy('name')
            ->paginate(7)
            ->withQueryString();

        return view('pages.categories.index', [
            'title' => 'Kategori Barang',
            'categories' => $categories,
        ]);
    }

    public function category_detail(Category $category)
    {
        $category->loadCount('items');

        return view('pages.categories.detail', [
            'title' => 'Detail Kategori',
            'category' => $category,
        ]);
    }

    public function category_add(Request $request)
    {
        if($request->isMethod('post')) {
            $validated = $request->validate([
                'code' => ['required', 'string', 'max:80', 'unique:categories,code'],
                'name' => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
            ]);
            Category::create($validated);
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
        }

        return view('pages.categories.form', [
            'title' => 'Tambah Kategori',
            'category' => null,
        ]);
    }

    public function category_edit(Request $request, Category $category)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'code' => ['required', 'string', 'max:50', 'unique:categories,code,' . $category->id],
                'name' => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
            ]);

            $category->update($validated);

            return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
        }

        return view('pages.categories.form', [
            'title' => 'Edit Kategori',
            'category' => $category,
        ]);
    }

    public function category_delete(Category $category)
    {
        if ($category->items()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih dipakai oleh data barang.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

}
