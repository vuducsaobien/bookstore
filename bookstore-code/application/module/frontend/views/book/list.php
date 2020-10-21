<?php
    require_once 'elements/list-items.php';
    require_once PATH_BLOCK . 'quick-view.php';
    // Books CATEGORY
    if(!empty($this->booksCategory)){
        foreach($this->booksCategory as $item){
            $categoryID     = $item['category_id'];
            $linkCategory   = URL::createLink($module, $controller, $action);
            $divStart       = '<div class="col-xl-3 col-6 col-grid-box">';
            $divEnd         = '</div>';
            $listBooksCategory   .= HTML_Frontend::showProductBox($item, true, false, true, $divStart, $divEnd, 'all');
        }
    }

    // Books ACTIVE
    if(!empty($this->booksActive)){
        foreach($this->booksActive as $item){
            $divStart       = '<div class="col-xl-3 col-6 col-grid-box">';
            $divEnd         = '</div>';
            $listBooksActive   .= HTML_Frontend::showProductBox($item, true, false, true, $divStart, $divEnd, 'all', $searchValue);
        }
    }

    // Books SPECIAL
    $booksSpecial = HTML_Frontend::createSlide($this->booksSpecial, 4);
    $categoryList   = HTML_Frontend::listCategory($this->listCategories, $arrParam);

?>

<!-- CONTENT -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2 class="py-2"><?php echo $title;?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section-b-space j-box ratio_asos">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 collection-filter">
                    <!-- side-bar colleps block stat -->
                    <div class="collection-filter-block">
                        <!-- brand filter start -->
                        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"aria-hidden="true"></i> back</span></div>
                        <div class="collection-collapse-block open">

                            <h3 class="collapse-block-title">Danh mục Category</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <?php echo $categoryList ;?>
                                    <span class="text-dark font-weight-bold" id="btn-view-more">Xem thêm</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="theme-card">
                        <h5 class="title-border">Sách nổi bật</h5>
                        <div class="offer-slider slide-1">
                            <?php echo $booksSpecial ;?>
                        </div>
                    </div>
                    <!-- silde-bar colleps block end here -->
                </div>
                
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="collection-product-wrapper">
                                    
                                    <?php require_once 'elements/product-top-filter.php' ;?>
                                    <div class="product-wrapper-grid" id="my-product-list">
                                        <div class="row margin-res">
                                            <?php echo $listBooksActive . $listBooksCategory . $empty;?>									
                                        </div>
                                    </div>
                                    
                                    <div class="product-pagination">
                                        <div class="theme-paggination-block">
                                            <div class="container-fluid p-0">
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <nav aria-label="Page navigation">
                                                            <nav>
                                                                <ul class="pagination">
                                                                    <?php echo $paginationHTML ;?>
                                                                </ul>
                                                            </nav>
                                                        </nav>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <div class="product-search-count-bottom">
                                                            <?php echo $paginationFrontEnd ;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- END CONTENT -->

