<?php
    $module     = $this->arrParam['module'];
    $controller = $this->arrParam['controller'];
    $action     = $this->arrParam['action'];
    $dataForm   = $this->arrParam['form']; 

    $email          = $this->info['email'];
    $emailUsername  = $this->info['username'];
    $modelPassword  = $this->info['new-password'];

    $newPassword    = Helper::randomString(8);

    // Input
    $inputEmail    = Helper::cmsInput('text', 'form[email]', 'form[email]', 'form-control', $dataForm['email'], null, null, null, null, 'vuducsaobien95@gmail.com');
    $inputToken    = Helper::cmsInput('hidden', 'form[token]', 'form[submit]', null,time()); 
    $btnSubmit   = Helper::cmsButton('button', 'Lấy Mật Khẩu', 'form[submit]', 'submit', 'btn btn-info', null, 'Đăng nhập');

    $linkForgotPass = URL::createLink('frontend', 'index', 'forgot');
    $btnForgot      = Helper::cmsButton('backend', 'Quên Mật Khẩu', null, null, 'btn btn-info btn-warning ml-3', $linkForgotPass);

    // Row
    $rowEmail      = HTML_Frontend::cmsRowForm('Email', $inputEmail, false, 'email', 'required', 'form-group');

    // Button
    $linkRegister   = URL::createLink($module, 'index', 'register', null, 'register.html');
    $linkAction    = URL::createLink($module, $controller, $action);
    $linkCancel     = URL::createLink($module, 'index', 'login', null, 'index.html');

    $btnCancel      = Helper::cmsButton('home', 'Cancel', null, 'button', 'btn btn-info btn-danger ml-3', $linkCancel);

    $rows = $rowEmail ;
    $buttons = $btnSubmit . $btnCancel ;


    /* ---- Send Mail Reset Password----- */
    use PHPMailer\PHPMailer\PHPMailer;

    if( $email != null && $emailUsername != null ){
        require 'vendor/autoload.php';

        $linkLogin = 'http://localhost/Laptop-PC/php03/project/bookstore/index.php?module=backend&controller=index&action=login';

        $content = "$emailUsername, your password at BookStore has been reset.
        You may now <a href=".$linkLogin.">log in</a> using your new password : <strong>$modelPassword</strong>";

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;                                

        $mail->Username   = 'vuducsaobien95@gmail.com';                    
        $mail->Password   = 'eamebfnacckryzyk';                    

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;                                  

        //Recipients
        $mail->setFrom('example@gmail.com', 'BookStore Mailer');
        $mail->addAddress($email, $emailUsername);   

        // Content
        $mail->isHTML(true); 
        $mail->Subject = 'BookStore - Password reset';
        $mail->Body    = $content;
        
        $mail->send();
        $messageSuccess = '<div>
    <h6 class="my-2 btn-success"> Đã gửi Mật Khẩu mới qua '.$email.' thành công !</h6>
    </div>';
    }


?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Quên Mật Khẩu ?</h2>
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
                    <?php echo $this->errors ; echo $messageSuccess; ?>

                    <form action="<?php echo $linkAction ;?>" method="post"

                        id="admin-form" class="theme-form">
                        <?php echo $rows . $buttons . $inputToken;?>
                        <input type="hidden" name="form[new-password]" value="<?php echo $newPassword;?>">
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
