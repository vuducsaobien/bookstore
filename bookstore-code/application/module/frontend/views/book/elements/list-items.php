<?php
    $arrParam   = $this->arrParam;
    $module     = $arrParam['module'];
    $controller = $arrParam['controller'];
    $action     = $arrParam['action'];
    $imageURL   = $this->_dirImg;

    // SELECT BOX
    $arrSortPrice = [
        ['name'  => '- Sắp Xếp -'  , 'id' => 'default'],
        ['name'  => 'Tăng Dần'     , 'id' => 'price_asc'],
        ['name'  => 'Giảm Dần'     , 'id' => 'price_desc'],
        ['name'  => 'Mới Nhất'     , 'id' => 'latest']
    ];
    $slbSortPrice   = HTML::createSelectBox($arrSortPrice, 'sort', null, null, 'sort', null, $arrParam['filter_price']);

    // Pagination
    if($this->totalItems < $arrParam['pagination']['totalItemsPerPage']){
        $paginationHTML = '';
        $paginationFrontEnd = '';
    }elseif($this->totalItems > $arrParam['pagination']['totalItemsPerPage']){
        $paginationHTML		= $this->pagination->showPaginationPublic(URL::createLink($module, $controller, $action));
        $paginationFrontEnd = HTML_Frontend::createPaginationPublic($arrParam['pagination'], $this->totalItems);
    }

    // MESSAGE EMPTY DATABASE
    if(empty($this->booksCategory)){
        $empty = '';
    }elseif($controller == 'list' && $action == 'list' && !isset($arrParam['category_id'])){
        $empty = '';
    }

    if($this->totalItems == 0){
        $empty = '
            <div class="col-sm-12 text-center">
                <h5 class="my-3 btn-success">Dữ Liệu Đang Cập Nhật !</h5>
                <a href="'.$linkHome.'" class="btn btn-solid">Quay Lại Trang Chủ</a>
            </div>
        ';
    }

    // Title
    $totalItems = $this->totalItems;
    $title = 'tất cả sách';
    if(!empty($arrParam['search'])){
        $searchValue = $arrParam['search'];
        $title = "tìm kiếm cho '$searchValue': $totalItems kết quả.";
    }else{
        $searchValue = '';
    }

    // Title SORT
    switch ($arrParam['sort']) {
        case 'price_asc':    $title = 'giá sách tăng dần';   break;
        case 'price_desc':   $title = 'giá sách giảm dần';   break;
        case 'latest':       $title = 'sách mới nhất';       break;
    }



?>