<?php
class HTML_Frontend
{
    public static function showProductBox($product, $showName=true, $showDescription=false, $showDiv=false, $divStart=null ,$divEnd=null, $typeProduct=null, $searchValue=null)
    {
        $bookID         = $product['id'];
        $cateID         = $product['category_id'];
        $bookNameURL    = URL::filterURL($product['name']);
        $cateNameURL    = URL::filterURL($product['category_name']);

        if($typeProduct=='book'){
                $link = URL::createLink('frontend', 'book', 'index', ['book_id' => $bookID], "$bookNameURL-$bookID.html");

            }elseif($typeProduct=='category'){
                $link = URL::createLink('frontend', 'book', 'index', ['category_id' => $cateID], "$cateNameURL-$cateID.html");
                
            }elseif($typeProduct=='all'){
                $link               = URL::createLink('frontend', 'book', 'index', ['book_id' => $bookID, 'category_id' => $cateID], 
                "$cateNameURL/$bookNameURL-$cateID-$bookID.html");
        }

        $price              = self::showPriceProductBox($product['price'], $product['sale_off']);
        $shortDescription   = substr($product['description'], 0, 100) .' ...';
        $shortDescription   = $showDescription ? self::showShortDescription($shortDescription) : '';
        $classImage         = 'img-fluid blur-up lazyload bg-img';
        $divStartImage      = '<div class="front">';
        $divEndImage        = '</div>';
        $srcPicture         = self::getSrcPicture($product['picture'], TBL_BOOK);

        $priceOrder         = self::moneyFormat(null, 'price_order', $product['price'], $product['sale_off']);
        
        $resultName     = Helper::highLightPublic($searchValue, $product['name']);
        $productName        = $showName ? self::showProductName($link, $resultName) : '';

        $xhtml = '
            <div class="product-box">
                <div class="img-wrapper">
                    '.self::showSaleOffLabel($product['sale_off']).'
                    '.self::showProductImage($link, $srcPicture, $product['name'], $classImage,  true, $divStartImage, $divEndImage).'
                    <div class="cart-info cart-wrap">
                        '.self::showBtnAddToCartProductBox($bookID).'
                        '.self::showBtnQuickView($bookID).'
                    </div>
                </div>

                <div class="product-detail">
                    '.self::showStarRating().'
                    '.$productName.'
                    '.$shortDescription.'
                    '.$price.'
                </div>
            </div>
        ';
        if($showDiv==true)$xhtml = $divStart.$xhtml.$divEnd;
        return $xhtml;
    }

    public static function showProductName($link, $name, $hTag='6')
    {
        $xhtml = "
            <a href='$link' title='$name'>
                <h$hTag>$name</h$hTag>
            </a>
        ";
        return $xhtml;
    }

    public static function showBtnAddToCartProductBox($id)
    {
        // $xhtml = '<a href="javascript:addToCart(\'' . $bookID . '\');" title="Add to cart"><i class="ti-shopping-cart"></i></a>';
        $xhtml = '<a href="javascript:addToCart('.$id.')" title="Add to cart"><i class="ti-shopping-cart"></i></a>';
        // $xhtml = '<a href="javascript:quickViewBook(' . $id . ')" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>';

        return $xhtml;
    }

    public static function showBtnQuickView($id)
    {
        // $link = URL::createLink('frontend', 'index', 'quickView', ['id' => $bookID, 'category_id' => $cateID]);
        // $xhtml = '<a href="javascript:quickView(\'' . $link .'\');" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>';

        $xhtml = '<a href="javascript:quickView('.$id.')" title="Quick View"><i class="ti-search" data-toggle="modal" data-target="#quick-view"></i></a>';
        return $xhtml;
    }

