<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function condition_data(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter');

        $conditions = Condition::withCount('items')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filter === 'with_items', fn ($q) => $q->having('items_count', '>', 0))
            ->when($filter === 'without_items', fn ($q) => $q->having('items_count', '=', 0))
            ->orderBy('name')
            ->paginate(7)
            ->withQueryString();

        return view('pages.conditions.index', [
            'title' => 'Kondisi Barang',
            'conditions' => $conditions,
        ]);
    }

    public function condition_detail(Condition $condition)
    {
        $condition->loadCount('items');

        return view('pages.conditions.detail', [
            'title' => 'Detail Kondisi',
            'condition' => $condition,
        ]);
    }

    public function condition_add(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:100', 'unique:conditions,name'],
                'description' => ['nullable', 'string'],
            ]);

            Condition::create($validated);

            return redirect()->route('conditions.index')->with('success', 'Kondisi berhasil ditambahkan.');
        }

        return view('pages.conditions.form', [
            'title' => 'Tambah Kondisi',
            'condition' => null,
        ]);
    }

    public function condition_edit(Request $request, Condition $condition)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:100', 'unique:conditions,name,' . $condition->id],
                'description' => ['nullable', 'string'],
            ]);

            $condition->update($validated);

            return redirect()->route('conditions.index')->with('success', 'Kondisi berhasil diperbarui.');
        }

        return view('pages.conditions.form', [
            'title' => 'Edit Kondisi',
            'condition' => $condition,
        ]);
    }

    public function condition_delete(Condition $condition)
    {
        if ($condition->items()->exists()) {
            return back()->with('error', 'Kondisi tidak dapat dihapus karena masih dipakai oleh data barang.');
        }

        $condition->delete();

        return redirect()->route('conditions.index')->with('success', 'Kondisi berhasil dihapus.');
    }
}
