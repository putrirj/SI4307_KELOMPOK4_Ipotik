<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('medicine.index', compact('categories'));
    }

    public function category(Request $request, Category $category)
    {
        if ($request->keyword != null) {
            $keyword = $request->keyword;
            $medicines = Medicine::where('category_id', $category->id)
                ->where('name', 'like', '%' . $keyword . '%')
                ->paginate(8);
        } else {
            $keyword = "";
            $medicines = Medicine::where('category_id', $category->id)->paginate(8);
        }
        return view('medicine.category', compact('category', 'medicines', 'keyword'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('medicine.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'required|file|image|mimes:jpg,png,jpeg'
        ]);

        $medicine = new Medicine();
        $medicine->name = $validated['name'];
        $medicine->price = $validated['price'];
        $medicine->category_id = $validated['category_id'];
        $medicine->photo = $validated['photo']->store('medicines', 'public');
        $medicine->need_receipt = $request->has('need_receipt');

        if ($medicine->save()) {
            return redirect()->route('medicine.category', $validated['category_id'])
                ->with('alert_type', 'success')
                ->with('alert_message', 'Obat berhasil ditambah.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Obat gagal ditambah.');
    }

    public function show(Medicine $medicine)
    {
        return view('medicine.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        $categories = Category::all();
        return view('medicine.edit', compact('medicine', 'categories'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'file|image|mimes:jpg,png,jpeg'
        ]);

        $medicine->name = $validated['name'];
        $medicine->price = $validated['price'];
        $medicine->category_id = $validated['category_id'];
        $medicine->need_receipt = $request->has('need_receipt');

        if ($request->has('photo') && $validated['photo'] != null) {
            if (Storage::disk('public')->exists($medicine->photo)) {
                Storage::disk('public')->delete($medicine->photo);
            }
            $medicine->photo = $validated['photo']->store('medicines', 'public');
        }

        if ($medicine->save()) {
            return redirect()->route('medicine.category', $validated['category_id'])
                ->with('alert_type', 'success')
                ->with('alert_message', 'Obat berhasil diupdate.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Obat gagal diupdate.');
    }

    public function destroy(Medicine $medicine)
    {
        $category_id = $medicine->category_id;

        if (Storage::disk('public')->exists($medicine->photo)) {
            Storage::disk('public')->delete($medicine->photo);
        }

        if ($medicine->delete()) {
            return redirect()->route('medicine.category', $category_id)
                ->with('alert_type', 'success')
                ->with('alert_message', 'Obat berhasil dihapus.');
        }

        return back()
            ->with('alert_type', 'error')
            ->with('alert_message', 'Obat gagal dihapus.');
    }
}
