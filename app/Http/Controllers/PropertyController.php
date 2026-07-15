<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequests\StoreRequest;
use App\Http\Requests\PropertyRequests\UpdateRequest;
use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use App\Services\MediaService;
use App\Services\SlugService;
use App\Traits\ResponseRedirectTrait;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    use ResponseRedirectTrait;
    
    public function __construct(
        protected MediaService $mediaService,
        protected SlugService $slugService
    ) {}

    public function index(Request $request)
    {
        Property::where('is_new', 'yes')->update(['is_new' => 'no']);

        $items = Property::query()
                ->filter($request->all())
                ->latest('id')
                ->paginate(15)
                ->withQueryString();

        $hosts = User::whereHas('properties', function ($query) {
                            $query->status(Status::ACTIVE);
                        })
                        ->role(UserRole::HOST)
                        ->status(Status::ACTIVE)->get();

        $categories = Category::status(Status::ACTIVE)->get();

        return view('properties.index', [
            'items' => $items,
            'filter' => $request->all(),
            'hosts' => $hosts,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $hosts = User::role(UserRole::HOST)->status(Status::ACTIVE)->get();
        $categories = Category::status(Status::ACTIVE)->get();

        return view('properties.create', [
            'hosts' => $hosts,
            'categories' => $categories
        ]);
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = $this->slugService->generateSlug(
            $validated['slug'] ?? null,
            $validated['name']
        );

        $property = Property::create($validated);

        $this->mediaService->upload(
            $request,
            $property,
            'thumbnail',
            Property::MEDIA_COLLECTION
        );

        return $this->redirectWithMessage(
            'properties.index',
            'success',
            'Property created',
            'The new property has been successfully created.'
        );
    }

    public function edit(Property $property)
    {
        $hosts = User::role(UserRole::HOST)->status(Status::ACTIVE)->get();
        $categories = Category::status(Status::ACTIVE)->get();

        return view('properties.edit', [
            'property' => $property,
            'hosts' => $hosts,
            'categories' => $categories
        ]);
    }

    public function update(UpdateRequest $request, Property $property)
    {
        $validated = $request->validated();

        $validated['slug'] = $this->slugService->generateSlug(
            $validated['slug'] ?? null,
            $validated['name']
        );

        $this->mediaService->upload(
            $request,
            $property,
            'thumbnail',
            Property::MEDIA_COLLECTION,
            replace: true
        );

        $property->update($validated);

        return $this->redirectWithMessage(
            'properties.edit',
            'success',
            'Property updated',
            'The property has been successfully updated.',
            $property
        );
    }

    public function destroy(Property $property)
    {
        $property->delete();

        return $this->redirectWithMessage(
            'properties.index',
            'success',
            'Successfully deleted',
            'This information is removed from the system.'
        );
    }
}
