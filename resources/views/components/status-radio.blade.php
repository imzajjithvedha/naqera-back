@props(['data'])

<div class="grid mb-3 sm:mb-5">
    <label class="label">Status<span class="asterisk">*</span></label>
    <div class="flex gap-3 sm:gap-5 items-center">
        @foreach (['active' => 'Active', 'inactive' => 'Inactive', 'suspended' => 'Suspended'] as $value => $label)
            <label class="flex items-center gap-1 text-[15px] text-(--color-primary) cursor-pointer">
                <input type="radio" name="status" value="{{ $value }}"
                    {{ old('status', isset($data) ? $data->status->value : 'active') === $value ? 'checked' : '' }}
                    class="cursor-pointer accent-(--color-dark-green)" required>
                {{ $label }}
            </label>
        @endforeach
    </div>
    <x-input-error field="status" />
</div>