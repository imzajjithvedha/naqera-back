@forelse($items as $item)
    <tr>
        <td>
            @if($item->hasMedia('backend/properties'))
                <img src="{{ $item->getFirstMediaUrl('backend/properties', 'thumb') }}" alt="Image" class="back-table-image">
            @else
                <img src="{{ asset('storage/global/no-image.webp') }}" alt="Image" class="back-table-image">
            @endif
        </td>
        <td class="max-w-50 truncate" title="{{ $item->name }}">{{ $item->name }}</td>
        <td class="max-w-50 truncate" title="{{ $item->slug }}">{{ $item->slug }}</td>
        <td>{{ $item->category->name }}</td>
        <td>SAR {{ $item->price }}</td>
        <td><x-status-badge :status="$item->status->value" /></td>
        <td>
            <div class="flex items-center gap-3">
                <a href="{{ route('properties.edit', $item) }}" class="action-button action-btn-edit" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <button type="button" class="action-button action-btn-delete delete-btn"
                    data-url="{{ route('properties.destroy', $item) }}" title="Delete">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="py-10 text-center text-(--color-primary)">No results found.</td>
    </tr>
@endforelse
