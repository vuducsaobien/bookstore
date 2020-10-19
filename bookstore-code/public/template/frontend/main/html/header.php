<!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
<?php
    $userObj        = Session::get('user');
    $userInfo       = $userObj['info'];
    $username       = $userInfo['username'];

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
                                <h2 class="mb-0" style="color: #5fcbc4">BookStore</h2>
                            </a>
                        </div>
                    </div>

                    <div class="menu-right pull-right">

                        <?php 
                            require_once 'main-nav.php';
                            require_once 'top-header.php';
                            require_once 'search-and-cart.php';
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>