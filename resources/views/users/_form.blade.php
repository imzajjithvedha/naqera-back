@php
    $is_edit = isset($user);
@endphp

<div class="back-top">
    <div>
        <p class="back-title">{{ $is_edit ? 'Edit User' : 'Add New User' }}</p>
        <p class="back-description">{{ $is_edit ? 'Update the details below and save changes.' : 'Fill in the details below to create a new user.' }}</p>
    </div>
    <a href="{{ route('users.index') }}" class="back-back-button">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Users</span>
    </a>
</div>

<div class="back-form">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-5 mb-3 sm:mb-5">
        <div class="grid">
            <label class="label">Name<span class="asterisk">*</span></label>
            <input type="text" name="name" class="input" placeholder="Name" value="{{ old('name', $is_edit ? $user->name : '') }}" required>
            <x-input-error field="name" />
        </div>

        <div class="grid">
            <label class="label">Email<span class="asterisk">*</span></label>
            <input type="email" name="email" class="input" placeholder="Email" value="{{ old('email', $is_edit ? $user->email : '') }}" required>
            <x-input-error field="email" />
        </div>

        <div class="grid">
            <label class="label">Role<span class="asterisk">*</span></label>
            <select name="role" class="input" required>
                @unless ($is_edit)
                    <option value="">- Select role -</option>
                @endunless
                <option value="admin" {{ old('role', $is_edit ? $user->role->value : '') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="host" {{ old('role', $is_edit ? $user->role->value : '') === 'host' ? 'selected' : '' }}>Host</option>
                <option value="agent" {{ old('role', $is_edit ? $user->role->value : '') === 'agent' ? 'selected' : '' }}>Agent</option>
                <option value="estate-host" {{ old('role', $is_edit ? $user->role->value : '') === 'estate-host' ? 'selected' : '' }}>Estate Host</option>
                <option value="customer" {{ old('role', $is_edit ? $user->role->value : '') === 'customer' ? 'selected' : '' }}>Customer
                </option>
            </select>
            <x-input-error field="role" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-5 mb-3 sm:mb-5">
        <div class="grid relative">
            <label class="label">
                @if ($is_edit)
                    Password
                @else
                    Password<span class="asterisk">*</span>
                @endif

                @if ($is_edit)
                    <span class="text-sm font-normal text-(--color-dark-green) ms-1">(leave blank to keep current)</span>
                @endif
            </label>

            <input type="password" class="input" id="password" name="password" placeholder="Enter your password" {{ $is_edit ? '' : 'required' }}>
            <span class="bi bi-eye-slash-fill toggle-password"></span>
            <x-input-error field="password"></x-input-error>
        </div>

        <div class="grid relative">
            <label class="label">
                Confirm Password
                @unless ($is_edit)
                    <span class="asterisk">*</span>
                @endunless
            </label>

            <input type="password" name="password_confirmation" class="input" placeholder="Confirm password" {{ $is_edit ? '' : 'required' }}>
            <span class="bi bi-eye-slash-fill toggle-password"></span>
            <x-input-error field="password_confirmation"></x-input-error>
        </div>
    </div>

    <div class="grid mb-3 sm:mb-5">
        <label class="label">Image</label>

        @if($is_edit)
            @if($user->hasMedia('backend/users'))
                <div class="mb-2">
                    <img src="{{ $user->getFirstMediaUrl('backend/users', 'webp') }}" alt="Image" class="back-form-image">
                </div>
            @endif
        @endif

        <input type="file" name="image" class="back-file-input">

        <x-input-error field="image"></x-input-error>
    </div>

    <x-status-radio :data="$is_edit ? $user : null" />

    <button type="submit" class="submit-button">Save Changes</button>
</div>