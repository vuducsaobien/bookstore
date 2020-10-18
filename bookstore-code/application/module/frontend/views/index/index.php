<?php 
$imageURL       = $this->_dirImg;
$module         = $this->arrParam['module'];
$controller     = $this->arrParam['controller'];
$action         = $this->arrParam['action'];

// echo '<pre>$this->categoriesSpecial ';
// print_r($this->categoriesSpecial);
// echo '</pre>';

if(!empty($this->booksSpecial)){
	foreach($this->booksSpecial as $book){
		$booksSpecial .= HTML_Frontend::showProductBox($book, true, false, false, null, null, 'all');
	}
}

// Slides
if(!empty($this->slides)){
    foreach($this->slides as $item){
        $classImage     = 'bg-img blur-up lazyload';
        $linkSlide      = $item['link'];
        $srcPicture     = HTML_Frontend::getSrcPicture($item['picture'], TBL_SLIDE);
        $picture        = HTML_Frontend::showProductImage($link, $srcPicture, $item['name'], $classImage, false);

        $xhtmlSlides .= '
        <div>
            <a href="'.$linkSlide.'" class="home text-center">
                <img src="'.$srcPicture.'" alt="'.$item['name'].'" class="bg-img blur-up lazyload">
            </a>
        </div>
        ';
    }
}else{
    $xhtmlSlides = '';
}

?>

<!-- Home slider -->
<section class="p-0 my-home-slider">
    <div class="slide-1 home-slider">
        <?php echo $xhtmlSlides;?>
    </div>
</section>
<!-- Home slider end -->

<!-- Title-->
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Sản phẩm nổi bật</h2>
    <hr role="tournament6">
</div>

<!-- Product slider -->
<section class="section-b-space p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="product-4 product-m no-arrow">
                    <?php echo $booksSpecial ;?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product slider end -->

<!-- Giao hàng miễn phí -->
<?php require_once 'elements/service_layout.php';?>

<!-- Danh mục nổi bật -->
<?php require_once 'elements/books-categories.php';?>

<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>

                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img"><img src="" alt="" class="w-100 img-fluid blur-up lazyload book-picture"></div>
                    </div>

                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <h2 class="book-name"></h2>

                            <h3 class="book-price">
                                <del></del>
                            </h3>

                            <div class="border-product">
                                <div class="book-description"></div>
                            </div>

                            <div class="product-description border-product">
                                <h6 class="product-title">Số lượng </h6>
                                <div class="qty-box">
                                    <div class="input-group">

                                        <span class="input-group-prepend">

                                            <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                                <i class="ti-angle-left"></i>
                                            </button>

                                        </span>

                                        <input type="text" name="quantity" class="form-control input-number" value="1" data-id="">

                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                                                <i class="ti-angle-right"></i>
                                            </button>
                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="product-buttons">
                                <a href="" class="btn btn-solid mb-1 btn-add-to-cart">Chọn Mua</a>
                                <a id="button-detail" href="#" class="btn btn-solid mb-1 btn-view-book-detail">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>