<?php
if(!empty($this->booksSpecial)){
	foreach($this->booksSpecial as $book){
		$booksSpecial .= HTML_Frontend::showProductBox($book, true, false, false, null, null, 'all');
	}
}

?>

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
