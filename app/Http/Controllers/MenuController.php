<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        return view('Admin.pages.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        Menu::create($request->all());

        return redirect()->back()->with('success', 'Menu added successfully!');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $menu->update($request->all());

        return redirect()->back()->with('success', 'Menu updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->back()->with('success', 'Menu deleted successfully!');
    }
}
