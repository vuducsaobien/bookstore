$(document).ready(function () {
    // activeMenu();

// DUC
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
    // $('.input-number').change(function (e) {
        // input = $(this)
        // id = input.data('id')
        // console.log(id)

        // let num=input.val();
        // console.log(num)

        // inputhidden = '#input_quantity_'+id;
        // console.log(inputhidden)

        // $(inputhidden).val(num);
        // priceAfter = $('h2.price-book'+id).html();
        // alert(priceAfter);
    // });

    // Change input cart number order
    $('.input-change-quantities').change(function () {
        $inputChange = $(this);
        let quantities = $(this).val();
        let id = $(this).data('id');
        // let url = rootURL + `index.php?module=${moduleName}&controller=${controllerName}&action=ajaxQuantitiesCart&id=${id}&quantities=${quantities}`;
        let url = `index.php?module=${moduleName}&controller=${controllerName}&action=ajaxQuantitiesCart&id=${id}&quantities=${quantities}`;
        console.log(url)

        // $('.changeQuantity').attr('href', url)


        $.get(url, function (data) {
            console.log(data);
            // $('.modified-' + data.id).html(data.modified);
            // $inputChange.notify('Cập nhật thành công!', {
            //     className: 'success',
            //     position: 'top center',
            // });
        });

    });


// DUC

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
});

function getUrlParam(key) {
    let searchParams = new URLSearchParams(window.location.search);
    return searchParams.get(key);
}

// DUC
function quickView(id)
{
    var link = rootURL + `index.php?module=${module}&controller=book&action=quickView&book_id=` + id;
    $.get(link, function(data)
        {
            // console.log(data)
            let originalPrice = data.price;
            let salePrice = data.sale_price;
            let xhtmlPrice = data.sale_off == 0 ? originalPrice : `${salePrice} <del>${originalPrice}</del>`;
            $('#quick-view .book-price').html(xhtmlPrice);
            $('h2.book-name').html(data.name)
            $('div.book-description').html(data.short_description)
            $('img.book-picture').attr('src', data.src_picture)
            $('.btn-view-book-detail').attr('href', data.link)
            // var buttonDetail = $('div.product-buttons #button-detail');
        }, 'json'
    );
};

function addToCart(link)
{
    var addCart = $('li.mobile-cart div a');
    $.get(link, function(data)
        {
            // console.log(data);
            $('li.mobile-cart div a span').html(data);
            showNotify(addCart, 'success-update');
        }, 
        'json'
    );
};

function showNotify($element, $type = 'success-update') {
    switch ($type) {
        case 'success-update':
            $element.notify('Cập nhật thành công!', {
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
