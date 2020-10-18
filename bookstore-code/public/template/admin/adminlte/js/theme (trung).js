$(document).ready(function () {
    var searchParams = new URLSearchParams(window.location.search);
    var moduleName = searchParams.get('module');
    var controllerName = searchParams.get('controller');

    $('select[name="select-group"]').change(function(){
        alert($(this).attr('id') + $(this).val())
    })

    $('.btn-random-string').click(function(e){
        e.preventDefault()
        var newString = randomString()
        $('#password').val(newString);
    })

    $('.btn-delete-item').click(function(e){
        var conf = confirm("Bạn có chắc chắn muốn xóa!");
        if(conf == false)
        {
            e.preventDefault();
        }
    })

    $('#filter-bar select[name=filter_group_acp]').change(function () {
        $('#filter-bar').submit();
    });

    $('#filter-bar select[name=filter_group_id]').change(function () {
        $('#filter-bar').submit();
    });

    $('#btn-clear-search').click(function () {
        $('input[name=search]').val('');
    });

    $('input[id=check-all]').change(function(){
        var checkStatus = this.checked;
        $('#form-table').find('input[name="checkbox[]"]').each(function(){
            this.checked = checkStatus;
        })
    })

    $('#bulk-apply').click(function () {
        var action = $('#bulk-action').val();
        var link = 'index.php?module=' + moduleName + '&controller=' + controllerName + '&action=';
        var countCheckInput = $('[name="checkbox[]"]:checked').length

        switch (action) {
            case 'multi-active':
                link += 'active';
                break;
            case 'multi-inactive':
                link += 'inactive';
                break;
            case 'multi-delete':
                link += 'delete';
                break;
            default:
                alert("Vui lòng chọn action")
                returnToPreviousPage();
                break;
        }
        checkCountInput(countCheckInput)
        $('#form-table').attr('action', link);
        $('#form-table').submit();
    });

    setTimeout(function () {
        $('#admin-message').fadeOut('slow');
    }, 4000);
});

function checkCountInput(countCheckInput)
{
    if(countCheckInput <= 0)
    {
        alert("Chọn ít nhất 1 ô dữ liệu!")
        returnToPreviousPage();
    }
}

function submitForm(link) {
    $('#admin-form').attr('action', link);
    $('#admin-form').submit();
}

function randomString()
{
    var stringRandom = Math.random().toString(36).slice(-10);
    return stringRandom;
}