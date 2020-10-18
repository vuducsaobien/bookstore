<?php
$module     = $this->arrParam['module'];
$controller = $this->arrParam['controller'];
$action     = $this->arrParam['action'];
$dataForm   = $this->arrParam['form']; 
// Input
$inputPassword = Helper::cmsInput('text', 'form[password]', 'form[password]', 'form-control', $dataForm['password'], null, null, null, null, '123');
$inputEmail    = Helper::cmsInput('text', 'form[email]', 'form[email]', 'form-control', $dataForm['email'], null, null, null, null, 'vuducsaobien95@gmail.com');

$inputToken    = Helper::cmsInput('hidden', 'form[token]', 'form[submit]', null,time()); 
$btnSubmit   = Helper::cmsButton('button', 'Đăng nhập', 'form[submit]', 'submit', 'btn btn-info', null, 'Đăng nhập');

$linkForgotPass = URL::createLink('frontend', 'index', 'forgot');
$btnForgot      = Helper::cmsButton('backend', 'Quên Mật Khẩu', 'form[submit]', null, 'btn btn-info btn-warning ml-3', $linkForgotPass);

// Row
$rowEmail      = HTML_Frontend::cmsRowForm('Email', $inputEmail, false, 'email', 'required', 'form-group');
$rowPassword   = HTML_Frontend::cmsRowForm('Mật Khẩu', $inputPassword, false, 'password', 'required', 'form-group');

// Button
$linkRegister   = URL::createLink($module, 'index', 'register', null, 'register.html');
$linkAction    = URL::createLink($module, $controller, $action);
$linkCancel     = URL::createLink($module, 'index', 'index', null, 'index.html');

$btnCancel      = Helper::cmsButton('home', 'Cancel', null, 'button', 'btn btn-info btn-danger ml-3', $linkCancel);

$rows = $rowEmail . $rowPassword ;
$buttons = $btnSubmit . $btnForgot . $btnCancel ;

?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Đăng nhập </h2>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="login-page section-b-space">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-6">
                <h3>Đăng nhập</h3>
                <div class="theme-card">
                    <?php echo $this->errors ;?>

                    <form action="<?php echo $linkAction ;?>" method="post"

                        id="admin-form" class="theme-form">
                        <?php echo $rows . $buttons . $inputToken;?>
                    </form>

                </div>
            </div>

            <div class="col-lg-6 right-login">
                <h3>Khách hàng mới</h3>
                <div class="theme-card authentication-right">
                    <h6 class="title-font">Đăng ký tài khoản</h6>
                    <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
                        able to order from our shop. To start shopping click register.</p>
                    <a href="<?php echo $linkRegister ;?>" class="btn btn-info">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</section>
