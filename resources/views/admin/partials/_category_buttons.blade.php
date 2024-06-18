
@if($category->deleted_at)
    <button type="button" class="btn btn-success"
            onclick="restoreCategory(this, {{ $category->id }})" title="Restore"
            data-url="{{ route('categories.restore', $category->id) }}"
            id="restoreBtn_{{ $category->id }}">
        <i class="fas fa-undo"></i>
    </button>
@else
    <a title="Delete" href="javascript:void(0);" class="btn btn-danger delete-category"
       onclick="deleteCategory(this, {{ $category->id }})"
       data-url="{{ route('categories.delete', $category->id) }}">
        <i class="fas fa-trash"></i>
    </a>
@endif

