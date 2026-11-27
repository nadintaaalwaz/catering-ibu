<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicController extends Controller
{
    public function home()
    {
        return Inertia::render('Public/Home', [
            'featured' => Menu::with('category:id,name')
                ->where('is_featured', true)
                ->where('is_available', true)
                ->latest()
                ->take(6)
                ->get(),
            'categories' => Category::withCount('menus')->orderBy('sort_order')->get(),
        ]);
    }

    public function menus(Request $request)
    {
        $category = $request->query('category');
        $q = trim((string) $request->query('q', ''));

        $menus = Menu::with('category:id,name')
            ->when($category, fn ($query) => $query->whereHas(
                'category',
                fn ($c) => $c->where('slug', $category)
            ))
            ->when($q !== '', fn ($query) => $query->where('name', 'like', "%{$q}%"))
            ->orderByDesc('is_available')
            ->orderBy('name')
            ->get();

        return Inertia::render('Public/MenuIndex', [
            'menus' => $menus,
            'categories' => Category::orderBy('sort_order')->get(['id', 'name', 'slug']),
            'filters' => ['category' => $category, 'q' => $q],
        ]);
    }

    public function show(Menu $menu)
    {
        $menu->load('category:id,name,slug');

        return Inertia::render('Public/MenuShow', [
            'menu' => $menu,
            'related' => Menu::with('category:id,name')
                ->where('category_id', $menu->category_id)
                ->where('id', '!=', $menu->id)
                ->where('is_available', true)
                ->take(3)
                ->get(),
        ]);
    }

    public function contact()
    {
        return Inertia::render('Public/Contact');
    }
}