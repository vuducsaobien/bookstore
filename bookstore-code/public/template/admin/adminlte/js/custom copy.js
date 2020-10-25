$(document).ready(function () {
    var searchParams = new URLSearchParams(window.location.search);
    var moduleName = searchParams.get('module');
    var controllerName = searchParams.get('controller');
    // /*
    // Prevent delete button
    $('.btn-delete-item').click(function () {

        // $('.btn-delete-item').click(function (e) {
        // var countCheckedInput = $('[name="checkbox[]"]:checked').length;

        // if(countCheckedInput<0){
        // 	alert('Vui Lòng Chọn Phần Tử Muốn Xóa');
        // }
        // e.preventDefault();

        // if (confirm
        //     ("Bạn có muốn xóa phần tử này không ??")
        // ) {
        //    link = $(this).attr('href');
        //    window.location.assign(link);
        // }

        // Swal.fire(confirmObj('Bạn chắc chắn muốn xóa dòng dữ liệu này?', 'error', 'Xóa')).then(
        // Swal.fire(confirm('Bạn chắc chắn muốn xóa dòng dữ liệu này?', 'error', 'Xóa')).then(

        // (result) => {
        //     if (result.value) {
        //         let moduleName = getUrlParam('module');
        //         let controllerName = getUrlParam('controller');
        //             // window.location.href = `index.php?module=${moduleName}&controller=${controllerName}&action=delete&id=${id}`;
        //         }
        //     }
        // );


    });

    // */

    // AJAX FILTER GROUP ACP SELECT BOX CHECK
    $('#filter-bar select[name=filter_group_acp]').change(function () {
        $('#filter-bar').submit();
    });

    // AJAX FILTER GROUP SELECT BOX CHECK USER
    $('#filter-bar select[name=filter_group_id]').change(function () {
        $('#filter-bar').submit();
    });

    // AJAX FILTER CATEGORY
    $('#filter-bar select[name=filter_category_id]').change(function () {
        $('#filter-bar').submit();
    });

    // AJAX FILTER SPECIAL
    $('#filter-bar select[name=filter_special]').change(function () {
        $('#filter-bar').submit();
    });

    // Change ordering event
    $('.chkOrdering').change(function () {
        var chkOrdering = $(this);
        let ordering = $(this).val();
        let id = $(this).data('id');

        let url = `index.php?module=${moduleName}&controller=${controllerName}&action=changeState&id=${id}&ordering=${ordering}`;

        $.get(url, function (data) {
            if (data.state > 0) {
                $('.modified-' + data.id).html(data.modified);
                chkOrdering.attr('href', data.link);
                showNotify(chkOrdering, 'success-update');
            }
        }, 'json');

    });

    $('.my-btn-state').click(function (e) {
        var myBtnState = $(this);
        var url = $(this).attr('href');

        $.get(url, function (data) {
            if (data.state == 1 || data.state == 'active') {
                myBtnState.removeClass('btn-danger');
                myBtnState.addClass('btn-success');
                myBtnState.find('i').attr('class', 'fas fa-check');
            } else {
                myBtnState.removeClass('btn-success');
                myBtnState.addClass('btn-danger');
                myBtnState.find('i').attr('class', 'fas fa-minus');
            }

            $('.modified-' + data.id).html(data.modified);
            myBtnState.attr('href', data.link);
            showNotify(myBtnState, 'success-update');
        }, 'json');

        e.preventDefault()
    });

    // Change Password Button
    $('.btn-generate-password').click(function (e) {
        e.preventDefault()
        var newString = randomString()
        $('input[name="new-password"]').val(newString);
    })

    // Check all
    $('#check-all').change(function () {
        var checkStatus = this.checked;
        $('#form-table input[name="checkbox[]"]').each(function () {
            this.checked = checkStatus;
        });
        showSelectedRowInBulkAction();
    });

    // Number Check All
    $('#form-table input[name="checkbox[]"]').change(function () {
        showSelectedRowInBulkAction();
    });

    // Clear Search
    $('#btn-clear-search').click(function () {
        $('input[name=search]').val('');
    });

    // Change group event    
    $('[name="slb_group_id"]').change(function () {
        $currentSelectGroup = $(this);
        let groupId = $(this).val();
        let userId = $(this).data('id');
        var url = 'index.php?module=' + moduleName + '&controller=' + controllerName + `&action=ajaxChangeGroup&id=${userId}&group_id=${groupId}`;

        $.get(url, function (data) {
            $('.modified-' + data.id).html(data.modified);
            // showToast('success', 'edit');
            $currentSelectGroup.notify('Cập nhật thành công!', {
                className: 'success',
                position: 'top center',
            });
        },
            'json'
        );
    });

    // Change category event    
    $('[name="slb_category_id"]').change(function () {
        $currentSelectGroup = $(this);
        let category_id = $(this).val();
        let userId = $(this).data('id');
        var url = 'index.php?module=' + moduleName + '&controller=' + controllerName + `&action=ajaxChangeCategory&id=${userId}&category_id=${category_id}`;

        $.get(
            url,
            function (data) {
                $('.modified-' + data.id).html(data.modified);
                // showToast('success', 'edit');
                $currentSelectGroup.notify('Cập nhật thành công!', {
                    className: 'success',
                    position: 'top center',
                });
            },
            'json'
        );
    });

    // Bulk Acion Multi Acion
    $('#bulk-apply').click(function () {
        var action = $('#bulk-action').val();
        // var link = `index.php?module=${moduleName}&controller=${controllerName}&action=`;
        var checkbox = $('#form-table input[name="checkbox[]"]:checked');
        let lstID = [];
        checkbox.each(function () {
            lstID.push($(this).val());
        });    
        // console.log('link ' +link);

        if(checkbox.length > 0){
            switch (action) {
                case 'multi-active': showConfirmBulkAction(moduleName, controllerName, 'multi_active'); break;
                case 'multi-inactive': showConfirmBulkAction(moduleName, controllerName, 'multi_inactive'); break;
                case 'multi-special': showConfirmBulkAction(moduleName, controllerName, 'multi_special'); break;
                case 'multi-unspecial': showConfirmBulkAction(moduleName, controllerName, 'multi_unspecial'); break;
                
                case 'multi-delete':
                    switch (controllerName) {
                        case 'user':    case 'book':    case 'slide':
                            showConfirmBulkAction(moduleName, controllerName, 'multi_delete', 'delete'); 
                        break;

                        default:
                            switch (controllerName) {
                                case 'group':    
                                    message = `Các User thuộc các Group này cũng sẽ được xóa theo.<br/>`;
                                    break;
                                case 'category':
                                    message = `Các Sách thuộc các Danh mục này cũng sẽ được xóa theo.<br/>`;
                                    break;
                            }

                            // showConfirmBulkAction(moduleName, controllerName, 'multi_delete', 'delete');
                            // message += 'Nhập mật khẩu để tiếp tục!';
                            // console.log(message);

                            // let obj = confirmObj(message, 'error', 'Xóa');
                            // obj = showPreConfirmDelete(obj);

                            // Swal.fire(obj).then((result) => {
                            //     if (result.value) {
                            //         $('#form-table').attr('action',
                            //             `index.php?module=${moduleName}&controller=${controllerName}&action=multi_delete`
                            //         );
                            //         $('#form-table').submit();
                            //     }
                            // });
    
                        break;
                    };
                break;
                default:    showToast('warning', 'bulk-action-not-selected-action');    break;
            }

        }else{
            showToast('warning', 'bulk-action-not-selected-row')
        }
    });

    
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timerProgressBar: true,
    timer: 5000,
    padding: '2rem',
});

