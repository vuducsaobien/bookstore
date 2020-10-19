<?php
    require_once PATH_LIBRARY . 'Model.php';
    $model          = new Model();

    $query[] = "SELECT `c`.`id` AS `category_id`, `c`.`name` AS `category_name`";
    $query[] = "FROM `" . TBL_CATEGORY . "` AS `c`";
    $query[] = "WHERE `c`.`status` = 'active'";
    $query[] = "ORDER BY `ordering` ASC ";

    $query      = implode(" ", $query);
    $listCats   = $model->fetchAll($query);

    ($controller == 'index') ? $classHome = 'class="my-menu-link active"' : '';
    ($controller == 'book') ? $classBook = 'class="my-menu-link active"' : '';
    ($controller == 'category') ? $classCategory = 'class="my-menu-link active"' : '';

    $xhtmlCats  = '';
    if (!empty($listCats)) {
        foreach ($listCats as $value) {
            $cateID = $value['category_id'];
            $cateNameURL    = URL::filterURL($value['category_name']);
            $link = URL::createLink('frontend', 'book', 'index', ['category_id' => $cateID], "$cateNameURL-$cateID.html");
            $xhtmlCats .= '<li><a href="' . $link . '">' . $value['category_name'] . '</a></li>';
        }
    }


?>
                        
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
