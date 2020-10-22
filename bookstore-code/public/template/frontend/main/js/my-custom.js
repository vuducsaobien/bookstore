$(document).ready(function () {
    var searchParams = new URLSearchParams(window.location.search);
    var moduleName = searchParams.get('module');
    var controllerName = searchParams.get('controller');
    
    // Prevent delete button
	$('.btn-delete-item').click(function (e) {

        var btnDelete = $('.btn-delete-item a')
        e.preventDefault();

	    if (confirm("Bạn có muốn xóa phần tử này không ??")) {
            link = btnDelete.attr('href');
            console.log(link)
		    window.location.assign(link);
        }
       
    });

    $('.breadcrumb-section').css('margin-top', $('.my-header').height() + 'px');
    $('.my-home-slider').css('margin-top', $('.my-header').height() + 'px');

    // show more show less
    if ($('.category-item').length > 5) {
        $('.category-item:gt(5)').hide();
        $('#btn-view-more').show();
    }

    $('#btn-view-more').on('click', function () {
        // $('.category-item:gt(9)').toggle();
        $('.category-item:gt(6)').toggle();

        // $(this).text() === 'Xem thêm' ? $(this).text('Thu gọn') : $(this).text('Xem thêm');
        $(this).text() === 'Thu gọn' ? $(this).text('Xem thêm') : $(this).text('Thu gọn');

    });

    $('li.my-layout-view > img').click(function () {
        $('li.my-layout-view').removeClass('active');
        $(this).parent().addClass('active');
    });

    $('#sort-form select[name="sort"]').change(function () {

        if (getUrlParam('category_id')) {
            $('#sort-form').append(
                '<input type="hidden" name="category_id" value="' +
                    getUrlParam('category_id') +
                    '">'
            );
        }

        if (getUrlParam('filter_price')) {
            $('#sort-form').append(
                '<input type="hidden" name="filter_price" value="' +
                    getUrlParam('filter_price') +
                    '">'
            );
        }

        if (getUrlParam('search')) {
            $('#sort-form').append(
                '<input type="hidden" name="search" value="' +
                    getUrlParam('search') +
                    '">'
            );
        }

        $('#sort-form').submit();
    });

    setTimeout(function () {
        $('#frontend-message').toggle('slow');
    }, 4000);
    
    // Get old - current value before change event <input>
        $(document).on('focusin', '.input-change-quantities', function(){
            console.log("Saving value " + $(this).val());
            $(this).data('val', $(this).val());
        }).on('change','.input-change-quantities', function(){
            var prev = $(this).data('val');
            var current = $(this).val();
            console.log("Prev value " + prev);
            console.log("New value " + current);
        });

        // var previous_value;
        // $(".selectpicker").on('shown.bs.select', function(e) {
        //         previous_value = $(this).val();
        // }).change(function() {
        //     alert(previous_value);
        //     previous_value = $(this).val();
        // });
    // Get old - current value before change event <input>

    // Change input cart number order
    $('.input-change-quantities').change(function () {
        $inputChange = $(this);
        let quantity = $(this).val();
        let id = $(this).data('id');
        let url = `index.php?module=${moduleName}&controller=${controllerName}&action=ajaxquantityCart&id=${id}&quantity=${quantity}`;
        // console.log('id '+id)
        // console.log('quantity '+quantity)
        // console.log('url '+url)

        // $.get(url, function (data) {
        //     console.log('data ' +data);
        //     $('span.badge-warning').html(data);
        //     $('.modified-' + data.id).html(data.modified);
        //     $inputChange.notify('Cập nhật thành công!', {
        //         className: 'success',
        //         position: 'top center',
        //     });
        // });


        $.getJSON(url, function (data) {            
            console.log('data new_cart ' +data.new_cart)
            console.log('data old_cart ' +data.old_cart)
            quantityChange = data.new_cart - data.old_cart
            console.log('quantityChange ' +quantityChange)

            $('span.badge-warning').html(data.new_cart);
            $('.modified-' + data.id).html(data.modified);
            $inputChange.notify('Cập nhật thành công!', {
                className: 'success',
                position: 'top center',
            });

            var addCart = $('li.mobile-cart div a');
            showNotify(addCart, 'success-order', quantityChange);

        });


    });
    
});

function quickView(id)
{
    var link = rootURL + `index.php?module=${module}&controller=book&action=quickView&book_id=`+id;
    $.get(link, function(data)
        {
            // console.log(data)
            // console.log(data.id)
            let originalPrice = moneyFormat(data.price);
            let salePrice = moneyFormat(data.price_sale);
            let xhtmlPrice = data.sale_off == 0 ? originalPrice : `${salePrice} <del>${originalPrice}</del>`;

            $('#quick-view .book-price').html(xhtmlPrice);
            $('h2.book-name').html(data.name)
            $('div.book-description').html(data.short_description)
            $('img.book-picture').attr('src', data.src_picture)
            $('.btn-view-book-detail').attr('href', data.link)

            let addToCartLink = `javascript:addToCart(${data.id})`;
            $('#quick-view .btn-add-to-cart').attr('href', addToCartLink);
        }, 'json'
        // }
    );
};

function addToCart(id)
{
    // console.log('id '+id)
    // console.log('price_sale '+price_sale)

    let link = `${rootURL}index.php?module=${module}&controller=user&action=order&book_id=${id}`;
    // console.log('link '+link)

    var addCart = $('li.mobile-cart div a');
    let quantity = $('input[name=quantity]').val();
    link += '&quantity=' + quantity;
    console.log('link '+link)

    $.get(link, function (data) {
        console.log('data '+data)
        $('#cart span').html(data);
        showNotify(addCart, 'success-order', quantity);
    });

    $('#quick-view').modal('hide');
    $(".modal-backdrop").remove();

    $('input[name=quantity]').val(1);
};

function moneyFormat(value) {
    return new Intl.NumberFormat('vi-VI', {
        style: 'currency',
        currency: 'VND',
    }).format(value);
}

function getUrlParam(key) {
    let searchParams = new URLSearchParams(window.location.search);
    return searchParams.get(key);
}

function showNotify(element, type = 'success-update', quantity=1) {
    switch (type) {
        case 'success-update':
            $element.notify('Cập nhật thành công!', {
                className: 'success',
                position: 'top center',
            });
            break;
        case 'success-order':
            element.notify('Đã Thêm '+quantity+' Sản Phẩm Vào Giỏ Hàng!', {
                className: 'success',
                position: 'top center',
            });
            break;

    }
}

function submitFormBackend(url) {
	$('#admin-form').attr('action', url);
	$('#admin-form').submit();
}


// DUC
