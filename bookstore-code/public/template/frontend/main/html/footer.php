<?php
    $module         = $this->arrParam['module'];
    $controller     = $this->arrParam['controller'];
    $action         = $this->arrParam['action'];
    require_once PATH_LIBRARY . 'Model.php';
    $model      = new Model();
    $userObj         = Session::get('user');
    $userInfo        = $userObj['info'];

    
    $tableAs        = '`c`';
    $queryFooter[]  = "SELECT `c`.`id` AS `category_id`, `c`.`name`";
    $queryFooter[]  = "FROM `".TBL_CATEGORY."` AS `c`";
    $queryFooter[]  = "WHERE $tableAs.`status` = 'active' AND `c`.`special` = 1";
    $queryFooter[]  = "ORDER BY `c`.`ordering` ASC ";
    $queryFooter[]  = "LIMIT 0, 4";

    $queryFooter    = implode(" ", $queryFooter);
    $result		= $model->fetchAll($queryFooter);
    foreach($result as $value){
        $linkCategoryFooter = 'index.php?module='.$module.'&controller=book&action=list&category_id='.$value['category_id'].'';
        $special_cats .= '<li><a href="'.$linkCategoryFooter.'">'.$value['name'].'</a></li>';
    }
?>

<div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon">
    <div class="phonering-alo-ph-circle"></div>
    <div class="phonering-alo-ph-circle-fill"></div>
    <a href="tel:0362344174" class="pps-btn-img" title="Liên hệ">
        <div class="phonering-alo-ph-img-circle"></div>
    </a>
</div>

<footer class="footer-light mt-5">
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row footer-theme partition-f">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-title footer-mobile-title">
                        <h4>Giới thiệu</h4>
                    </div>
                    <div class="footer-contant">
                        <div class="footer-logo">
                            <h2 style="color: #5fcbc4">BookStore Đức</h2>
                        </div>
                        <p>Tự hào là website bán sách trực tuyến lớn nhất Việt Nam, cung cấp đầy đủ các thể loại
                            sách, đặc biệt với những đầu sách độc quyền trong nước và quốc tế</p>
                    </div>
                </div>

                <div class="col offset-xl-1">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>Danh mục nổi bật</h4>
                        </div>
                        <div class="footer-contant">
                            <ul><?php echo $special_cats ;?></ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>Chính sách</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li><a href="#">Điều khoản sử dụng</a></li>
                                <li><a href="#">Chính sách bảo mật</a></li>
                                <li><a href="#">Hợp tác phát hành</a></li>
                                <li><a href="#">Phương thức vận chuyển</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>Thông tin</h4>
                        </div>
                        <div class="footer-contant">
                            <ul class="contact-list">
                                <li><i class="fa fa-phone"></i>Hotline: <a href="tel:0362344174">036.234.4174 </a></li>
                                <li><i class="fa fa-envelope-o"></i>Email: <a href="mailto:vuducsaobien95@gmail.com" class="text-lowercase">vuducsaobien95@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="footer-end">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i> 2020 Vũ Văn Đức</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>