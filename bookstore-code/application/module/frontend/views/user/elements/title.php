<?php
$classActive 		= 'class="active"';
$classInfoAccount 	= '';
$classChangePass 	= '';
$classHistory 		= '';

if($action == 'index'){
	$title = 'My Account Form :: Thông Tin Tài khoản';
	$classInfoAccount = $classActive;

}elseif($action == 'reset_password'){
	$title = 'My Account Form :: Thay đổi mật khẩu';
	$classChangePass = $classActive;
	
}elseif($action == 'history'){
	$title = 'My Account Form :: Lịch sử mua hàng';
	$classHistory = $classActive;

}elseif($action == 'cart'){
	$title = 'Giỏ Hàng';
	$classHistory = $classActive;
}

?>
<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title">
					<h2 class="py-2"><?php echo $title ;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>
