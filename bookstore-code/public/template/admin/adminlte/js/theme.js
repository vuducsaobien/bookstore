// $(document).ready(function () {
//     var searchParams = new URLSearchParams(window.location.search);
//     var moduleName = searchParams.get('module');
//     var controllerName = searchParams.get('controller');

//     $('#filter-bar select[name=filter_group_acp]').change(function () {
//         $('#filter-bar').submit();
//     });

//     $('#btn-clear-search').click(function () {
//         $('input[name=search]').val('');
//     });
    
//     $('.btn-delete-item').click(function (e) {
//          var countCheckedInput = $('[name="checkbox[]"]:checked').length;
//          if(countCheckedInput<0){
//              alert('Vui Lòng Chọn Phần Tử Muốn Xóa');
//          }
//         e.preventDefault();
//         if (confirm("Bạn có muốn xóa không")) {
//             link = $(this).attr('href');
//             window.location.assign(link);
//         }
//     });
//     $('#bulk-apply').click(function () {
//         var action = $('#bulk-action').val();
//         var link = 'index.php?module=' + moduleName + '&controller=' + controllerName + '&action=';
//         var countCheckedInput = $('[name="checkbox[]"]:checked').length;
//         switch (action) {
//             case 'multi-active':
//                 link += 'active';
//                 if (countCheckedInput<0) {
//                  alert('Vui Lòng Chọn Phần Tử Muốn Xóa');
//                 }
//                 $('#form-table').attr('action', link);
//                 $('#form-table').submit();
//                 break;
//             case 'multi-inactive':
//                 link += 'inactive';
//                  if (countCheckedInput<0) {
//                  alert('Vui Lòng Chọn Phần Tử Muốn Xóa');
//                 }
//                 $('#form-table').attr('action', link);
//                 $('#form-table').submit();
//                 break;
//             case 'multi-delete':
//                 link += 'delete';
//                 if (countCheckedInput > 0) {
//                     if (confirm("Bạn có muốn xóa không ?")) {
//                          $('#form-table').attr('action', link);
//                          $('#form-table').submit();
//                     }
//                 }else{
//                     alert('Vui Lòng chọn ít nhất 1 dòng dữ liệu');
//                 }
//                 break;
//             default:
//                alert('Bạn Vui Lòng Chọn action thực hiện :');
//         }
//     });

//     setTimeout(function () {
//         $('#admin-message').fadeOut('slow');
//     }, 4000);
// });

// function submitForm(link) {
//     $('#admin-form').attr('action', link);
//     $('#admin-form').submit();
// }
