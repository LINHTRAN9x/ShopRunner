<?php

namespace App\Utilities;

class Constant
{
    //Order
    const ORDER_STATUS_RECEIVEORDERS = 1;
    const ORDER_STATUS_UNCONFIRMED = 2;
    const ORDER_STATUS_CONFIRMED = 3;
    const ORDER_STATUS_PAID = 4;
    const ORDER_STATUS_PROCESSING = 5;
    const ORDER_STATUS_SHIPPING = 6;
    const ORDER_STATUS_FINISH = 7;
    const ORDER_STATUS_CANCEL = 0;
    public static $ORDER_STATUS = [
       self::ORDER_STATUS_RECEIVEORDERS => 'Receive Orders',
        self::ORDER_STATUS_UNCONFIRMED => 'Unconfirmed',
        self::ORDER_STATUS_CONFIRMED => 'Confirmed',
        self::ORDER_STATUS_PAID => 'Paid',
        self::ORDER_STATUS_PROCESSING => 'Processing',
        self::ORDER_STATUS_SHIPPING => 'Shipping',
        self::ORDER_STATUS_FINISH => 'Finish',
        self::ORDER_STATUS_CANCEL => 'Cancel',
    ];

    //user
    const user_level_host = 0;
    const user_level_admin = 1;
    const user_level_client = 2;
    public static $user_level = [
        self::user_level_host => 'host',
        self::user_level_admin => 'admin',
        self::user_level_client => 'client',
    ];
}
