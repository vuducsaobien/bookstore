<?php
$newPassword    = Helper::randomString(8);
$arrParam       = $this->arrParam;
$arrForm        = $this->arrParam['form'];
$linkLogin      = URL::createLink('backend', 'index', 'login');
$btnCancel      = Helper::cmsButton('home', 'Quay Về', null, null, 'btn btn-danger btn-block', $linkLogin);
$email          = $arrForm['email'] ?? '1';
$emailExist     = $this->info['email_exist'];
$emailUsername  = $this->info['email_info']['username'];
    
$messageSuccess = '
    <div>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h5><i class="fas fa-check-circle"></i> Đã gửi mật khẩu mới cho '.$email.' thành công !!</h5>
        </div>
    </div>
';

$messageNotExist = '
    <div>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            
            <h5><i class="fas fa-exclamation-triangle"></i> Lỗi '.$email.' là Email Không Chính Xác!</h5>
        </div>
    </div>
';

$messageEmpty = '
    <div>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            
            <h5><i class="fas fa-exclamation-triangle"></i> Bạn vui lòng nhập email vào !</h5>
        </div>
    </div>
';


/* ---- Send Mail Reset Password----- */
use PHPMailer\PHPMailer\PHPMailer;

if( !empty($email) && !empty($arrForm['new-password']) && $emailExist=='1'){
    require 'vendor/autoload.php';

    $linkLogin = 'http://localhost/Laptop-PC/php03/project/bookstore/index.php?module=backend&controller=index&action=login';

    $content = "$emailUsername, your password at BookStore has been reset.
    You may now <a href=".$linkLogin.">log in</a> using your new password : <strong>{$arrForm['new-password']}</strong>";

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;                                

    $mail->Username   = 'vuducsaobien95@gmail.com';                    
    $mail->Password   = '4d87a76b2859ae053fe49659944a1734';                    
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
    echo $messageSuccess;
}elseif($emailExist=='0'){
    echo $messageNotExist;
}elseif($email==''){
    echo $messageEmpty;
}

?>
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Quên Mật Khẩu ?</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Lấy Lại Mật  Khẩu</p>

            <!-- ERROR -->
            <?php 
            // $error = $this->errors;

            // if (!empty($error)) { echo $message = $error; } else { echo $message ; }
            ?>
            
            <form action="<?php echo $linkAction ;?>" method="post" id="form-login">
                <!-- USERNAME -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Địa Chỉ Email" name="form[email]">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                
                <!-- TOKEN -->
                <input type="hidden" name="form[new-password]" value="<?php echo $newPassword;?>">
                <input type="hidden" name="form[token]" value="<?php echo time();?>">
                <button type="submit" class="btn btn-info btn-block">Lấy Password Mới</button>
                <?php echo $btnCancel;?>
                <!-- /.col -->
            </form>
        </div>

    </div>
    <!-- /.login-card-body -->
</div>