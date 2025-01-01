<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $categoriesWithPaths = $this->buildCategoryPaths($categories);

        $categoriesWithData = $categories->keyBy('categoryId')->map(function ($category) use ($categoriesWithPaths) {
            return [
                'path' => $categoriesWithPaths[$category->categoryId],
                'status' => $category->status,
                'parentId' => $category->parentId,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
            ];
        });

        return view('categories.index', compact('categoriesWithData'));
    }

    public function create()
    {
        $categories = $this->buildCategoryPaths(Category::all());
        return view('categories.create', compact('categories'));
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::where('categoryId', $id)->first();
        $categories = $this->buildCategoryPaths(Category::where('categoryId', '!=', $id)->get());
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::where('categoryId', $id)->firstOrFail();
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $parentId = $category->parentId;
        Category::where('parentId', $id)->update(['parentId' => $parentId]);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully, and its child categories were reassigned.');
    }


    private function buildCategoryPaths($categories)
    {
        $categoryMap = $categories->keyBy('categoryId');
        $paths = [];

        foreach ($categories as $category) {
            $paths[$category->categoryId] = $this->getCategoryFullPath($category, $categoryMap);
        }

        return $paths;
    }

    private function getCategoryFullPath($category, $categories, $separator = ' > ')
    {
        $path = $category->name;

        while ($category->parentId) {
            $parent = $categories->get($category->parentId);

            if (!$parent) {
                \Log::warning("Missing parent for category ID: {$category->categoryId}, Parent ID: {$category->parentId}");
                break;
            }

            $path = $parent->name . $separator . $path;
            $category = $parent;
        }

        return $path;
    }
}
