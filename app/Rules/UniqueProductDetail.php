<?php

namespace App\Rules;
use App\Models\ProductDetail;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
class UniqueProductDetail implements ValidationRule
{
    protected $product;
    protected $color;
    protected $productDetailId;
    public function __construct($product, $color, $productDetailId = null)
    {
        $this->product = $product;
        $this->color = $color;
        $this->productDetailId = $productDetailId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = ProductDetail::where('product_id', $this->product->id)
            ->where('color', $this->color)
            ->where('size', $value);

        // Exclude the current product detail from the check
        if ($this->productDetailId) {
            $query->where('id', '!=', $this->productDetailId);
        }

        if ($query->exists()) {
            $fail('The combination of color and size already exists for this product.');
        }
    }
}
