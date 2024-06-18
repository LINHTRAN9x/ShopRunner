<!-- resources/views/partials/_brand_buttons.blade.php -->
    @if($brand->deleted_at)
        <button type="button" class="btn btn-success"
                onclick="restoreBrand(this, {{ $brand->id }})" title="Restore"
                data-url="{{ route('brands.restore', $brand->id) }}"
                id="restoreBtn_{{ $brand->id }}">
            <i class="fas fa-undo"></i>
        </button>
    @else
        <a title="Delete" href="#" class="btn btn-danger delete-brand"
           onclick="deleteBrand(this, {{ $brand->id }})"
           data-url="{{ route('brands.delete', $brand->id) }}">
            <i class="fas fa-trash"></i>
        </a>
    @endif

