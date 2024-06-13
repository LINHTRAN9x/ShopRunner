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
    const ORDER_STATUS_CANCEL = 8;
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
    const user_level_superAdmin = 0;
    const user_level_admin = 1;
    const user_level_client = 2;
    public static $user_level = [
        self::user_level_superAdmin => 'superAdmin',
        self::user_level_admin => 'admin',
        self::user_level_client => 'client',
    ];


    const STATUSCOLORS = [
        self::ORDER_STATUS_RECEIVEORDERS => '#6c757d',// Grey
        self::ORDER_STATUS_UNCONFIRMED => '#000',// black
        self::ORDER_STATUS_CONFIRMED => '#007bff',// Blue
        self::ORDER_STATUS_PAID => '#ffc107',// Yellow
        self::ORDER_STATUS_PROCESSING => '#6f42c1',// Purple
        self::ORDER_STATUS_SHIPPING => '#28a745',// Green
        self::ORDER_STATUS_FINISH => '#fd7e14',// Orange
        self::ORDER_STATUS_CANCEL => '#dc3545',// Red
    ];
    const COLOR_GREY = 1;
    const COLOR_WHITE = 2;
    const COLOR_DARKBLUE = 3;
    const COLOR_ORANGE = 4;
    const COLOR_VIOLET = 5;
    const COLOR_LIGHTBLACK = 6;
    const COLOR_BLACK = 7;
    const COLOR_RED = 8;
    const COLOR_PINK = 9;

    public static $COLORS = [
        self::COLOR_GREY => 'grey',
        self::COLOR_WHITE => 'white',
        self::COLOR_DARKBLUE => 'darkblue',
        self::COLOR_ORANGE => 'orange',
        self::COLOR_VIOLET => 'violet',
        self::COLOR_LIGHTBLACK => 'lightblack',
        self::COLOR_BLACK => 'black',
        self::COLOR_RED => 'red',
        self::COLOR_PINK => 'pink',
    ];

    const SIZE_XS = 1;
    const SIZE_S = 2;
    const SIZE_M = 3;
    const SIZE_L = 4;
    const SIZE_XL = 5;
    const SIZE_2XL = 6;
    const SIZE_XXL = 7;
    const SIZE_3XL = 8;
    const SIZE_4XL = 9;

    public static $SIZES = [
        self::SIZE_XS => 'XS',
        self::SIZE_S => 'S',
        self::SIZE_M => 'M',
        self::SIZE_L => 'L',
        self::SIZE_XL => 'XL',
        self::SIZE_2XL => '2XL',
        self::SIZE_XXL => 'XXL',
        self::SIZE_3XL => '3XL',
        self::SIZE_4XL => '4XL',
    ];

    const BEST_SELLER = 0;
    const NEW_ARRIVALS = 1;
    const HOT_SALES = 2;

    public static $FEATURES = [
        self::BEST_SELLER => 'Best Seller',
        self::NEW_ARRIVALS => 'New Arrivals',
        self::HOT_SALES => 'Hot Sales',
    ];

    const CLOTHING = 0;
    const ACCESSORIES = 1;
    const HANDBAG = 2;
    const SHOES = 3;
    const PANT = 4;
    const SHIRT = 5;
    const HAT = 6;
    const CALF = 7;

    public static $TAGS = [
        self::CLOTHING => 'Clothing',
        self::ACCESSORIES => 'Accessories',
        self::HANDBAG => 'Handbag',
        self::SHOES => 'Shoes',
        self::PANT => 'Pant',
        self::SHIRT => 'Shirt',
        self::HAT => 'Hat',
        self::CALF => 'Calf',
    ];
}
