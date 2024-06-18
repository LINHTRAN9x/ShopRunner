<?php

namespace App\Rules;
use App\Models\Permission;
use App\Models\ProductDetail;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
class UniquePermissionName implements ValidationRule
{
    protected $permission;

    public function __construct($permission)
    {
        $this->permission = $permission;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Permission::where('name', $value);

        // Exclude the current product detail from the check
        if ($this->permission) {
            $query->where('name', '!=', $this->permission->name);
        }

        if ($query->exists()) {
            $fail('The voucher code already exists.');
        }
    }

}
