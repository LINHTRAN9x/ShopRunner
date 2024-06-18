<?php

namespace App\Rules;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\ProductDetail;
class DifferentQty implements ValidationRule
{
    protected $productDetail;

    public function __construct($productDetail)
    {
        $this->productDetail = $productDetail;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
//        dd($this->productDetail->qty, $value);
        if ($this->productDetail && $this->productDetail->qty == $value) {
            $fail('The quantity must be different from the current value.');
        }
    }
}