    public static function showProductMedia($product, $showName=true, $showDescription=false, $showDiv=false, $divStart='<div>' ,$divEnd='</div>')
    {
        $bookID         = $product['id'];
        $cateID         = $product['category_id'];
        $bookNameURL = URL::filterURL($product['name']);
        $cateNameURL = URL::filterURL($product['category_name']);

        $link           = URL::createLink('frontend', 'book', 'index', ['book_id' => $bookID, 'category_id' => $cateID], 
        "$cateNameURL/$bookNameURL-$cateID-$bookID.html");

        $shortDescription   = substr($product['description'], 0, 100) .' ...';
        $shortDescription   = $showDescription ? self::showShortDescription($shortDescription) : '';
        $productName        = $showName ? self::showProductName($link, $product['name']) : '';
        $srcPicture         = self::getSrcPicture($product['picture'], TBL_BOOK);
        $priceSaleFormat    = self::moneyFormat(null, 'price_sale', $product['price'], $product['sale_off']);
        $xhtml = '
            <div class="media">
                '.self::showProductImage($link, $srcPicture, $product['name'], false).'
                <div class="media-body align-self-center">
                    '.self::showStarRating().'
                    '.$productName.'
                    <h4 class="text-lowercase">'.$priceSaleFormat.'</h4>
                </div>
            </div>
        ';
        if($showDiv==true)$xhtml = $divStart.$xhtml.$divEnd;
        return $xhtml;
    }

    public static function createSlide($source, $booksPerSlide=3, $showDiv=true, $divStart='<div>' ,$divEnd='</div>')
    {
        $totalBook = count($source);
        $totalSlide = ceil($totalBook / $booksPerSlide);
        $xhtml = '';
        if(!empty($source))
        {
            $bookCurrent = 0;
            for($i = 1; $i <= $totalSlide; $i++)
            {
                $xhtml .= $divStart;
                $count = 0;
                for($j = $bookCurrent; $j < $totalBook; $j++, $bookCurrent++)
                {
                    $count++;
                    if($count > $booksPerSlide)
                        break;
                    $xhtml .= self::showProductMedia($source[$j], true, false, false);
                }
                $xhtml .= $divEnd;
            }
            unset($bookCurrent, $count);
        }
        return $xhtml;
    }

    public static function showProductImage($link, $srcPicture, $name, $classImage, $showDiv=false, $divStartImage=null, $divEndImage=null, $style=null)
    {
        $style  = ($style != null) ? 'style="'.$style.'"' : '';

        $xhtml = '
            <a href="'.$link.'">
                <img src="'.$srcPicture.'" class="'.$classImage.'" 
                alt="'.$name.'" title="'.$name.' '.$style.'">
            </a>
        ';
        if($showDiv==true) $xhtml = $divStartImage.$xhtml.$divEndImage;
        return $xhtml;
    }

    public static function getSrcPicture($filePicture, $folder)
    {
        $picturePath 	= PATH_UPLOAD . $folder . DS . $filePicture;
        if(file_exists($picturePath)){
            $picture = URL_UPLOAD . "$folder/$filePicture";
        }else{
            $picture = URL_UPLOAD . $folder . DS . '98x150-default.jpg';
        }
        // echo $picture . '<br>';
        return $picture;
    }

    public static function getSrcPictureAdmin($controller, $picture, $width='60', $height='90')
    {
        $picturePath    = PATH_UPLOAD . $controller . DS . ''.$width.'x'.$height.'-' . $picture;
        if(file_exists($picturePath)){
            $picture        = '<img src="'.URL_UPLOAD . $controller . DS . ''.$width.'x'.$height.'-' . $picture.'">';
        }else{
            $picture    = '<img src="'.URL_UPLOAD . $controller . DS . ''.$width.'x'.$height.'-default.jpg' .'">';
        }
        return $picture;
    }

    public static function showPriceProductBox($price, $saleOff)
    {
        $priceFormat        = self::moneyFormat($price, null);
        $priceSaleFormat    = self::moneyFormat(null, 'price_sale', $price, $saleOff);

        if($saleOff > 0){
            $xhtml = '<h4 class="text-lowercase">'.$priceSaleFormat.' <del>'.$priceFormat.'</del></h4>';
        }else{
            $xhtml = '<h4 class="text-lowercase">'.$priceFormat.'</h4>';
        }
        return $xhtml;
    }

    public static function showSaleOffLabel($saleOff)
    {
        $saleoff = self::moneyFormat($saleOff, 'sale_off');
        $xhtml = '';
        if($saleOff){
            $xhtml = '
            <div class="lable-block">
                <span class="lable4 badge badge-danger"> -'.$saleoff.'</span>
            </div>
            ';
        }
        return $xhtml;
    }

    public static function showStarRating()
    {
        $xhtml = '
        <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        ';
        return $xhtml;
    }

    public static function showShortDescription($shortDescription)
    {
        $xhtml = "<p>$shortDescription</p>";
        return $xhtml;
    }

