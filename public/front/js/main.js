/*  ---------------------------------------------------
    Template Name: Male Fashion
    Description: Male Fashion - ecommerce teplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

'use strict';

// use a script tag or an external JS file
document.addEventListener("DOMContentLoaded", (event) => {
    gsap.registerPlugin(ScrollTrigger)
    gsap.to("#preloder", {
        scrollTrigger:{
            trigger: "#preloder",

        }, // start animation when ".box" enters the viewport
        y: -900,
        delay: .7,
        duration:.5,
    });
});

(function ($) {

    // Tạo biến để theo dõi vị trí cuộn trước đó
    let lastScrollTop = 0;


    window.addEventListener('scroll', function() {
        // Lấy vị trí cuộn hiện tại
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Lấy phần tử header
        let header = document.querySelector('header');

        // So sánh vị trí cuộn hiện tại với vị trí trước đó
        if (scrollTop > lastScrollTop) {
            // Nếu cuộn xuống, thêm lớp "hidden" để ẩn header
            header.classList.add('hidden');
        } else {
            // Nếu cuộn lên, xóa lớp "hidden" để hiển thị header
            header.classList.remove('hidden');
        }

        // Cập nhật vị trí cuộn trước đó
        lastScrollTop = scrollTop;
    });


    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.product__filter').length > 0) {
            var containerEl = document.querySelector('.product__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_carrot-left'><span/>", "<span class='arrow_carrot-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 3000,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
		Radio Btn
	--------------------- */
    $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").on('click', function () {
        $(".product__color__select label, .shop__sidebar__size label, .product__details__option__size label").removeClass('active');
        $(this).addClass('active');
    });

    /*-------------------
		Scroll
	--------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });

    /*------------------
		Magnific
	--------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');

    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var inputElement = $button.parent().find('input');
        var oldValue = parseFloat(inputElement.val());
        var newVal;

        if ($button.hasClass('inc')) {
            // Khi tăng số lượng
            newVal = oldValue + 1;
        } else {
            // Khi giảm số lượng
            if (oldValue > 0) {
                newVal = oldValue - 1;
            } else {
                newVal = 0;
            }
        }

        // Cập nhật giá trị mới vào ô input
        inputElement.val(newVal);

        // Lấy rowId từ thuộc tính data-rowid
        var rowId = inputElement.data('rowid');

        // Gọi hàm update với rowId và giá trị mới
        update(rowId, newVal);
    });

    $(document).ready(function() {

        $('.pro-qty input').on('change', function() {
            var $input = $(this);

            var newVal = parseFloat($input.val());


            if (isNaN(newVal) || newVal < 0) {
                alert("Please enter a valid quantity.");
                return;
            }


            var rowId = $input.data('rowid');


            update(rowId, newVal);
        });
    });



    var proQty = $('.pro-qty-2');
    proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    /*------------------
        Achieve Counter
    --------------------*/
    $('.cn_num').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

})(jQuery);

function clearFav() {
    $.ajax({
        type: "GET",
        url: "favourite/clear",
        success: function (response) {
            var cart_tbody = $('.shopping__cart__table tbody');
            cart_tbody.children().remove();
            showCustomAlert('Remove all products form favourite successful!')

        },
        error: function (xhr, status, error) {

            alert('Failed to clear cart. Please try again.');
        }
    });
}

function addFav(productId){
    $.ajax({
        type: "GET",
        url: "favourite/addFav",
        data: {productId: productId},
        success: function (response) {
            $('.favourite-count').text(response['count']);
            showCustomAlert(response['message']);
            console.log(response);
        },
        error: function (response) {
            alertMessage("Add failed. Please try again!");
            console.log(response);
        }
    });
}

function addCart(productId,qty){
    // Xác định size được chọn
    var selectedSize = $('input[type=radio][name=size]:checked').val();
    var selectedColor = $('input[type=radio][name=color]:checked').val();

    // // Kiểm tra xem đã chọn size chưa
    // if (!selectedSize) {
    //     // Kiểm tra xem có size mặc định không
    //     var defaultSize = $('input[type=radio][name=size][value=defaultSize]');
    //     if (defaultSize.length) {
    //         // Nếu có size mặc định, chọn size đó
    //         defaultSize.prop('checked', true);
    //         selectedSize = 'defaultSize'; // Cập nhật giá trị selectedSize
    //     } else {
    //         // Nếu không có size mặc định, hiển thị thông báo lỗi
    //         showCustomAlert('Please select a size.');
    //         return;
    //     }
    // }
    // else if (!selectedColor){
    //     showCustomAlert('Please select a color.');
    //     return;
    // }
    $.ajax({
        type:"GET",
        url: "cart/add",
        data: {productId: productId,qty: qty,size: selectedSize,color: selectedColor},
        success: function (response){
            $('.cart-count').text(response['count']);
            $('.price').text('$' + response['total']);

            alertMessage(response,"Add: " + response['cart'].name + " to cart!");
            console.log(response);
        },
        error: function (response){
            alertMessage("Add failed.Please try again!");
            console.log(response);
        }
    })
}
function quickView(productId){
    $.ajax({
        type: "GET",
        url: "shop/quick-view",
        data: {productId: productId},
        success: function (response) {


            showCustomAlert("Add failed.Please try again!");
            console.log('Hello')
        },
        error: function (response) {
            showCustomAlert("Add failed.Please try again!");
            console.log(response,"Add failed.Please try again!")
        }
    })
}

