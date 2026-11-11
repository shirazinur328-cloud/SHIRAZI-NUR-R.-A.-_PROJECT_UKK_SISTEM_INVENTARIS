<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Condition;
use App\Models\InventoryHistory;
use App\Models\Item;
use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard_index()
    {
        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'user' => Auth::user(),
            'itemCount' => Item::count(),
            'categoryCount' => Category::count(),
            'conditionCount' => Condition::count(),
            'userCount' => User::count(),
            'locationCount' => Location::count(),
            'totalStock' => Item::sum('stock'),
            'lowStockCount' => Item::whereColumn('stock', '<=', 'min_stock')->count(),
            'lowStockItems' => Item::with(['category', 'location'])
                ->whereColumn('stock', '<=', 'min_stock')
                ->orderBy('stock')
                ->limit(5)
                ->get(),
            'recentHistories' => InventoryHistory::with(['item', 'user'])
                ->orderByDesc('id')
                ->limit(5)
                ->get(),
        ]);
    }
}