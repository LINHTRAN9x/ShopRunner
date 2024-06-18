<!-- resources/views/partials/_brand_buttons.blade.php -->
@if($productComment->deleted_at)
    <button type="button" class="btn btn-success"
            onclick="restoreProductComment(this, {{ $productComment->id }})" title="Restore"
            data-url="{{ route('productComments.restore', $productComment->id) }}"
            id="restoreBtn_{{ $productComment->id }}">
        <i class="fas fa-undo"></i>
    </button>
@else
    <a title="Delete" href="#" class="btn btn-danger delete-productComment"
       onclick="deleteProductComment(this, {{ $productComment->id }})"
       data-url="{{ route('productComments.delete', $productComment->id) }}">
        <i class="fas fa-trash"></i>
    </a>
@endif

