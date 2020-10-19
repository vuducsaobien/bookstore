<?php
    // Link URL
    $module         = $this->arrParam['module'];
    $controller     = $this->arrParam['controller'];
    $action         = $this->arrParam['action'];
    $id             = $this->arrParam['id'];
    // Pagination
    $paginationHTML		= $this->pagination->showPagination(URL::createLink($module, $controller, $action));
    
    // MESSAGE
    echo HTML::showMessage();
    $searchValue = $this->arrParam['search'] ?? '';

    $linkCancel         = URL::createLink($module, $controller, 'index');
    $btnCancel          = Helper::cmsButton('noIcon', 'Cancel', null, null, 'btn btn-sm btn-danger mr-1', $linkCancel);

    $xhtml = '';
    $Items = $this->Items;

    if(!empty($Items)){
        foreach($Items as $value){
            $arrId		    = json_decode($value['books']);
            $arrPrice		= json_decode($value['prices']);
            $arrName		= json_decode($value['names']);
            $arrQuantity	= json_decode($value['quantities']);
            $arrPicture		= json_decode($value['pictures']);

            $totalPrice = 0;
            foreach($arrId as $key => $lastName){
                $bookName       = $arrName[$key];
                $bookQuantity   = $arrQuantity[$key];
                $prices         = $arrPrice[$key];

                echo '<pre>$bookName ';
                print_r($bookName);
                echo '</pre>';

                $picture        = $arrPicture[$key];
                $bookPicture    = '<img src="'.URL_UPLOAD . TBL_BOOK . DS . '98x150-' . $picture.'">';
                $picturePath    = PATH_UPLOAD . TBL_BOOK . DS . '98x150-' . $picture;
                if(!file_exists($picturePath)){
                    $bookPicture    = '<img src="'.URL_UPLOAD . TBL_BOOK . DS . '98x150-default.jpg' .'">';
                }

                $pricesProduct = $prices * $bookQuantity;
                $totalPrice += $pricesProduct;
                $pricesFormat = HTML_Frontend::moneyFormat($pricesProduct);
                $totalPriceFormat =  HTML_Frontend::moneyFormat($totalPrice);

                $xhtml .= '
                <tr>
                    <td class="text-center">'.$bookName.'</td>
                    <td class="text-center">'.$bookPicture.'</td>
                    <td class="text-center"><strong>'.$bookQuantity.'</strong> quyển.</td>
                    <td class="text-center">'.$pricesFormat.'</td>        
                </tr>
                ';
            }
        }
    }

?>
    <?php echo $Items['username'];?>

<!-- List -->
<div class="card card-info card-outline">
    <div class="card-header">
        <h4 class="card-title"><strong>Mã Đơn Hàng: </strong><?php echo $Items[0]['id'];?></h4>
        <h4 class="card-title">| <strong> Username: </strong><?php echo $Items[0]['username'];?></h4>
        <h4 class="card-title">| <strong>Họ Tên: </strong><?php echo $Items[0]['fullname'];?></h4>
        <h4 class="card-title">| <strong>Số Điện Thoại: </strong><?php echo $Items[0]['phone'];?></h4>
        <h4 class="card-title">| <strong>Địa Chỉ: </strong><?php echo $Items[0]['address'];?></h4>
        <div class="card-tools">
            <?php echo $btnReload ;?>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <!-- Control -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
            <div class="mb-1"><?php echo $slbAction . $btnApply ;?></div>
            <div>
                <form action="#" method="post" class="table-responsive" id="admin-form" name="admin-form">
                    <?php echo $btnCancel; ?>
                </form>
            </div>
        </div>

        <!-- List Content -->
        <form action="#" method="post" class="table-responsive" id="form-table" name="form-table">
            <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                <thead>
                    <tr>
                        <!-- CHECK ALL -->
                        <th class="text-center" style="width: 35%;">Tên Sách</th>
                        <th class="text-center" style="width: 15%">Hình Sách</th>
                        <th class="text-center" style="width: 20%">Số Lượng</th>
                        <th class="text-center" style="width: 30%">Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody><?php echo $xhtml ;?></tbody>
            </table>
            <div><?php echo $inputSortField .$inputSortOrder;?></div>
        </form>
    </div>
    <div class="card-footer clearfix"><?php echo $paginationHTML ;?></div>
</div>