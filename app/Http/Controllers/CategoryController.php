<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['User', 'Transactions'])->get();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:50'
        ]);

        $category = Category::create([
            'category' => $request['category']
        ]);

        $category['user_id'] = Auth::user()->id;
        $category->save();

        return response()->json([
            'message' => 'La categoria fue creada correctamente'
        ]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria no existe'], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'La categoria fue eliminida correctamente'
        ]);
    }
}
