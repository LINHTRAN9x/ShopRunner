<?php

namespace App\Rules;
use App\Models\Coupon;
use App\Models\ProductDetail;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
class UniqueCouponCode implements ValidationRule
{
    protected $coupon;

    public function __construct($coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Coupon::where('coupon_code', $value);

        // Exclude the current product detail from the check
        if ($this->coupon) {
            $query->where('coupon_code', '!=', $this->coupon->coupon_code);
        }

        if ($query->exists()) {
            $fail('The voucher code already exists.');
        }
    }}
