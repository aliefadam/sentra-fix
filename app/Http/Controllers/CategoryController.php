<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.category.index', [
            "title" => "Kategori",
            "categories" => Category::all(),
        ]);
    }

    public function create()
    {
        // Show the form for creating a new resource
    }

    public function store(Request $request)
    {
        // Store a newly created resource in storage
    }

    public function show($id)
    {
        // Display the specified resource
    }

    public function edit($id)
    {
        // Show the form for editing the specified resource
    }

    public function update(Request $request, $id)
    {
        // Update the specified resource in storage
    }

    public function destroy($id)
    {
        // Remove the specified resource from storage
    }
}
