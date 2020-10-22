<?php
    // Info This Book_ID
    $bookInfo           = $this->bookInfo;
    $bookID = $bookInfo['id'];
    $description        = $bookInfo['description'];
    $shortDescription   = $bookInfo['short_description'];
    $bookName           = $bookInfo['name'];
    $picture            = HTML_Frontend::getSrcPicture($bookInfo['picture'], TBL_BOOK);
    $price              = HTML_Frontend::moneyFormat($bookInfo['price'], null);
    $saleOff            = HTML_Frontend::moneyFormat($bookInfo['sale_off'], 'sale_off');
    $priceSale          = HTML_Frontend::moneyFormat(null, 'price_sale', $bookInfo['price'], $bookInfo['sale_off']);
    $priceOrder         = HTML_Frontend::moneyFormat(null, 'price_order', $bookInfo['price'], $bookInfo['sale_off']);

    $linkAddToCart  = 'javascript:addToCart(' . $bookID . ')';

    $priceSaleOrder     = HTML_Frontend::moneyFormat(null, 'price_order', $bookInfo['price'], $bookInfo['sale_off']);
    if($bookInfo['sale_off'] > 0){
        $priceHTML = '
            <h4><del>'.$price.'</del><span> -'.$saleOff.'</span></h4>
            <h3>'.$priceSale.'</h3>
        ';
    }else{
        $priceHTML = '<h3>'.$priceSale.'</h3>';
    }

?>

<div class="col-lg-9 col-sm-12 col-xs-12">
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> filter</span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="product-slick">
                <div><img src="<?php echo $picture;?>" alt=""
                        class="img-fluid w-100 blur-up lazyload image_zoom_cls-0"></div>
            </div>
        </div>

        <div class="col-lg-8 col-xl-8 rtl-text">
            <div class="product-right">
                <h2 class="mb-2"><?php echo $bookName ;?></h2>
                <?php echo $priceHTML ;?>
                <div class="product-description border-product">
                    <h6 class="product-title">Số lượng</h6>
                    <div class="qty-box">

                        <div class="input-group">
                            <span class="input-group-prepend">
                                <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                                    <i class="ti-angle-left"></i>
                                </button> 
                            </span>

                            <input type="text" name="quantity" class="form-control input-number" value="1">
                            
                            <span class="input-group-prepend">
                                <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                                    <i class="ti-angle-right"></i>
                                </button>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="product-buttons">
                    <a href="<?php echo $linkAddToCart ;?>" class="btn btn-solid btn-add-to-cart ml-0"><i class="fa fa-cart-plus"></i> Chọn mua</a>
                    </div>
                <div class="border-product"><?php echo $shortDescription ;?></div>

            </div>
        </div>
    </div>
</div>

<section class="tab-product m-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="top-home-tab"
                            data-toggle="tab" href="#top-home" role="tab"
                            aria-selected="true">Mô tả sản phẩm</a>
                        <div class="material-border"></div>
                    </li>
                </ul>
                <div class="tab-content nav-material" id="top-tabContent">
                    <div class="tab-pane fade show active ckeditor-content" id="top-home"
                        role="tabpanel" aria-labelledby="top-home-tab">
                        <p><?php echo $description ;?></p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

</div>
