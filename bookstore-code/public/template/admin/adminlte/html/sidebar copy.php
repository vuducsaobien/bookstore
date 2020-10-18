<?php
$module         = $this->arrParam['module'];
$controller     = $this->arrParam['controller'];
$action         = $this->arrParam['action'];

$userInfo	 = Session::get('user')['info'];
$userName    = $userInfo['username'];
$groupName   = $userInfo['name'];
$linkProfile        = URL::createLink($module, 'index', 'profile');

$linkDashboard      = URL::createLink($module, 'index', 'dashboard');
$linkGroupList      = URL::createLink($module, 'group', 'index');
$linkGroupForm      = URL::createLink($module, 'group', 'form');
$linkUserList       = URL::createLink($module, 'user', 'index');
$linkUserForm       = URL::createLink($module, 'user', 'form');
$linkCategoryList   = URL::createLink($module, 'category', 'index');
$linkCategoryForm   = URL::createLink($module, 'category', 'form');
$linkBookList       = URL::createLink($module, 'book', 'index');
$linkBookForm       = URL::createLink($module, 'book', 'form');
$linkCart           = URL::createLink($module, 'cart', 'index');
$linkSlide          = URL::createLink($module, 'slide', 'index');
$linkViewSite       = URL::createLink('frontend', 'index', 'index');
$linkLogout         = URL::createLink($module, 'index', 'logout');

$linkChangePassword = URL::createLink($module, 'user', 'reset_password', ['id' => $userInfo['id']]);

$IDchangePassUser = ($userInfo['id']) ?? $this->arrParam['id'];
$linkChangePassUser = URL::createLink($module, 'user', 'reset_password', ['id' => $IDchangePassUser]);

//user
$arrUser  = ['parent' =>['name' => 'User', 'icon' => 'user','link' => '#'],
             'child'  =>[
                            ['name' =>'List','icon' => 'list-ul','link' => $linkUserList],
                            ['name' => 'Form','icon' => 'edit','link' => $linkUserForm],
                            ['name' => 'Reset Pass User','icon' => 'unlock-alt','link' => $linkChangePassUser]
                        ]
            ];
$user       = HTML::createSidebar($controller,$action,$arrUser);


// Slide
$arrSlide = ['parent' => ['name' => 'Slide', 'icon' => 'images','link' => $linkSlide]
                 ];
$slide  = HTML::createSidebar($controller,$action,$arrSlide);


//dashboard
$arrDashboard = ['parent' => ['name' => 'Dashboard', 'icon' => 'tachometer-alt','link' => $linkDashboard]
                 ];
$dashboard  = HTML::createSidebar($controller,$action,$arrDashboard);

//Group
$arrGroup = ['parent' => ['name' => 'Group', 'icon' => 'users','link' => '#'],
             'child'  => [
                            ['name' =>'List','icon' => 'list-ul','link' => $linkGroupList],
                            ['name' => 'Form','icon' => 'edit','link' => $linkGroupForm]
                        ]
            ];
$group      = HTML::createSidebar($controller,$action,$arrGroup);

//Category
$arrCategory  = ['parent' =>['name' => 'Category', 'icon' => 'thumbtack','link' => '#'],
                 'child'  =>[
                                ['name' =>'List','icon' => 'list-ul','link' => $linkCategoryList],
                                ['name' => 'Form','icon' => 'edit','link' => $linkCategoryForm]
                            ]
                ];
$category   = HTML::createSidebar($controller,$action,$arrCategory);

//Book
$arrBook = ['parent' => ['name' => 'Book', 'icon' => 'book-open','link' => '#'],
            'child'  => [
                            ['name' =>'List','icon' => 'list-ul','link' => $linkBookList],
                            ['name' => 'Form','icon' => 'edit','link' => $linkBookForm]
                        ]
            ];
$book       = HTML::createSidebar($controller,$action,$arrBook);

//cart
$arrCart = ['parent' => ['name' => 'Cart', 'icon' => 'cart-plus','link' => $linkCart]
                 ];
$cart  = HTML::createSidebar($controller,$action,$arrCart);

//ChangePassWord
$arrChangePassWord = ['parent' => ['name' => 'Change Password', 'icon' => 'key','link' => $linkChangePassword]
                ];
$changePassword    = HTML::createSidebar($controller,$action,$arrChangePassWord);

// View Site
$arrViewSite = ['parent' => ['name' => 'View Site', 'icon' => 'eye','link' => $linkViewSite]
                ];
$viewSite    = HTML::createSidebar($controller,$action,$arrViewSite);

// View Logout
$arrLogout = ['parent' => ['name' => 'Logout', 'icon' => 'sign-out-alt','link' => $linkLogout]
                ];
$logout    = HTML::createSidebar($controller,$action,$arrLogout);

?>
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $linkProfile;?>" class="brand-link">
        <img src="<?php echo $this->_dirImg ?>/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $userName;?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $this->_dirImg ?>/default-user.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo $linkGroupList;?>" class="d-block"><?php echo $groupName . ' ' . $userName;?></a>
            </div>  
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php echo $dashboard . $group . $user . $category . $book . $cart . $slide . $changePassword . $viewSite . $logout; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>