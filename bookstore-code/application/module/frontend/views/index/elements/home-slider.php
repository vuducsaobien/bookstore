<?php
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


<section class="p-0 my-home-slider">
    <div class="slide-1 home-slider">
        <?php echo $xhtmlSlides;?>
    </div>
</section>
