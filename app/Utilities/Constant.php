<?php

namespace App\Utilities;

class Constant
{
    //Order
    const ORDER_STATUS_RECEIVEORDERS = 1;

    const ORDER_STATUS_CONFIRMED = 2;

    const ORDER_STATUS_SHIPPING = 3;
    const ORDER_STATUS_FINISH = 4;
    const ORDER_STATUS_CANCEL = 5;
    public static $ORDER_STATUS = [
        self::ORDER_STATUS_RECEIVEORDERS => 'Orders received',

        self::ORDER_STATUS_CONFIRMED => 'Confirmed',

        self::ORDER_STATUS_SHIPPING => 'Shipping',
        self::ORDER_STATUS_FINISH => 'Finished',
        self::ORDER_STATUS_CANCEL => 'Canceled',
    ];


    const STATUSCOLORS = [
        self::ORDER_STATUS_RECEIVEORDERS => '#000',// Grey
//        self::ORDER_STATUS_UNCONFIRMED => '#000',// black
        self::ORDER_STATUS_CONFIRMED => '#007bff',// Blue
//        self::ORDER_STATUS_PAID => '#ffc107',// Yellow
//        self::ORDER_STATUS_PROCESSING => '#6f42c1',// Purple
        self::ORDER_STATUS_SHIPPING => '#28a745',// Green
        self::ORDER_STATUS_FINISH => '#fd7e14',// Orange
        self::ORDER_STATUS_CANCEL => '#dc3545',// Red
    ];


    const PAYMENT_STATUS_UNPAID = 1;
    const PAYMENT_STATUS_PAID = 2;

    public static $PAYMENT_STATUS = [
        self::PAYMENT_STATUS_UNPAID => 'UnPaid',
        self::PAYMENT_STATUS_PAID => 'Paid',
    ];

    //user
    const user_level_superAdmin = 0;
    const user_level_admin = 1;
    const user_level_client = 2;
    public static $user_level = [
        self::user_level_superAdmin => 'Super Admin',
        self::user_level_admin => 'Admin',
        self::user_level_client => 'Client',
    ];
    public static $user_level_color = [
        self::user_level_superAdmin => '#dc3545',
        self::user_level_admin => '#00ad00',
        self::user_level_client  => '#6c757d',
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
    const FREE_SIZE = 10;

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
        self::FREE_SIZE => 'FREE',
    ];

    const BEST_SELLER = 0;
    const NEW_ARRIVALS = 1;
    const HOT_SALES = 2;

    public static $FEATURES = [
        self::BEST_SELLER => 'Best Seller',
        self::NEW_ARRIVALS => 'New Arrivals',
        self::HOT_SALES => 'Hot Sales',
    ];


//////$TAGS
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
//////$COUPON_CONDITION
    const BY_PERCENT = 1;
    const BY_AMOUNT = 2;
    public static $COUPON_CONDITION = [
        self::BY_PERCENT => 'Phần trăm',
        self::BY_AMOUNT => 'Số tiền',
    ];

//////$REVIEW_STATUS
    const PENDING = 0;
    const ALLOWED = 1;
    const REFUSED = 2;
    public static $REVIEW_STATUS= [
        self::PENDING => 'PENDING',
        self::ALLOWED => 'ALLOWED',
        self::REFUSED => 'REFUSED',
    ];

    public static $REVIEW_STATUS_COLOR = [
        self::PENDING => '#6c757d',
        self::ALLOWED => '#00ad00',
        self::REFUSED => '#dc3545',
    ];
    //////PERMISSIONS GROUPS
    const ADMIN = 0;
    const AUTHENTICATE = 1;
    const BRAND = 2;
    const CATEGORY = 3;
    const CONTROLLER = 4;
    const COUPON = 5;
    const LANGUAGE = 6;
    const ORDER = 7;
    const PERMISSION = 8;
    const PRODUCT_COMMENT = 9;
    const PRODUCT = 10;
    const REVIEW = 11;
    const USER = 12;

    public static $PERMISSION_CONTROLLERS = [
        self::ADMIN => 'AdminController',
        self::AUTHENTICATE => 'AuthenticateController',
        self::BRAND => 'BrandController',
        self::CATEGORY => 'CategoryController',
        self::CONTROLLER => 'Controller',
        self::COUPON => 'CouponController',
        self::LANGUAGE => 'LanguageController',
        self::ORDER => 'OrderController',
        self::PERMISSION => 'PermissionController',
        self::PRODUCT_COMMENT => 'ProductCommentController',
        self::PRODUCT => 'ProductController',
        self::REVIEW => 'ReviewController',
        self::USER => 'UserController',
    ];
}