    public static function moneyFormat($value=null, $options=null, $price=null, $sale_off=null)
    {
        if($options==null) {
            $result = number_format($value, 0, ',', '.') .' '. MONEY_VALUE;
            
        }elseif($options=='sale_off'){
            $result = $value .'%';

        }elseif($options=='price_sale'){
            $result = $price*(100-$sale_off)/100;
            $result = number_format($result, 0, ',', '.') . MONEY_VALUE;

        }elseif($options=='price_order'){
            $result = $price*(100-$sale_off)/100;
        }
        return $result;
    }

    public static function listCategory($arrCategory, $arrParam=null, $list=null)
    {
        $classDefault   = isset($arrParam['category_id']) ? 'text-dark' : 'my-text-primary';
        $linkDefault  = URL::createLink('frontend', 'book', 'list', null, 'book.html');
        $xhtmlDefault = "
            <div
                class='custom-control custom-checkbox collection-filter-checkbox pl-0 category-item'>
                <a href = ".$linkDefault." class=$classDefault>Tất Cả</a>
            </div>
        ";

        $xhtmlListCategories = '';
        if(!empty($arrCategory)){
            foreach($arrCategory as $item){
                $cateID = $item['category_id'];
                $cateNameURL    = URL::filterURL($item['category_name']);

                $link = URL::createLink('frontend', 'book', 'list', ['category_id' => $cateID], "$cateNameURL-$cateID.html");

                $class = 'text-dark';
                if($arrParam['category_id'] == $item['category_id']) $class = 'my-text-primary';

                $xhtmlListCategories .= '
                <div
                    class="custom-control custom-checkbox collection-filter-checkbox pl-0 category-item">
                    <a href="'.$link.'" class="'.$class.'">'.$item['category_name'].'</a>
                </div>
                ';
            }
        }

        $xhtml = $xhtmlDefault . $xhtmlListCategories;
        return $xhtml;
    }

    public static function createPaginationPublic($arrPagination, $totalItems)
    {
        $currentPage 		= $arrPagination['currentPage'];
        $totalItemsPerPage 	= $arrPagination['totalItemsPerPage'];
        $totalPage			= ceil($totalItems/$totalItemsPerPage);

        if($totalPage==1){
            $startItem = 1;
            $endItem = $totalItems;
        
            }elseif($totalPage > 1 && $currentPage == 1 ){
                $startItem = 1;
                $endItem	= $currentPage * $totalItemsPerPage;
        
            }elseif($totalPage > 1 && $currentPage > 1 && $currentPage < $totalPage){
                $startItem = ($currentPage-1) * $totalItemsPerPage + 1;
                $endItem	= $currentPage * $totalItemsPerPage;
        
            }elseif($totalPage > 1 && $currentPage == $totalPage){
                $startItem = ($currentPage-1) * $totalItemsPerPage + 1;
                $endItem	= $totalItems;
        }

        $xhtml = "<h5>Showing Items $startItem-$endItem of $totalItems Result</h5>";
        return $xhtml;
    }

    public static function cmsRowForm($lblName, $input, $submit = false, $forLabel, $classLabel, $classDiv = 'col-md-6')
	{
		if ($submit == false) {
			$xhtml = '
			<div class="' . $classDiv . '">
				<label for="' . $forLabel . '" class="' . $classLabel . '">' . $lblName . '</label>
				' . $input . '
			</div>
			';
		} else { $xhtml = "<div class='form_row'>$input</div>" ;}
        return $xhtml;
    }

    // Page Error
    public static function pageError($page, $totalItems, $totalItemsPerPage, $module, $controller, $action)
	{
		if(isset($page)){
			$totalPage = ceil($totalItems/$totalItemsPerPage);
			if( $page > $totalPage ) {
                // URL::redirect($module, $controller, $action, ['page' => $totalPage], $controller.'.html&page='.$totalPage);
                URL::redirect($module, $controller, $action, ['page' => $totalPage]);
			}

			if( !is_numeric($page) ) {
				URL::redirect($module, 'index', 'notice', ['type' => 'not-found'], 'not-found.html');
			}
		}
    }

    public static function differentIDs($arr_different_ids)
    {
        if(!empty($arr_different_ids)){

            $different_ids = '';
            foreach($arr_different_ids as $value){
                $different_ids .= $value['id']. ',';
            }
            
            $arr_IDs = rtrim($different_ids, ", ");
            $IDs = "($arr_IDs)";

        }else{
            $IDs = "(0)";
        }

        return $IDs;
    }
    

    


    




    
}