$('input[type=radio][name=size]').on('click', function() {
    // Kiểm tra xem radio button này có được chọn không
    if ($(this).is(':checked')) {
        // Lấy giá trị của radio button được chọn
        var selectedSize = $(this).val();
        // Hiển thị giá trị của radio button được chọn trong console để kiểm tra
        console.log('Selected size:', selectedSize);
    }
});

$(document).ready(function() {
    var sizeSelected = false;

    // Kiểm tra xem đã chọn size nào chưa
    $('input[type=radio][name=size]').change(function() {
        sizeSelected = true;
    });

    // Nếu không có size nào được chọn, chọn size mặc định
    $('form').submit(function() {
        if (!sizeSelected) {
            // Chọn size mặc định
            $('#defaultSize').prop('checked', true);
        }
    });
});

function removeCart(rowId){
    $.ajax({
        type:"GET",
        url: "cart/delete",
        data: {rowId: rowId},
        success: function (response){
            $('.cart-count').text(response['count']);
            $('.price').text('$' + response['total']);

            var cart_tbody = $('.shopping__cart__table tbody');
            var cartexistItem = cart_tbody.find("tr" + "[data-rowId='" +rowId + "']");
            cartexistItem.remove();

            $('.cart__subTotal').text('$' +response['subTotal']);
            $('.cart__Total').text('$' + response['total']);
            //alertMessage(response,"Remove successful \n Product: " + response['cart'].name + "!");
            //alert('Remove successful!')
            showCustomAlert('Remove product successful!')
            console.log(response);
        },
        error: function (response){
            alertMessage("Remove failed.Please try again!");
            console.log(response);
        }
    })
}

function destroyCart(){
    $.ajax({
        type:"GET",
        url: "cart/destroy",
        data: {},
        success: function (response){
            $('.cart-count').text('0');
            $('.price').text('0');

            var cart_tbody = $('.shopping__cart__table tbody');
            cart_tbody.children().remove();

            $('.cart__subTotal').text('0');
            $('.cart__Total').text('0');
            //alertMessage(response,"Remove successful \n Product: " + response['cart'].name + "!");
            //alert('Remove successful!')
            showCustomAlert('Remove all products form cart successful!')
            console.log(response);
        },
        error: function (response){
            alertMessage("Remove failed.Please try again!");
            console.log(response);
        }
    })
}

function update(rowId,qty){
    $.ajax({
        type:"GET",
        url: "cart/update",
        data: {rowId: rowId, qty: qty},
        success: function (response){

            $('.cart-count').text(response['count']);
            $('.price').text('$' + response['total']);

            var cart_tbody = $('.shopping__cart__table tbody');
            var cartexistItem = cart_tbody.find("tr" + "[data-rowId='" +rowId + "']");
            if (qty === 0){
                cartexistItem.remove();
            }else {
                cartexistItem.find('.cart__price').text('$' + (response['cart'].price * response['cart'].qty).toFixed(2));
                console.log(cartexistItem)
            }


            $('.cart__subTotal').text('$' +response['subTotal']);
            $('.cart__Total').text('$' + response['total']);

            console.log(response);
        },
        error: function (response){
            alertMessage("Update failed.Please try again!");
            console.log(response);
        }
    })
}

function alertMessage(response,message){
    $('#alertMessage').html(
        '<div class="bs4ToastWrapper d-flex toast alert col-4 ml-2 mt-4 fade show" role="alert">\n' +
        '        <div>\n' +
        '            <div class="toast-header">\n' +
        '                <strong class="mr-auto">Notification<i class="fa fa-bell"></i></strong>\n' +
        '            </div>\n' +
        '            <div class="toast-body d-flex">'
        + '<img src="front/img/product/' + response['cart'].options.images[0].path +'" alt="" width="50" height="50" class="mr-3">'
        + '<p>'+message+'</p>'
        + ' </div>\n' +
        '        </div>\n' +
        '        <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
        '            <span aria-hidden="true">&times;</span>\n' +
        '        </button>\n' +
        '    </div>'
    )
}

function showCustomAlert(message) {
    document.getElementById('custom-alert-message').textContent = message;
    document.getElementById('custom-alert').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}
function hideCustomAlert() {
    document.getElementById('custom-alert').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

$('.shipping_method').change(function() {
    var selectedShipping = $(this).val();
    var shippingCost = 0;

    if (selectedShipping === 'standard') {
        shippingCost = 10;
    } else if (selectedShipping === 'express') {
        shippingCost = 20;
    }

    $.ajax({
        type: "GET",
        url: "calculate-shipping",
        data: { shipping_method: selectedShipping },
        success: function (response) {

            // Tính toán tổng số tiền sau khi áp dụng giảm giá và chi phí vận chuyển
            var totalCost = response.subtotal;


            $('.shipping-cost').text('$' + shippingCost);
            console.log(response);

            // Hiển thị tổng số tiền sau khi áp dụng giảm giá và chi phí vận chuyển
            $('.shipping-cost-total').text('$' + totalCost);
        },
        error: function (response) {
            console.log('Error:', response);
        }
    });
});








