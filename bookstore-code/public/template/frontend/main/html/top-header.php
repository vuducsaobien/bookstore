<?php
    $arrayMenu        = [];
    if ($userInfo['group_acp'] == 1 && $userInfo['status'] == 'active') {
        $arrayMenu[] = ['link' => $linkAdmin,   'name' => 'Trang Quản Trị'];
    }

    if ($userObj['login'] == false) {
        $arrayMenu[] = ['link' => $linkLogin,     'name' => 'Đăng nhập'];
        $arrayMenu[] = ['link' => $linkRegister, 'name' => 'Đăng ký'];
    } else {
        $arrayMenu[] = ['link' => $linkMyAccount,   'name' => 'Thông tin của tôi'];
        $arrayMenu[] = ['link' => URL::createLink('frontend', 'index', 'logout'),      'name' => 'Đăng Xuất'];
    }

    foreach ($arrayMenu as $menu) {
        $xhtml .= '
            <li><a href="' . $menu['link'] . '">' . $menu['name'] . '</a></li>
        ';
    }



?>

<div class="top-header">
    <ul class="header-dropdown">
        <li class="onhover-dropdown mobile-account">
            <img src="<?php echo $imageURL; ?>/avatar.png" alt="avatar">
            <ul class="onhover-show-div"><?php echo $xhtml; ?></ul>
            <span class="badge badge-success"><?php echo $username ;?></span>
        </li>
    </ul>
</div>

