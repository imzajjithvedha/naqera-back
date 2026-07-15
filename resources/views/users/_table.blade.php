@forelse($items as $item)
    <tr>
        <td>
            @if($item->hasMedia('backend/users'))
                <img src="{{ $item->getFirstMediaUrl('backend/users', 'thumb') }}" alt="Image" class="back-table-image">
            @else
                <img src="{{ asset('storage/global/no-image.webp') }}" alt="Image" class="back-table-image">
            @endif
        </td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td class="capitalize">{{ $item->role }}</td>
        <td><x-status-badge :status="$item->status->value" /></td>
        <td>
            <div class="flex items-center gap-3">
                <a href="{{ route('users.edit', $item) }}" class="action-button action-btn-edit" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <button type="button" class="action-button action-btn-delete delete-btn"
                    data-url="{{ route('users.destroy', $item) }}" title="Delete">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="py-10 text-center text-(--color-primary)">No results found.</td>
    </tr>
@endforelse
