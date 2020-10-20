<?php
$module     = $this->arrParam['module'];
$controller = $this->arrParam['controller'];
$action     = $this->arrParam['action'];
$imageURL   = $this->_dirImg;

// Books RELATE
if(!empty($this->book_Relate)){
	foreach($this->book_Relate as $item){
        $divStart       = '<div class="col-xl-2 col-md-4 col-sm-6">';
        $divEnd         = '</div>';
        $booksRelate   .= HTML_Frontend::showProductBox($item, true, false, true, $divStart, $divEnd, 'all');
	}
}

$booksNews = HTML_Frontend::createSlide($this->books_News, 3);
$booksSpecial = HTML_Frontend::createSlide($this->books_Special, 3);

?>

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2">Chi Tiết Sách: <?php echo $this->bookInfo['name'].'.' ;?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section-b-space">
    <div class="collection-wrapper">
        <div class="container">
            
            <div class="row">
                <?php require_once 'elements/book_info.php'; ?>

                <div class="col-sm-3 collection-filter">
                    <?php require_once PATH_BLOCK . 'detail-service.php'; ?>

                    <!-- Sách nổi bật  -->
                    <div class="theme-card">
                        <h5 class="title-border">Sách nổi bật</h5>
                        <div class="offer-slider slide-1">
                            <?php echo $booksSpecial ;?>
                        </div>
                    </div>
                    
                    <!-- Sách mới -->
                    <div class="theme-card mt-4">
                        <h5 class="title-border">Sách mới</h5>
                        <div class="offer-slider slide-1">
                            <?php echo $booksNews;?>
                        </div>
                    </div>
                    
                </div>
                
            </div>

            <!-- Sản phẩm liên quan -->
            <div class="row">
                <section class="section-b-space j-box ratio_asos pb-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 product-related">
                                <h2>Sản phẩm liên quan</h2>
                            </div>
                        </div>
                        <div class="row search-product">
                            <?php echo $booksRelate ;?>
                        </div>
                </section>
                <?php require_once 'elements/addtocart.php'; ?>
            </div>
        </div>
    </div>
</section>
