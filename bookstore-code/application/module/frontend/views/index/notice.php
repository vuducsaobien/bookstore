<?php
$module         = $this->arrParam['module'];

$message	= '';
switch ($this->arrParam['type']) {

	case 'not-permission':
		$message	= 'Bạn không có quyền truy cập vào chức năng đó!';
		$class		= 'danger';
	break;
	// Session::delete('user');

	case 'not-found':
		$warning	= '<h1>404</h1>';
		$message	= 'Đường dẫn không hợp lệ!';
		$class		= 'danger';
	break;


	case 'success-register':
		$message	= 'Tài khoản của bạn đã được tạo thành công. Xin vui lòng chờ kích hoạt từ người quản trị!';
		$warning	= '';
		$class		= 'success';
	break;

	case 'success-buy':
		$title 		= 'Mua Hàng Thành Công !!';
		$message 	= 'Cám Ơn Bạn Đã Mua Hàng Từ Shop.';
		$icon 		= '<i class="fa fa-cart-plus fa-5x my-text-primary"></i>';
		$class		= 'success';
	break;

	case 'success-login':
		$title 		= 'Đăng Nhập Thành Công !!';
		$message 	= 'Bạn Đã Đăng Nhập Thành Công !';
		$class		= 'success';
	break;
}

// Session::delete('user');
$linkHome       = URL::createLink($module, 'index', 'index', null, 'index.html');

?>

<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2"><?php echo $title;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="p-0">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="error-section">
					<?php echo $warning;?>
					<?php echo $icon;?>
					<h3 class="my-2 btn-<?php echo $class;?>"><?php echo $message; ?></h3>
					<a href="<?php echo $linkHome;?>" class="btn btn-solid">Quay lại trang chủ</a>
				</div>
			</div>
		</div>
	</div>
</section>