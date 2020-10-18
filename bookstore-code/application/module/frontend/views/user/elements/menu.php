<div class="col-lg-3">
	<div class="account-sidebar">
		<a class="popup-btn">Menu</a>
	</div>

	<h3 class="d-lg-none">Tài khoản</h3>
	<div class="dashboard-left">
		<div class="collection-mobile-back">
			<span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> Ẩn</span>
		</div>
		<div class="block-content">
			<ul>
				<li <?= $classInfoAccount; ?>><a href="<?= $linkMyAccount; ?>">Thông tin tài khoản</a></li>
				<li <?= $classChangePass; ?>><a href="<?= $linkChangePass; ?>">Thay đổi mật khẩu</a></li>
				<li <?= $classHistory; ?>><a href="<?= $linkHistory; ?>">Lịch sử mua hàng</a></li>
				<li><a href="<?= $linkLogout; ?>">Đăng xuất</a></li>
			</ul>
		</div>
	</div>
</div>