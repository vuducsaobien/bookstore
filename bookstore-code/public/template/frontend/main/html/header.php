<!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
<?php
require_once PATH_LIBRARY . 'Model.php';
$model      = new Model();
$userObj         = Session::get('user');
$userInfo        = $userObj['info'];
$username        = $userInfo['username'];

$module         = $this->arrParam['module'];
$controller     = $this->arrParam['controller'];
$action         = $this->arrParam['action'];
$imageURL       = $this->_dirImg;

$linkHome       = URL::createLink('frontend', 'index', 'index', null, 'index.html');
$linkCategory   = URL::createLink('frontend', 'category', 'index', null, 'category.html');
$linkBook       = URL::createLink('frontend', 'book', 'list', null, 'book.html');
$linkCart       = URL::createLink('frontend', 'user', 'cart', null, 'cart.html');
$linkMyAccount  = URL::createLink('frontend', 'user', 'index', null, 'my-account.html');
$linkAdmin      = URL::createLink('backend', 'index', 'dashboard');

$linkRegister   = URL::createLink('frontend', 'index', 'register', null, 'register.html');
$linkLogin      = URL::createLink('frontend', 'index', 'login', null, 'login.html');

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

$query[] = "SELECT `c`.`id` AS `category_id`, `c`.`name` AS `category_name`";
$query[] = "FROM `" . TBL_CATEGORY . "` AS `c`";
$query[] = "WHERE `c`.`status` = 'active'";
$query[] = "ORDER BY `ordering` ASC ";

$query        = implode(" ", $query);
$listCats   = $model->fetchAll($query);


$xhtmlCats  = '';
if (!empty($listCats)) {
    foreach ($listCats as $value) {
        $cateID = $value['category_id'];
        $cateNameURL    = URL::filterURL($value['category_name']);
        $link = URL::createLink('frontend', 'book', 'index', ['category_id' => $cateID], "$cateNameURL-$cateID.html");
        $xhtmlCats .= '<li><a href="' . $link . '">' . $value['category_name'] . '</a></li>';
    }
}

$classHome = '';
$classBook = '';
$classCategory = '';

if ($controller == 'index') $classHome = 'class="my-menu-link active"';
if ($controller == 'book') $classBook = 'class="my-menu-link active"';
if ($controller == 'category') $classCategory = 'class="my-menu-link active"';

$cart = Session::get('cart');
$totalItems = 0;
$totalPrices = 0;
$booksOrder = 0;
if (!empty($cart)) {
    $totalItems = array_sum($cart['quantity']);
    $totalPrices = array_sum($cart['price']);
    $booksOrder = $totalItems;
}
?>
<header class="my-header sticky">
    <div class="mobile-fix-option"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="brand-logo">
                            <a href="<?php echo $linkHome; ?>">
                                <h2 class="mb-0" style="color: #5fcbc4">BookStore Văn Đức</h2>
                            </a>
                        </div>
                    </div>

                    <div class="menu-right pull-right">
                        <div>
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                                    </li>
                                    <li><a href="<?php echo $linkHome; ?>" <?php echo $classHome; ?>>Trang chủ</a></li>
                                    <li><a href="<?php echo $linkBook; ?>" <?php echo $classBook; ?>>Sách</a></li>
                                    <li>
                                        <a href="<?php echo $linkCategory; ?>" <?php echo $classCategory; ?>>Danh mục</a>
                                        <ul><?php echo $xhtmlCats; ?></ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="top-header">
                            <ul class="header-dropdown">
                                <li class="onhover-dropdown mobile-account">
                                    <img src="<?php echo $imageURL; ?>/avatar.png" alt="avatar">
                                    <ul class="onhover-show-div"><?php echo $xhtml; ?></ul>
                                    <span class="badge badge-success"><?php echo $username ;?></span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div>
                                            <img src="<?php echo $imageURL; ?>/search.png" onclick="openSearch()" class="img-fluid blur-up lazyload" alt="">
                                            <i class="ti-search" onclick="openSearch()"></i>
                                        </div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div>
                                                <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">

                                                                <?php
                                                                $linkSearch = URL::createLink('frontend', 'book', 'list', ['search' => $this->arrParam['search']]);

                                                                ?>

                                                                <form action="book.html" method="GET">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="search" id="search-input" placeholder="Tìm kiếm sách..." value="<?php echo $this->arrParam['search']; ?>">

                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="onhover-div mobile-cart">
                                        <div>
                                            <a href="<?php echo $linkCart; ?>" id="cart" class="position-relative">
                                                <img src="<?php echo $imageURL; ?>/cart.png" class="img-fluid blur-up lazyload" alt="cart">
                                                <i class="ti-shopping-cart"></i>
                                                <span class="badge badge-warning"><?php echo $booksOrder; ?></span>
                                            </a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>