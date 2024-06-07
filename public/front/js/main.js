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
        scrollTrigger: {
            trigger: "#preloder",

        }, // start animation when ".box" enters the viewport
        y: -900,
        delay: .7,
        duration: .5,
    });
});

(function ($) {

    // Tạo biến để theo dõi vị trí cuộn trước đó
    let lastScrollTop = 0;


    window.addEventListener('scroll', function () {
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

    if (mm == 12) {
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
    $('.zoom-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
            verticalFit: true,
            titleSrc: function(item) {
                return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
            }
        },
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
                return element.find('img');
            }
        }

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

    $(document).ready(function () {

        $('.pro-qty input').on('change', function () {
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

function addFav(productId) {
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

function addCartQuick(productId) {

    var qty = $('#product-qty').val() || 1;

    // Gọi AJAX để lấy chi tiết sản phẩm
    $.ajax({
        type: "GET",
        url: "getProductDetails",    // Đường dẫn để lấy chi tiết sản phẩm
        data: {productId: productId},
        success: function (response) {
            // Lấy kích thước và màu sắc đầu tiên từ chi tiết sản phẩm
            var selectedSize = response.sizes.length > 0 ? response.sizes[0] : null;
            var selectedColor = response.colors.length > 0 ? response.colors[0] : null;

            // Kiểm tra nếu không có size hoặc color
            if (!selectedSize) {
                alert('No size available for this product.');
                return;
            }

            if (!selectedColor) {
                alert('No color available for this product.');
                return;
            }
            selectedColor = getColorNumber(selectedColor);
            // Thực hiện gọi AJAX để thêm sản phẩm vào giỏ hàng
            $.ajax({
                type: "GET",
                url: "cart/add",
                data: {productId: productId, qty: qty, size: selectedSize, color: selectedColor},
                success: function (response) {
                    $('.cart-count').text(response['count']);
                    $('.price').text('$' + response['total']);

                    alertMessage(response, "Added: " + response['cart'].name + " to cart!");
                    console.log(response);
                },
                error: function (response) {
                    alertMessage("Add failed. Please try again!");
                    console.log(response);
                }
            });
        },
        error: function (response) {
            console.log("Failed to get product details.", response);
        }
    });
}

function addCart(productId, qty) {

    var selectedSize = $('input[type=radio][name=size]:checked').val();
    var selectedColor = $('input[type=radio][name=color]:checked').val();

    // Kiểm tra xem đã chọn size chưa
    if (!selectedSize) {
        // Kiểm tra xem có size mặc định không
        var defaultSize = $('input[type=radio][name=size][value=defaultSize]');
        if (defaultSize.length) {
            // Nếu có size mặc định, chọn size đó
            defaultSize.prop('checked', true);
            selectedSize = 'defaultSize'; // Cập nhật giá trị selectedSize
        } else {
            // Nếu không có size mặc định, hiển thị thông báo lỗi
            showCustomAlert('Please select a size.');
            return;
        }
    } else if (!selectedColor) {
        showCustomAlert('Please select a color.');
        return;
    }
    $.ajax({
        type: "GET",
        url: "cart/add",
        data: {productId: productId, qty: qty, size: selectedSize, color: selectedColor},
        success: function (response) {
            $('.cart-count').text(response['count']);
            $('.price').text('$' + response['total']);

            alertMessage(response, "Add: " + response['cart'].name + " to cart!");
            console.log(response);
        },
        error: function (response) {
            alertMessage("Add failed.Please try again!");
            console.log(response);
        }
    })
}

$('input[type=radio][name=size]').on('click', function () {
    // Kiểm tra xem radio button này có được chọn không
    if ($(this).is(':checked')) {
        // Lấy giá trị của radio button được chọn
        var selectedSize = $(this).val();
        // Hiển thị giá trị của radio button được chọn trong console để kiểm tra
        console.log('Selected size:', selectedSize);
    }
});

$(document).ready(function () {
    var sizeSelected = false;

    // Kiểm tra xem đã chọn size nào chưa
    $('input[type=radio][name=size]').change(function () {
        sizeSelected = true;
    });

    // Nếu không có size nào được chọn, chọn size mặc định
    $('form').submit(function () {
        if (!sizeSelected) {
            // Chọn size mặc định
            $('#defaultSize').prop('checked', true);
        }
    });
});

function removeCart(rowId) {
    $.ajax({
        type: "GET",
        url: "cart/delete",
        data: {rowId: rowId},
        success: function (response) {
            $('.cart-count').text(response['count']);
            $('.price').text('$' + response['total']);

            var cart_tbody = $('.shopping__cart__table tbody');
            var cartexistItem = cart_tbody.find("tr" + "[data-rowId='" + rowId + "']");
            cartexistItem.remove();

            $('.cart__subTotal').text('$' + response['subTotal']);
            $('.cart__Total').text('$' + response['total']);
            //alertMessage(response,"Remove successful \n Product: " + response['cart'].name + "!");
            //alert('Remove successful!')
            showCustomAlert('Remove product successful!')
            console.log(response);
        },
        error: function (response) {
            alertMessage("Remove failed.Please try again!");
            console.log(response);
        }
    })
}

function destroyCart() {
    $.ajax({
        type: "GET",
        url: "cart/destroy",
        data: {},
        success: function (response) {
            $('.cart-count').text('0');
            $('.price').text('$0.00');

            var cart_tbody = $('.shopping__cart__table tbody');
            cart_tbody.children().remove();

            $('.cart__subTotal').text('0');
            $('.cart__Total').text('0');
            //alertMessage(response,"Remove successful \n Product: " + response['cart'].name + "!");
            //alert('Remove successful!')
            showCustomAlert('Remove all products form cart successful!')
            console.log(response);
        },
        error: function (response) {
            alertMessage("Remove failed.Please try again!");
            console.log(response);
        }
    })
}

function update(rowId, qty) {
    $.ajax({
        type: "GET",
        url: "cart/update",
        data: {rowId: rowId, qty: qty},
        success: function (response) {

            $('.cart-count').text(response['count']);
            $('.price').text('$' + response['total']);

            var cart_tbody = $('.shopping__cart__table tbody');
            var cartexistItem = cart_tbody.find("tr" + "[data-rowId='" + rowId + "']");
            if (qty === 0) {
                cartexistItem.remove();
            } else {
                cartexistItem.find('.cart__price').text('$' + (response['cart'].price * response['cart'].qty).toFixed(2));
                console.log(cartexistItem)
            }


            $('.cart__subTotal').text('$' + response['subTotal']);
            $('.cart__Total').text('$' + response['total']);

            console.log(response);
        },
        error: function (response) {
            alertMessage("Update failed.Please try again!");
            console.log(response);
        }
    })
}

function alertMessage(response, message) {
    $('#alertMessage').html(
        '<div class="bs4ToastWrapper d-flex toast alert col-4 ml-2 mt-4 fade show" role="alert">\n' +
        '        <div>\n' +
        '            <div class="toast-header">\n' +
        '                <strong class="mr-auto">Notification<i class="fa fa-bell"></i></strong>\n' +
        '            </div>\n' +
        '            <div class="toast-body d-flex">'
        + '<img src="front/img/product/' + response['cart'].options.images[0].path + '" alt="" width="50" height="50" class="mr-3">'
        + '<p>' + message + '</p>'
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

$('.shipping_method').change(function () {
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
        data: {shipping_method: selectedShipping},
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

//************ SUPPORT SESSION START ************//
$(document).ready(function () {

    $('#support-link').click(function (event) {
        event.preventDefault();
        $('.support_menu').toggleClass('support_menu_show');
    });


    $(document).click(function (event) {

        if (!$(event.target).closest('#support-link, .support_menu').length) {
            $('.support_menu').removeClass('support_menu_show');
        }
    });
});
//************ SUPPORT SESSION END ************//

//************ CHAT BOT SESSION START ************//
$(document).ready(function () {
    $('#message-form').submit(function (e) {
        e.preventDefault();
        var message = $('.message-input').val();
        sendMessage(message);
        $('.message-input').val('');
        $('.message-list').append('<div class="user-message">' + message + '</div>');
        scrollToBottom();
    });

    function sendMessage(message) {
        setTimeout(function () {
            $('.loading').show();
            scrollToBottom();
        }, 600)
        $.ajax({
            url: "/botman",
            method: 'post',
            dataType: 'json',
            data: {
                message: message,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.messages && response.messages.length > 0) {
                    var reply = response.messages[0].text;
                } else {
                    var reply = 'May I help you?';
                }
                console.log(response)
                setTimeout(function () {
                    $('.loading').hide();
                    $('.message-list').append('<div class="admin-message">' + reply + '</div>');
                    scrollToBottom();
                }, 1200);

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
});
//************ CHAT BOT SESSION END ************//

//************ BACK TO TOP SESSION START ************//
function scrollToBottom() {
    var chatWindow = $('.chat-window');
    chatWindow.scrollTop(chatWindow.prop("scrollHeight"));
}

//************ BACK TO TOP SESSION END ************//


//************ QUICK VIEW SESSION START ************//
$(document).ready(function () {
    // Thiết lập CSRF token cho tất cả các yêu cầu AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.quick-view').click(function () {
        var product_id = $(this).data('id_product');
        $.ajax({
            url: "/quick-view",
            type: "POST",
            data: {product_id: product_id},
            success: function (response) {
                var locale = '{{ Session()->getLocale() }}';
                var quickViewText = 'View Details';

                $('#quick-view .modal-title').html(
                    '<a href="shop/product/' + response.id + '" class="quick-view-product">' +
                    quickViewText +
                    '</a>'
                );

                var html = '';

                html +=
                    '<div class="col-lg-6 col-md-9 border-right">' +
                    '<div class="tab-content">';

                response.images.forEach(function (image, index) {
                    html += '<div class="tab-pane ' + (index === 1 ? 'active' : '') + '" id="tabs-' + (index + 1) + '" role="tabpanel">' +
                        '<div class="product__details__pic__item">' +
                        '<img src="front/img/product/' + image.path + '" alt="">' +
                        '</div>' +
                        '</div>';
                });

                html += '</div>' +
                    '</div>' +
                    '</div>';

                html += '<div class="shop-detail-modal product__details__content__modal">' +
                    '<div>' +
                    '<div>' +
                    '<div class="col-lg-12">' +
                    '<div class="product__details__text">' +
                    '<h4 class="h4-product">' + response.name + '</h4>' +
                    '<div class="rating">';

                var avgRating = response.avgRating || 0;
                var fullStars = Math.floor(avgRating);
                var halfStar = (avgRating - fullStars) >= 0.5 ? 1 : 0;
                var emptyStars = 5 - fullStars - halfStar;

                for (var i = 1; i <= fullStars; i++) {
                    html += '<i class="fa fa-star pl-1"></i>';
                }
                if (halfStar) {
                    html += '<i class="fa fa-star-half-o pl-1"></i>';
                }
                for (var i = 1; i <= emptyStars; i++) {
                    html += '<i class="fa fa-star-o pl-1"></i>';
                }

                html += '<span> - ' + response.reviewsCount + ' Reviews</span>' +
                    '</div>';

                if (response.discount != null) {
                    html += '<h3>$' + response.discount + ' <span>$' + response.price + '</span></h3>';
                } else {
                    html += '<h3>$' + response.price + ' <span></span></h3>';
                }

                html += '<div class="product__details__option">' +
                    '<div class="product__details__option__size">' +
                    '<span>Size:</span>';

                response.sizes.forEach(function (size, index) {
                    var checked = (index === 0) ? 'checked' : '';
                    var activeClass = (checked === 'checked') ? 'active' : '';
                    html += '<label for="' + size + '" class="size ' + activeClass + '">' +
                        size +
                        '<input type="radio" name="size" id="' + size + '" value="' + size + '" ' + checked + '>' +
                        '</label>';
                });

                html += '</div>' +
                    '<div class="product__details__option__color__product">' +
                    '<span>Color:</span>';

                response.colors.forEach(function (color, index) {
                    var colorNumber = getColorNumber(color);
                    html += '<label class="c-' + colorNumber + '" for="quick-view-color-' + colorNumber + '">' +
                        '<input type="radio" name="quick-view-color" value="' + colorNumber + '" id="quick-view-color-' + colorNumber + '">' +
                        '</label>';
                });

                html += '</div>' +
                    '</div>' +
                    '<div class="product__details__cart__option">' +
                    '<div class="quantity">' +
                    '<div class="pro-qty-2">' +
                    '<input id="product-qty" name="qty" type="text" value="1">' +
                    '</div>' +
                    '</div>' +
                    '<input type="hidden" id="product-id" value="' + response.id + '">' +
                    '<div id="add-to-cart-btn" class="primary-btn add-details">add to cart</div>' +
                    '</div>' +
                    '<div class="product__details__btns__option">' +
                    '<a href="javascript:addFav(' + response.id + ')"><i class="fa fa-heart"></i> add to wishlist</a>' +
                    '<a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>' +
                    '</div>' +
                    '<div class="product__details__last__option__quickview">' +
                    '<h6>Guaranteed Safe Checkout</h6>' +
                    '<img src="front/img/shop-details/details-payment.png" alt="">' +
                    '<ul>' +
                    '<li><span>SKU:</span>' + response.sku + '</li>' +
                    '<li><span>Categories:</span> ' + response.category + '</li>' +
                    '<li><span>Brand:</span> ' + response.brand + '</li>' +
                    '<li><span>Tag:</span> ' + response.tag + '</li>' +
                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('#quick-view .modal-body-product').html(html);
                $('#quick-view').modal('show');

                // Cập nhật nền cho các ảnh
                $('.set-bg').each(function () {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });

                // Sự kiện change cho các radio button trong nhóm size
                $('input[name="size"]').change(function () {
                    $('label.size').removeClass('active');
                    $(this).closest('label.size').addClass('active');
                });

                // Sự kiện change cho các radio button trong nhóm màu sắc
                $('input[name="quick-view-color"]').change(function () {
                    // Loại bỏ class active từ tất cả các label trong nhóm màu sắc
                    $('label.color').removeClass('active');
                    // Thêm class active cho label chứa radio button được chọn
                    $(this).closest('label.color').addClass('active');
                });

                // Sự kiện click cho nút add to cart
                $('#add-to-cart-btn').click(function () {
                    var selectedSize = $('input[name="size"]:checked').val();
                    var selectedColor = $('input[name="quick-view-color"]:checked').val();
                    var quantity = $('#product-qty').val();
                    var productId = $('#product-id').val();

                    addCart(productId, quantity, selectedSize, selectedColor);
                });
            },
            error: function (response) {
                console.log('Lỗi:', response);
            }
        });
    });


    function getColorNumber(color) {
        switch (color) {
            case 'black':
                return '1';
            case 'darkblue':
                return '2';
            case 'orange':
                return '3';
            case 'grey':
                return '4';
            case 'lightblack':
                return '5';
            case 'pink':
                return '6';
            case 'violet':
                return '7';
            case 'red':
                return '8';
            case 'white':
                return '9';
            default:
                return '';
        }
    }

    function addCart(productId, qty, selectedSize, selectedColor) {
        if (!selectedSize) {
            alert('Please select a size.');
            return;
        }

        // Kiểm tra xem đã chọn color chưa
        if (!selectedColor) {
            alert('Please select a color.');
            return;
        }

        $.ajax({
            type: "GET",
            url: "cart/add",
            data: {productId: productId, qty: qty, size: selectedSize, color: selectedColor},
            success: function (response) {
                $('.cart-count').text(response.count);
                $('.price').text('$' + response.total);

                alertMessage(response, "Added: " + response.cart.name + " to cart!");
                console.log(response);
            },
            error: function (response) {
                alertMessage("Add failed. Please try again!");
                console.log(response);
            }
        });
    }
});

function getColorNumber(color) {
    switch (color) {
        case 'black':
            return '1';
        case 'darkblue':
            return '2';
        case 'orange':
            return '3';
        case 'grey':
            return '4';
        case 'lightblack':
            return '5';
        case 'pink':
            return '6';
        case 'violet':
            return '7';
        case 'red':
            return '8';
        case 'white':
            return '9';
        default:
            return '';
    }
}

//************ QUICK VIEW SESSION END ************//



    function sortTable(column) {
    let currentUrl = new URL(window.location.href);
    let searchParams = currentUrl.searchParams;

    // Toggle sort direction
    let sortDirection = searchParams.get('sort_direction') === 'asc' ? 'desc' : 'asc';

    // Set or update the sort column and direction
    searchParams.set('sort_by', column);
    searchParams.set('sort_direction', sortDirection);


    // Redirect to the updated URL
    window.location.href = currentUrl.origin + currentUrl.pathname + '?' + searchParams.toString();
}

//************ CART QUICK VIEW SESSION START ************//
$(document).ready(function () {
    // Thiết lập CSRF token cho tất cả các yêu cầu AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.cart-quickview').click(function () {
        var product_id = $(this).data('id_product');
        var rowId = $(this).closest('tr').data('rowid'); // Lấy rowId của sản phẩm từ phần tử hàng trong bảng giỏ hàng
        $('#cart-quickview').attr('data-rowid', rowId); // Gán giá trị rowId vào thuộc tính data-rowid của modal


        $.ajax({
            url: "/cart-quickview",
            type: "POST",
            data: {product_id: product_id},
            success: function (response) {
                var locale = '{{ Session()->getLocale() }}';
                var quickViewText = 'View Details';

                $('#cart-quickview .modal-title').html(
                    '<a href="shop/product/' + response.id + '" class="quick-view-product">' +
                    quickViewText +
                    '</a>'
                );

                var html = '';

                html +=
                    '<div class="col border-cart">' +
                    '<div class="tab-content">';

                response.images.forEach(function (image, index) {
                    html += '<div class="tab-pane ' + (index === 1 ? 'active' : '') + '" id="tabs-' + (index + 1) + '" role="tabpanel">' +
                        '<div class="product__details__pic__item">' +
                        '<img src="front/img/product/' + image.path + '" alt="" width="120">' +
                        '</div>' +
                        '</div>';
                });

                html += '</div>' +
                    '</div>' +
                    '</div>';

                html += '<div class="col-10 shop-detail-modal product__details__content__modal align-items-center">' +
                    '<div>' +
                    '<div>' +
                    '<div class="">' +
                    '<div class="product__details__text row align-items-center justify-content-between">' +
                    '<h4 class="col h4-product">' + response.name + '</h4>'


                if (response.discount != null) {
                    html += '<h3>$' + response.discount + ' <span>$' + response.price + '</span></h3>';
                } else {
                    html += '<h3 class="col-2">$' + response.price + ' <span></span></h3>';
                }

                html += '<div class="product__details__option col">' +
                    '<div class="product__details__option__size">' +
                    '<span>Size:</span>';

                response.sizes.forEach(function (size, index) {
                    var checked = (index === 0) ? 'checked' : '';
                    var activeClass = (checked === 'checked') ? 'active' : '';
                    html += '<label for="' + size + '" class="size ' + activeClass + '">' +
                        size +
                        '<input type="radio" name="size" id="' + size + '" value="' + size + '" ' + checked + '>' +
                        '</label>';
                });

                html += '</div>' +
                    '<div class="product__details__option__color__product">' +
                    '<span>Color:</span>';

                response.colors.forEach(function (color, index) {
                    var colorNumber = getColorNumber(color);
                    html += '<label class="c-' + colorNumber + '" for="quick-view-color-' + colorNumber + '">' +
                        '<input type="radio" name="quick-view-color" value="' + colorNumber + '" id="quick-view-color-' + colorNumber + '">' +
                        '</label>';
                });

                html += '</div>' +
                    '</div>' +
                    '<div class="product__details__cart__option col">' +
                    '<div class="quantity">' +
                    '<div class="pro-qty-2">' +
                    '<input id="product-qty" name="qty" type="text" value="1">' +
                    '</div>' +
                    '</div>' +
                    '<input type="hidden" id="product-id" value="' + response.id + '">' +
                    '<div id="add-to-cart-btn" class="primary-btn add-details">Update</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('#cart-quickview .modal-body-product').html(html);
                $('#cart-quickview').modal('show');

                // Cập nhật nền cho các ảnh
                $('.set-bg').each(function () {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });

                // Sự kiện change cho các radio button trong nhóm size
                $('input[name="size"]').change(function () {
                    $('label.size').removeClass('active');
                    $(this).closest('label.size').addClass('active');
                });

                // Sự kiện change cho các radio button trong nhóm màu sắc
                $('input[name="quick-view-color"]').change(function () {
                    // Loại bỏ class active từ tất cả các label trong nhóm màu sắc
                    $('label.color').removeClass('active');
                    // Thêm class active cho label chứa radio button được chọn
                    $(this).closest('label.color').addClass('active');
                });

                // Sự kiện click cho nút add to cart
                $('#add-to-cart-btn').click(function () {
                    var selectedSize = $('input[name="size"]:checked').val();
                    var selectedColor = $('input[name="quick-view-color"]:checked').val();
                    var quantity = $('#product-qty').val();
                    var productId = $('#product-id').val();
                    updateCart(productId, quantity, selectedSize, selectedColor,rowId);

                });
            },
            error: function (response) {
                console.log('Lỗi:', response);
            }
        });
    });


    function getColorNumber(color) {
        switch (color) {
            case 'black':
                return '1';
            case 'darkblue':
                return '2';
            case 'orange':
                return '3';
            case 'grey':
                return '4';
            case 'lightblack':
                return '5';
            case 'pink':
                return '6';
            case 'violet':
                return '7';
            case 'red':
                return '8';
            case 'white':
                return '9';
            default:
                return '';
        }
    }

    function updateCart(productId, qty, selectedSize, selectedColor, rowId) {
        if (!selectedSize) {
            alert('Please select a size.');
            return;
        }

        // Kiểm tra xem đã chọn color chưa
        if (!selectedColor) {
            alert('Please select a color.');
            return;
        }

        $.ajax({
            type: "POST",
            url: "cart/update-product",
            data: {productId: productId, qty: qty, size: selectedSize, color: selectedColor, rowId: rowId},
            success: function (response) {
                $('.cart-count').text(response.count);
                $('.price').text('$' + response.total);

                $('.show').remove();
                $('body').removeClass('modal-open');

                showCustomAlert('Update completed!');

                setTimeout(function (){
                    location.reload();
                },1500)

                console.log(response);
            },
            error: function (response) {
                showCustomAlert("Update failed. Please try again!");
                console.log(response);
            }
        });
    }
});


//************ CART VIEW SESSION END ************//














