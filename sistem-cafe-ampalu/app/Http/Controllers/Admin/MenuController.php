<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index() {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function create() {
        return view('admin.menu.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required', 'price' => 'required|numeric', 'category' => 'required', 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048']);
        $data = $request->all();
        if ($request->hasFile('image')) {
            // (DIPERBARUI) Simpan ke disk 'menu_images'
            $path = $request->file('image')->store('', 'menu_images');
            $data['image'] = $path;
        }
        Menu::create($data);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu) {
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu) {
        $request->validate(['name' => 'required', 'price' => 'required|numeric', 'category' => 'required', 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048']);
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($menu->image) {
                // (DIPERBARUI) Hapus dari disk 'menu_images'
                Storage::disk('menu_images')->delete($menu->image);
            }
            // (DIPERBARUI) Simpan gambar baru ke disk 'menu_images'
            $path = $request->file('image')->store('', 'menu_images');
            $data['image'] = $path;
        }
        $menu->update($data);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu) {
        if ($menu->image) {
            // (DIPERBARUI) Hapus dari disk 'menu_images'
            Storage::disk('menu_images')->delete($menu->image);
        }
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}