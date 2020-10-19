<div class="product-top-filter">
    <div class="row">
        <div class="col-xl-12">
            <div class="filter-main-btn">
                <span class="filter-btn btn btn-theme"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="product-filter-content">
                <div class="collection-view">
                    <ul>
                        <li><i class="fa fa-th grid-layout-view"></i></li>
                        <li><i class="fa fa-list-ul list-layout-view"></i></li>
                    </ul>
                </div>
                <div class="collection-grid-view">
                    <ul>
                        <li class="my-layout-view" data-number="2">
                            <img src="<?php echo $imageURL; ?>/icon/2.png" alt="" class="product-2-layout-view">
                        </li>
                        <li class="my-layout-view" data-number="3">
                            <img src="<?php echo $imageURL; ?>/icon/3.png" alt="" class="product-3-layout-view">
                        </li>
                        <li class="my-layout-view active" data-number="4">
                            <img src="<?php echo $imageURL; ?>/icon/4.png" alt="" class="product-4-layout-view">
                        </li>
                        <li class="my-layout-view" data-number="6">
                            <img src="<?php echo $imageURL; ?>/icon/6.png" alt="" class="product-6-layout-view">
                        </li>
                    </ul>
                </div>

                <div class="product-page-filter">
                    <form action="book.html" id="sort-form" method="GET">
                        <?php echo $slbSortPrice; ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>