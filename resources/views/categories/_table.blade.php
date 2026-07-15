@forelse($items as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->slug }}</td>
        <td><x-status-badge :status="$item->status->value" /></td>
        <td>
            <div class="flex items-center gap-3">
                <a href="{{ route('categories.edit', $item) }}" class="action-button action-btn-edit" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <button type="button" class="action-button action-btn-delete delete-btn"
                    data-url="{{ route('categories.destroy', $item) }}" title="Delete">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="py-10 text-center text-(--color-primary)">No results found.</td>
    </tr>
@endforelse
