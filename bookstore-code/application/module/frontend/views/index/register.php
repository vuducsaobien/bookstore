<?php
$module     = $this->arrParam['module'];
$controller = $this->arrParam['controller'];
$action     = $this->arrParam['action'];
$dataForm   = $this->arrParam['form']; 

// Input
$inputUserName = Helper::cmsInput('text', 'form[username]', 'form[username]', 'form-control', $dataForm['username']);
$inputPassword = Helper::cmsInput('text', 'form[password]', 'form[password]', 'form-control', $dataForm['password']);
$inputEmail    = Helper::cmsInput('text', 'form[email]', 'form[email]', 'form-control', $dataForm['email']);
$inputFullName = Helper::cmsInput('text', 'form[fullname]', 'form[fullname]', 'form-control', $dataForm['fullname']);

// $inputRegister = Helper::cmsInput('submit', 'form[submit]', 'form[submit]', 'register', 'register');
$inputToken    = Helper::cmsInput('hidden', 'form[token]', 'form[submit]', null,time()); 

// Row
$rowUserName   = HTML_Frontend::cmsRowForm('Tên Tài Khoản', $inputUserName, false, 'username', 'required');
$rowPassword   = HTML_Frontend::cmsRowForm('Mật Khẩu', $inputPassword, false, 'password', 'required');
$rowEmail      = HTML_Frontend::cmsRowForm('Email', $inputEmail, false, 'email', 'required');
$rowFullName   = HTML_Frontend::cmsRowForm('Họ & Tên', $inputFullName, false, 'fullname', null);
// $rowRegister   = HTML_Frontend::cmsRowForm('Fullname', $inputRegister . $inputToken, true);

// Button
$linkSave      = URL::createLink($module, $controller, $action, ['type' => 'save']);
$btnRegister   = Helper::cmsButton('button', 'Tạo tài khoản', 'form[submit]', 'submit', 'btn btn-solid', null, 'Tạo tài khoản');
$linkAction    = URL::createLink('frontend', 'index', 'register');
// $linkAction    = URL::createLink($module, $controller, 'register');


?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Đăng ký tài khoản</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="register-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Đăng ký tài khoản</h3>
                
                <div class="theme-card">
                    <?php echo $this->errors ;?>
                    <form action="<?php echo $linkAction;?>" method="post" id="admin-form" class="theme-form">
                        <div class="form-row">
                            <?php echo $rowUserName . $rowPassword . $rowEmail . $rowFullName ;?>
                        </div>
                        <?php echo $btnRegister . $inputToken ;?>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</section>