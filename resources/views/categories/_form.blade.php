@php
    $is_edit = isset($category);
@endphp

<div class="back-top">
    <div>
        <p class="back-title">{{ $is_edit ? 'Edit Category' : 'Add New Category' }}</p>
        <p class="back-description">
            {{ $is_edit ? 'Update the details below and save changes.' : 'Fill in the details below to create a new category.' }}
        </p>
    </div>
    <a href="{{ route('categories.index') }}" class="back-back-button">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Categories</span>
    </a>
</div>

<div class="back-form">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-5 mb-3 sm:mb-5">
        <div class="grid">
            <label class="label">Name<span class="asterisk">*</span></label>
            <input type="text" name="name" class="input" placeholder="Name" value="{{ old('name', $is_edit ? $category->name : '') }}" required>
            <x-input-error field="name" />
        </div>

        <div class="grid">
            <div class="flex gap-1.5">
                <label for="slug" class="label">Slug</label>

                <div class="group relative flex justify-center">
                    <i class="bi bi-info-circle cursor-pointer text-sm text-(--color-bg-button) relative -top-1.25"></i>
                    
                    <span class="absolute left-full ml-2 top-1/2 -translate-y-1/2 scale-0 rounded bg-(--color-primary) p-3 w-75 text-sm text-white transition-all group-hover:scale-100 z-50">
                        You can add a custom unique slug, or leave this field empty to allow the platform to automatically generate one for your category.
                    </span>
                </div>
            </div>
            
            <input type="text" class="input" id="slug" name="slug" placeholder="Slug" value="{{ old('slug', $is_edit ? $category->slug : '') }}">
            <x-input-error field="slug"></x-input-error>
        </div>
    </div>

    <x-status-radio :data="$is_edit ? $category : null" />

    <button type="submit" class="submit-button">Save Changes</button>
</div>