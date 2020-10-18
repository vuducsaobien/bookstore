<?php
$message	= '';
switch ($this->arrParam['type']) {
	case 'not-permission':
		$message	= 'Bạn không có quyền truy cập vào chức năng đó!';
		$class		= 'danger';
		$icon		= 'fas fa-exclamation-triangle';

	break;

	case 'not-found':
		$message	= 'Đường dẫn không hợp lệ!';
		$class		= 'warning';
		$icon		= 'fas fa-exclamation-triangle';
	break;

	case 'success-login':
		$message 	= 'Bạn Đã Đăng Nhập Thành Công !';
		$class		= 'success';
		$icon 		= 'far fa-check-circle';
	break;

}
// Session::delete('user');
$linkHome = URL::createLink($module, 'index', 'dashboard');

?>

<section class="content">
	<div class="container-fluid">
		<div class="alert alert-<?php echo $class;?> alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="<?php echo $icon;?>"></i> <?php echo $message;?></h5>
		</div>

		<a href="<?php echo $linkHome;?>" class="btn btn-sm btn-info mr-1">Back Home</a>
	</div>
</section>
