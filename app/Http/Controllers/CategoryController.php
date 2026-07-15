<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequests\StoreRequest;
use App\Http\Requests\CategoryRequests\UpdateRequest;
use App\Models\Category;
use App\Services\SlugService;
use App\Traits\ResponseRedirectTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseRedirectTrait;

    public function __construct(
        protected SlugService $slugService
    ) {}
    
    public function index(Request $request)
    {
        $items = Category::query()
                ->filter($request->all())
                ->latest('id')
                ->paginate(15)
                ->withQueryString();

        return view('categories.index', [
            'items' => $items,
            'filter' => $request->all()
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = $this->slugService->generateSlug(
            $validated['slug'] ?? null,
            $validated['name']
        );

        $category = Category::create($validated);

        return $this->redirectWithMessage(
            'categories.index',
            'success',
            'Category created',
            'The new category has been successfully created.'
        );
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $validated = $request->validated();

        $validated['slug'] = $this->slugService->generateSlug(
            $validated['slug'] ?? null,
            $validated['name']
        );

        $category->update($validated);

        return $this->redirectWithMessage(
            'categories.edit',
            'success',
            'Category updated',
            'The category has been successfully updated.',
            $category
        );
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->redirectWithMessage(
            'categories.index',
            'success',
            'Successfully deleted',
            'This information is removed from the system.'
        );
    }
}
