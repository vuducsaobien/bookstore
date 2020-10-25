<?php
$arrParam       = $this->arrParam;
$module         = $arrParam['module'];
$controller     = $arrParam['controller'];
$action         = $arrParam['action'];

// MESSAGE
$error = $this->errors;
if (!empty($error)) {
    echo $message = $error;
} else {
    echo $message = HTML::showMessage();
}

$dataForm   = $this->arrParam['form'];
$userInfo = Session::get('user')['info'];

if ($arrParam['id'] == $userInfo['id']) {
    $inputOldPass   = Helper::cmsInput('text', 'form[old-password]', null, 'form-control form-control-sm mb-0');
    $inputNewPass   = Helper::cmsInput('text', 'form[new-password]', null, 'form-control form-control-sm mb-0');
    $rowOldPass     = HTML::rowChangePass('input', 'Old Password :', null, $inputOldPass);

    $rowUserName    = HTML::rowChangePass('p', 'Username :', $userInfo['username']);
    $rowEmail       = HTML::rowChangePass('p', 'Email :', $userInfo['email']);
    $rowFullName    = HTML::rowChangePass('p', 'Full Name :', $userInfo['fullname']);
} else {
    $newPassword    = Helper::randomString(8);
    $inputNewPass   = Helper::cmsInput('text', 'new-password', null, 'form-control form-control-sm mb-0', $newPassword, null, null, 'readonly');
    $linkChangePass = URL::createLink($module, $controller, 'reset_password');
    $btnChangePass  = Helper::cmsButton('button', 'Generate Password', 'generatepassword', null, 'btn btn-sm btn-info mt-1 btn-generate-password', $linkChangePass);

    $rowUserName    = HTML::rowChangePass('p', 'Username :', $dataForm['username']);
    $rowEmail       = HTML::rowChangePass('p', 'Email :', $dataForm['email']);
    $rowFullName    = HTML::rowChangePass('p', 'Full Name :', $dataForm['fullname']);
}

if (isset($this->arrParam['id']) || $dataForm['id']) {
    $action .= '&id=' . $arrParam['id'];
    $inputID       = Helper::cmsInput('hidden', 'form[id]', 'form[id]', 'form-control form-control-sm', $dataForm['id'], null, null, 'readonly');
}

// Input
$inputToken        = Helper::cmsInput('hidden', 'form[token]', 'form[token]', null, time());

// Link Button
$linkSave       = URL::createLink($module, $controller, $action, ['type' => 'save']);
$linkCancel     = URL::createLink($module, 'index', 'dashboard');
// Button
$btnSave           = Helper::cmsButton('noIcon', 'Save', null, null, 'btn btn-sm btn-success mt-1', $linkSave);
$btnCancel      = Helper::cmsButton('noIcon', 'Cancel', null, 'button', 'btn btn-sm btn-danger mt-1', $linkCancel);
// Row
$rowNewPass     = HTML::rowChangePass('input', 'New Password :', null, $inputNewPass);

/* ---- Send Mail Reset Password----- */

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;

$email            = '';
$content        = '';
$username      = $dataForm['username'];
$linkLogin = 'http://localhost/bookstore/bookstore-code/index.php?module=frontend&controller=index&action=login';
$passwordEmail = $arrParam['new-password'];
$content = "$username, your password at BookStore has been reset.
    You may now <a href=" . $linkLogin . ">log in</a> using your new password : <strong>$passwordEmail</strong>";

if ($this->sendMail == true) {
    require 'vendor/autoload.php';

// /*
    try {
        $mail = new PHPMailer(true);
        // $mail->isSMTP();                                            
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        // $mail->Host       = 'smtp.gmail.com';                        
        // $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'vuducsaobien95@gmail.com';             
        $mail->Password   = '4d87a76b2859ae053fe49659944a1734';

        // $mail->Port       = 465;
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   
        $mail->setFrom('example@gmail.com', 'BookStore Mailer');
        $mail->addAddress('vuducsaobien94@gmail.com', 'username');
        $mail->isHTML(true);
        $mail->Subject = 'BookStore - Password reset';
        $mail->Body    = $content;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

// */

}

?>

<div class="row">
    <div class="col">
        <form action="#" method="post" id="admin-form">
            <div class="card card-info card-outline">

                <div class="card-header">Reset Password</div>

                <div class="card-body">
                    <?php echo $rowUserName . $rowEmail . $rowFullName . $rowOldPass . $rowNewPass . $inputToken . $inputID; ?>
                </div>

                <div class="card-footer">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <?php echo $btnSave . ' ' . $btnChangePass . ' ' . $btnCancel; ?>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>