function confirmObj(text, icon, confirmText) {
    return {
        position: 'center',
        title: 'Thông báo!',
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmText,
        cancelButtonText: 'Hủy',
    };
};

function showPreConfirmDelete(obj) {
    obj.input = 'password';
    obj.inputAttributes = {
        autocapitalize: 'off',
        autocomplete: 'new-password',
    };
    obj.preConfirm = (password) => {
            console.log ('password '+password);

        if (password == '') {
            return Swal.showValidationMessage('Vui lòng nhập khẩu!');
        } else {
            let checkPasswordURL = `index.php?module=admin&controller=user&action=checkPassword&password=${password}`;
            return $.get(checkPasswordURL, function (data) {
                if (data) {
                    console.log('success');
                } else {
                    return Swal.showValidationMessage('Mật khẩu không chính xác!');
                }
            });
        }
    };

    // return obj;
    console.log ('obj '+obj);
}


function deleteItems(id) {
    let module = getUrlParam('module');
    let controller = getUrlParam('controller');
    
    switch (controller) {
        case 'user':
        case 'book':
        case 'slide':
            Swal.fire(confirmObj('Bạn chắc chắn muốn xóa dòng dữ liệu này?', 'error', 'Xóa')).then(
                (result) => {
                    if (result.value) {
                        window.location.href = `index.php?module=${module}&controller=${controller}&action=multi_delete&id=${id}`;
                    }
                }
            );
        default:
            console.log('sss');
            break;
    }
};

