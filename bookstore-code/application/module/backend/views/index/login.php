<?php
$inputToken        = Helper::cmsInput('hidden', 'form[token]', 'form[token]', null, time());

$linkAction    = URL::createLink('backend', 'index', 'login');

$linkForgotPass = URL::createLink('backend', 'index', 'forgot');
$btnForgot           = Helper::cmsButton('backend', 'Quên Mật Khẩu', null, null, 'btn btn-danger btn-block', $linkForgotPass);

?>
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Admin</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Đăng nhập trang quản trị</p>
            <!-- ERROR -->
            <?php             
                $error = $this->errors;
                if (!empty($error)) { echo $message = $error; } else { echo $message = HTML::showMessage(); }
            ?>
            
            <form action="<?php echo $linkAction ;?>" method="post" id="form-login">
                <!-- USERNAME -->
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Tên đăng nhập" name="form[username]">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="form[password]">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                <!-- PASSWORD -->

                <!-- TOKEN -->
                    <button type="submit" class="btn btn-info btn-block">Đăng nhập</button>
                    <?php echo $btnForgot . $inputToken ;?>
                <!-- /.col -->
            </form>            

        </div>


    </div>
    <!-- /.login-card-body -->
</div>