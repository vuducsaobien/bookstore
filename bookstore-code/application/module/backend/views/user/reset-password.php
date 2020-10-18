<?php
$arrParam       = $this->arrParam;
$module         = $arrParam['module'];
$controller     = $arrParam['controller'];
$action         = $arrParam['action'];

// MESSAGE
$error = $this->errors;
if (!empty($error)) { echo $message = $error; } else { echo $message = HTML::showMessage(); }

$dataForm   = $this->arrParam['form'];
$userInfo = Session::get('user')['info'];

if($arrParam['id'] == $userInfo['id']){
    $inputOldPass   = Helper::cmsInput('text', 'form[old-password]', null, 'form-control form-control-sm mb-0');
    $inputNewPass   = Helper::cmsInput('text', 'form[new-password]', null, 'form-control form-control-sm mb-0');
    $rowOldPass     = HTML::rowChangePass('input', 'Old Password :', null, $inputOldPass);

    $rowUserName    = HTML::rowChangePass('p', 'Username :', $userInfo['username']);
    $rowEmail       = HTML::rowChangePass('p', 'Email :', $userInfo['email']);
    $rowFullName    = HTML::rowChangePass('p', 'Full Name :', $userInfo['fullname']);

}else{
    $newPassword    = Helper::randomString(8);
    $inputNewPass   = Helper::cmsInput('text', 'new-password', null, 'form-control form-control-sm mb-0', $newPassword, null, null, 'readonly');
    $linkChangePass = URL::createLink($module, $controller, 'reset_password');
    $btnChangePass  = Helper::cmsButton('button', 'Generate Password', 'generatepassword', null, 'btn btn-sm btn-info mt-1 btn-generate-password', $linkChangePass);

    $rowUserName    = HTML::rowChangePass('p', 'Username :', $dataForm['username']);
    $rowEmail       = HTML::rowChangePass('p', 'Email :', $dataForm['email']);
    $rowFullName    = HTML::rowChangePass('p', 'Full Name :', $dataForm['fullname']);
}

if (isset($this->arrParam['id']) || $dataForm['id']) {
    $action .= '&id='.$arrParam['id'];
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

if($this->sendMail==true){
    require 'vendor/autoload.php';
    $email			= '';
    $content		= '';
    $username 	 = $dataForm['username'];
    
    $linkLogin = 'http://localhost/Laptop-PC/php03/project/bookstore/index.php?module=backend&controller=index&action=login';
    $passwordEmail = $arrParam['new-password'];

    $content = "$username, your password at BookStore has been reset.
    You may now <a href=".$linkLogin.">log in</a> using your new password : <strong>$passwordEmail</strong>";

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP

    // $mailer->Host = ‘ssl://smtp.gmail.com:465′;
    $mail->Host       = 'smtp.gmail.com';                    	// Set the SMTP server to send through
    // $mail->Host       = 'ssl://smtp.gmail.com';                    	// Set the SMTP server to send through

    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication

    // $mail->Username   = $userInfo['email'];                     // SMTP username
    $mail->Username   = 'vuducsaobien95@gmail.com';                     // SMTP username
    // $mail->Username   = 'ducvuphp03@ducvuphp03.zdemo.xyz';                     // SMTP username
    $mail->Password   = 'eamebfnacckryzyk';                     // SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    // $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('example@gmail.com', 'BookStore Mailer');
    // $mail->addAddress($email, 'addAddress');     				// Add a recipient

    // $mail->addAddress($dataForm['email'], $dataForm['username']);   // Add a recipient
    $mail->addAddress('vuducsaobien94@gmail.com', 'username');   // Add a recipient


    // Content
    $mail->isHTML(true);                                  		    // Set email format to HTML
    $mail->Subject = 'BookStore - Password reset';
    $mail->Body    = $content;
    
    $mail->send();
}

?>

<div class="row">
    <div class="col">
        <form action="#" method="post" id="admin-form">
            <div class="card card-info card-outline">

                <div class="card-header">Reset Password</div>

                <div class="card-body">
                    <?php echo $rowUserName . $rowEmail . $rowFullName . $rowOldPass . $rowNewPass . $inputToken . $inputID;?>
                </div>

                <div class="card-footer">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <?php echo $btnSave . ' ' . $btnChangePass . ' ' . $btnCancel ;?>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