function showConfirmBulkAction(module, controller, action, type = 'update', params = []) {
    let obj;
    switch (type) {
        case 'update':
            obj = confirmObj('Cập nhật các dòng dữ liệu đã chọn?', 'info', 'Cập nhật');
            break;
        case 'delete':
            obj = confirmObj('Xóa các dòng dữ liệu đã chọn?', 'error', 'Xóa');
            break;
    }

    Swal.fire(obj).then((result) => {
        if (result.value) {
            $('#form-table').attr(
                'action',
                `index.php?module=${module}&controller=${controller}&action=${action}`
            );
            $('#form-table').submit();
        }
    });
    
}



function getUrlParam(key) {
    let searchParams = new URLSearchParams(window.location.search);
    return searchParams.get(key);
}

function submitForm(url) {
    $('#admin-form').attr('action', url);
    $('#admin-form').submit();
}

function submitFormBackend(url) {
    $('#form-login').attr('action', url);
    $('#form-login').submit();
}

function sortList(column, order) {
    $('input[name=sort_field]').val(column);
    $('input[name=sort_order]').val(order);

    let exceptParams = ['page', 'sort_field', 'sort_order'];
    let link = createLink(exceptParams);

    link += `sort_field=${column}&sort_order=${order}`;
    window.location.href = link;

}

function createLink(exceptParams) {
    let pathname = window.location.pathname;
    let searchParams = new URLSearchParams(window.location.search);
    let searchParamsEntries = searchParams.entries();

    let link = pathname + '?';
    for (let pair of searchParamsEntries) {
        if (exceptParams.indexOf(pair[0]) == -1) {
            link += `${pair[0]}=${pair[1]}&`;
        }
    }
    return link;
}

function randomString() {
    var stringRandom = Math.random().toString(36).slice(-10);
    return stringRandom;
}

function checkCountInput(countCheckInput) {
    if (countCheckInput <= 0) {
        alert("Chọn ít nhất 1 ô dữ liệu!")
        returnToPreviousPage();
    }
}

function showSelectedRowInBulkAction() {
    let checkbox = $('#form-table input[name="checkbox[]"]:checked');
    let navbarBadge = $('#bulk-apply .navbar-badge');
    if (checkbox.length > 0) {
        navbarBadge.html(checkbox.length);
        navbarBadge.css('display', 'inline');
    } else {
        navbarBadge.html('');
        navbarBadge.css('display', 'none');
    }
}

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

function showToast(type, action) {
    let message = '';
    switch (action) {
        case 'update':                          message = 'Cập nhật thành công!';                   break;
        case 'bulk-action-not-selected-action': message = 'Vui lòng chọn action cần thực hiện!';    break;
        case 'bulk-action-not-selected-row':    message = 'Vui lòng chọn ít nhất 1 dòng dữ liệu!';  break;
    }

    Toast.fire({
        icon: type,
        title: ' ' + message,
    });
}






