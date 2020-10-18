<?php
// HEAD
require_once 'elements/head.php';

$dataForm       = $this->arrParam['form']; 
if($this->arrParam['form']['token'] > 0 ) $dataForm = $this->arrParam['form'];
// Input
$inputToken        	= Helper::cmsInput('hidden', 'form[token]', 'form[token]', null, time());
$inputID       = Helper::cmsInput('hidden', 'form[id]', 'form[id]', 'form-control form-control-sm', $userInfo['id']);

$inputOldPass   	= Helper::cmsInput('text', 'form[old-password]', null, 'form-control form-control-sm mb-0', $dataForm['old-password']);
$inputNewPass   	= Helper::cmsInput('text', 'form[new-password]', null, 'form-control form-control-sm mb-0', $dataForm['new-password']);

// Link Button
$linkCancel     = URL::createLink($module, 'user', 'index', null, 'my-account.html');

// Button
$btnSubmit 		= Helper::cmsButton('button', 'Cập nhật mật khẩu', 'submit', 'submit', 'btn btn-info  btn-info ', null, 'Cập nhật mật khẩu');
$btnCancel      = Helper::cmsButton('home', 'Cancel', null, 'button', 'btn btn-info btn-danger ml-3', $linkCancel);

// Row
$rowOldPass     = HTML_Frontend::cmsRowForm('Mật Khẩu Cũ', $inputOldPass, false, 'old-password', null, 'form-group');
$rowNewPass     = HTML_Frontend::cmsRowForm('Mật Khẩu Mới', $inputNewPass, false, 'new-password', null, 'form-group');

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
						<form action="#" method="post" id="admin-form" class="theme-form">
							<?php 
								if (!empty($error)) { echo $message = $error;} else { echo $message = HTML::showMessage();}
								echo $rowOldPass . $rowNewPass . $inputToken . $inputID;
								echo $btnSubmit . $btnCancel;?>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>