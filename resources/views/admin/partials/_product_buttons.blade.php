<!-- resources/views/partials/_product_buttons.blade.php -->
    @if($product->deleted_at)
        <button type="button" class="btn btn-success"
                onclick="restoreProduct(this, {{ $product->id }})" title="Restore"
                data-url="{{ route('products.restore', $product->id) }}"
                id="restoreBtn_{{ $product->id }}">
            <i class="fas fa-undo"></i>
        </button>
    @else
        <a title="Delete" href="#" class="btn btn-danger delete-product"
           onclick="deleteProduct(this, {{ $product->id }})"
           data-url="{{ route('products.delete', $product->id) }}">
            <i class="fas fa-trash"></i>
        </a>
    @endif

