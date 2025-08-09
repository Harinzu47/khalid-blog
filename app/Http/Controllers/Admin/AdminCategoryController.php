<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'color' => 'nullable|string|max:50', // Tambahkan validasi untuk color
        ]);

        $validatedData['slug'] = Str::slug($request->name); // Buat slug dari nama

        Category::create($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($category->id), 'max:255'],
            'color' => 'nullable|string|max:50', // Tambahkan validasi untuk color
        ]);

        // Cek jika nama berubah, maka perbarui juga slug-nya.
        if ($request->name != $category->name) {
            $validatedData['slug'] = Str::slug($request->name);
        }

        $category->update($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
