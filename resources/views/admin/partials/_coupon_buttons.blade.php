
@if($coupon->deleted_at)
    <button type="button" class="btn btn-success"
            onclick="restoreCoupon(this, {{ $coupon->coupon_id  }})"
            title="Restore"
            data-url="{{ route('coupons.restore', $coupon->coupon_id ) }}"
            id="restoreBtn_{{ $coupon->coupon_id  }}">
        <i class="fas fa-undo"></i>
    </button>
@else
    <a title="Delete" href="javascript:void(0);"
       class="btn btn-danger delete-coupon"
       onclick="deleteCoupon(this, {{ $coupon->coupon_id  }})"
       data-url="{{ route('coupons.delete', $coupon->coupon_id ) }}">
        <i class="fas fa-trash"></i>
    </a>
@endif
