@php
    $is_edit = isset($property);
@endphp

<div class="back-top">
    <div>
        <p class="back-title">{{ $is_edit ? 'Edit Property' : 'Add New Property' }}</p>
        <p class="back-description">
            {{ $is_edit ? 'Update the details below and save changes.' : 'Fill in the details below to create a new property.' }}
        </p>
    </div>
    <a href="{{ route('properties.index') }}" class="back-back-button">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Properties</span>
    </a>
</div>

<div class="back-form">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-5 mb-3 sm:mb-5">
        <div class="grid">
            <label class="label">Host<span class="asterisk">*</span></label>
            
            <select name="user_id" class="se-select input" required>
                <option value="">- Select a host -</option>
                @foreach ($hosts as $host)
                    <option value="{{ $host->id }}" {{ old('user_id', $is_edit ? $property->user_id : '') == $host->id ? 'selected' : '' }}>{{ $host->name }}</option>
                @endforeach
            </select>

            <x-input-error field="user_id" />
        </div>

        <div class="grid">
            <label class="label">Category<span class="asterisk">*</span></label>
            
            <select name="category_id" class="se-select input" required>
                <option value="">- Select a category -</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $is_edit ? $property->category_id : '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            <x-input-error field="category_id" />
        </div>

        <div class="grid">
            <label class="label">Name<span class="asterisk">*</span></label>
            <input type="text" name="name" class="input" placeholder="Name" value="{{ old('name', $is_edit ? $property->name : '') }}" required>
            <x-input-error field="name" />
        </div>

        <div class="grid">
            <div class="flex gap-1.5">
                <label for="slug" class="label">Slug</label>

                <div class="group relative flex justify-center">
                    <i class="bi bi-info-circle cursor-pointer text-sm text-(--color-bg-button) relative -top-1.25"></i>
                    
                    <span class="absolute left-full ml-2 top-1/2 -translate-y-1/2 scale-0 rounded bg-(--color-primary) p-3 w-75 text-sm text-white transition-all group-hover:scale-100 z-50">
                        You can add a custom unique slug, or leave this field empty to allow the platform to automatically generate one for your property.
                    </span>
                </div>
            </div>
            
            <input type="text" class="input" id="slug" name="slug" placeholder="Slug" value="{{ old('slug', $is_edit ? $property->slug : '') }}">
            <x-input-error field="slug"></x-input-error>
        </div>

        <div class="grid">
            <label class="label">Address<span class="asterisk">*</span></label>
            <input type="text" name="address" class="input" placeholder="Address" value="{{ old('address', $is_edit ? $property->address : '') }}" required>
            <x-input-error field="address" />
        </div>

        <div class="grid">
            <label class="label">City<span class="asterisk">*</span></label>
            <input type="text" name="city" class="input" placeholder="City" value="{{ old('city', $is_edit ? $property->city : '') }}" required>
            <x-input-error field="city" />
        </div>

        <div class="grid">
            <label class="label">Country<span class="asterisk">*</span></label>
            <select name="country" class="input" required>
                <x-countries :data="old('country', $is_edit ? $property->country : '')" />
            </select>
            <x-input-error field="country" />
        </div>

        <div class="grid">
            <label class="label">Price<span class="asterisk">*</span></label>
            <input type="number" name="price" class="input" placeholder="Price" value="{{ old('price', $is_edit ? $property->price : '') }}" step="0.01" min="0" required>
            <x-input-error field="price" />
        </div>
    </div>

    <div class="grid mb-3 sm:mb-5">
        <label class="label">Thumbnail</label>

        @if($is_edit)
            @if($property->hasMedia('backend/properties'))
                <div class="mb-2">
                    <img src="{{ $property->getFirstMediaUrl('backend/properties', 'webp') }}" alt="Image" class="back-form-image">
                </div>
            @endif
        @endif

        <input type="file" name="thumbnail" class="back-file-input">
    </div>

    <x-status-radio :data="$is_edit ? $property : null" />

    <button type="submit" class="submit-button">Save Changes</button>
</div>

@push('after-scripts')
    @vite(['resources/js/tom.js'])
@endpush