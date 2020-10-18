<?php
$categoriesSpecial = '';
$booksInCategorySpecial = '';

if (!empty($this->booksCategories)) {
    foreach ($this->booksCategories as $key => $category) {
            $cateID         = $category['category_id'];
            $cateNameURL    = URL::filterURL($category['category_name']);

            $linkReadMore = URL::createLink($this->arrParam['module'], 'book', 'list', ['category_id' => $category['category_id']], "$cateNameURL-$cateID.html");
            $strClass   = '';
            $strDefault = '';
            if ($key == 0) {
                $strClass = 'current';
                $strDefault = 'default';
            }

            $categoriesSpecial .= '
            <li class="tab-category-' . $category['category_id'] . ' ' . $strClass . '">
                <a href="tab-category-' . $category['category_id'] . '" class="my-product-tab" data-category="' . $category['category_id'] . '">' . $category['category_name'] . '</a>
            </li>
        ';

        if (!empty($category['listBooks'])) {

            $booksInCategorySpecial .= '
            <div id="tab-category-' . $category['category_id'] . '" class="tab-content ' . $strDefault . '">
                <div class="no-slider row tab-content-inside">
            ';

            foreach ($category['listBooks'] as $book) {
                $booksInCategorySpecial .= HTML_Frontend::showProductBox($book, true, false, false, null, null, 'all');
            }

            $booksInCategorySpecial .= '
                </div>    
                <div class="text-center"><a href="' . $linkReadMore . '" class="btn btn-solid">Xem tất cả</a></div>
            </div>    
            ';
        }

    }
}


?>
<!-- Danh mục nổi bật -->
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Danh mục nổi bật</h2>
    <hr role="tournament6">
</div>

<section class="p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="theme-tab">

                    <ul class="tabs tab-title">
                        <?php echo $categoriesSpecial; ?>
                    </ul>

                    <div class="tab-content-cls">
                        <?php echo $booksInCategorySpecial; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>