<?php
// HEAD
require_once 'elements/head.php';

$dataForm = $this->arrParam['form'];
// Input
$inputEmail         = Helper::cmsInput('text', 'form[email]', 'form[email]', 'form-control', $dataForm['email'], null, null, 'readonly');
$inputFullName     = Helper::cmsInput('text', 'form[fullname]', 'form[fullname]', 'form-control', $dataForm['fullname']);
$inputPhone     = Helper::cmsInput('number', 'form[phone]', 'form[phone]', 'form-control', $dataForm['phone']);
$inputAddress     = Helper::cmsInput('text', 'form[address]', 'form[address]', 'form-control', $dataForm['address']);
$inputToken        = Helper::cmsInput('hidden', 'form[token]', 'form[token]', null, time());

// Link Button
$linkCancel     = URL::createLink($module, 'index', 'index', null, 'index.html');

// Button
$btnSubmit 		= Helper::cmsButton('button', 'Cập nhật thông tin', 'submit', 'submit', 'btn btn-info', null, 'Cập nhật mật khẩu');
$btnCancel      = Helper::cmsButton('home', 'Cancel', null, 'button', 'btn btn-info btn-danger ml-3', $linkCancel);

// Row
$rowEmail         = HTML_Frontend::cmsRowForm('Email', $inputEmail, false, 'email', null, 'form-group');
$rowFullName       = HTML_Frontend::cmsRowForm('Họ Tên', $inputFullName, false, 'fullname', null, 'form-group');
$rowPhone           = HTML_Frontend::cmsRowForm('Số Điện Thoại', $inputPhone, false, 'phone', 'required', 'form-group');
$rowAddress       = HTML_Frontend::cmsRowForm('Địa Chỉ', $inputAddress, false, 'address', null, 'form-group');

$rows 	 = $rowEmail . $rowFullName . $rowPhone . $rowAddress ;
$buttons = $btnSubmit . $btnCancel ;
?>

<!-- TITLE -->
<?php require_once 'elements/title.php' ;?>

<section class="faq-section section-b-space">
	<div class="container">
		<div class="row">

			<!-- MENU -->
			<?php require_once 'elements/menu.php' ;?>

			<div class="col-lg-9">
				<div class="dashboard-right">
					<div class="dashboard">
						<form action="" method="post" id="admin-form" class="theme-form">
							<?php 
								if (!empty($error)) { echo $message = $error;} else { echo $message = HTML::showMessage();}
								echo $rows . $buttons . $inputToken;
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>