<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function location_index(Request $request)
    {
        $search = $request->query('search');
        $filter = $request->query('filter');

        $locations = Location::withCount('items')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orwhere('name', 'like', "%{$search}%")
                        ->orwhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filter === 'with_items', fn ($q) => $q->having('items_count', '>', 0))
            ->when($filter === 'without_items', fn ($q) => $q->having('items_count', '>', 0))
            ->orderBy('code')
            ->paginate(7)
            ->withQueryString();

        return view('pages.locations.index', [
            'title' => 'Lokasi Barang',
            'locations' => $locations,
        ]);
    }

    public function location_detail(Location $location)
    {
        $location->loadCount('items');

        return view('pages.locations.detail', [
            'title' => 'Detail Lokasi',
            'location' => $location,
        ]);
    }

    public function location_add(Request $request)
    {
        if($request->isMethod('post')) {
            $validated = $request->validate([
                'code' => ['required', 'string', 'max:80', 'unique:locations,code'],
                'name' => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
            ]);
            Category::create($validated);
            return redirect()->route('locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
        }

        return viev('pages.locations.form', [
            'title' => 'Tambah Lokasi',
            'location' => $location,
        ]);
    }

    public function 
}
