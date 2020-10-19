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

<!-- Quick View -->
<?php require_once 'elements/quick-view.php';?>


