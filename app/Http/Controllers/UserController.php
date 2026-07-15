<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\StoreRequest;
use App\Http\Requests\UserRequests\UpdateRequest;
use App\Models\User;
use App\Services\MediaService;
use App\Traits\ResponseRedirectTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseRedirectTrait;
    
    public function __construct(
        protected MediaService $mediaService
    ) {}
    
    public function index(Request $request)
    {
        User::where('is_new', 'yes')->update(['is_new' => 'no']);

        $items = User::query()
                ->whereKeyNot(auth()->id())
                ->filter($request->all())
                ->latest('id')
                ->paginate(15)
                ->withQueryString();

        return view('users.index', [
            'items' => $items,
            'filter' => $request->all()
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $this->mediaService->upload(
            $request,
            $user,
            'image',
            User::MEDIA_COLLECTION
        );

        return $this->redirectWithMessage(
            'users.index',
            'success',
            'User created',
            'The new user has been successfully created.'
        );
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        if ($user->is(auth()->user())) {
            $validated['role']   = 'admin';
            $validated['status'] = 'active';
        }

        $this->mediaService->upload(
            $request,
            $user,
            'image',
            User::MEDIA_COLLECTION,
            replace: true
        );

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        else {
            unset($validated['password']);
        }

        $user->update($validated);

        return $this->redirectWithMessage(
            'users.edit',
            'success',
            'User updated',
            'The user has been successfully updated.',
            $user
        );
    }

    public function destroy(User $user)
    {
        if ($user->is(auth()->user())) {
            return $this->redirectWithMessage(
                'users.index',
                'error',
                'Action not allowed',
                'You cannot delete your own account.'
            );
        }

        $user->delete();

        return $this->redirectWithMessage(
            'users.index',
            'success',
            'Successfully deleted',
            'This information is removed from the system.'
        );
    }
}
