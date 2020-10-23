<?php
    $module         = $this->arrParam['module'];
    
    $arrAction = [
        'default'        => '- Bulk Action -', 
        'multi-active'   => 'Multi Active', 
        'multi-inactive' => 'Multi Inactive'
    ];

    $arrSearchBy = [
        ['name'  => '- Tìm Kiếm Tất Cả -', 'id' => 'all'],
        ['name'  => 'Tìm Theo ID', 'id' => 'id'],
        ['name'  => 'Tìm Theo Username', 'id' => 'username'],
        ['name'  => 'Tìm Theo Họ Tên', 'id' => 'fullname'],
        ['name'  => 'Tìm Theo Email', 'id' => 'email'],
        ['name'  => 'Tìm Theo Phone', 'id' => 'phone'],
    ];

    require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-index.php';

    $lblTotalPrice	= Helper::cmsLinkSort('Tổng Tiền', 'totalPrice', $columnPost, $orderPost);
    $lblQuantities	= Helper::cmsLinkSort('Quantities', 'group_acp', $columnPost, $orderPost);

    $xhtml = '';
    if(!empty($this->Items)){
        foreach($this->Items as $item){
            $cartID         = $item['id'];
            $resultCartID       = Helper::highLight($cartID, $searchField, $searchValue, 'id');

            $arrBookID		= json_decode($item['books']);
            $arrPrice		= json_decode($item['prices']);
            $arrName		= json_decode($item['names']);
            $arrQuantity	= json_decode($item['quantities']);
            $arrPicture		= json_decode($item['pictures']);

            $created        = HTML::showItemHistory($item['username'], $item['date']);
            $linkView       = URL::createLink($module, $controller, 'view', ['id' => $cartID]);
            $checkbox       = HTML::showItemCheckbox($cartID);
            $btnAction      = HTML::showActionButton($module, $controller, $cartID);
            $date           = date(TIMEDATE_FORMAT, strtotime($item['date']));

            $status	 	    = HTML::showItemState($module, $controller, $id, 'status', $item['status']);
            $arrInfo        = [
                ['name' => 'Username', 'value' => Helper::highLight($item['username'], $searchField, $searchValue, 'username')],
                ['name' => 'Họ Tên', 'value' => Helper::highLight($item['fullname'], $searchField, $searchValue, 'fullname')],
                ['name' => 'Email', 'value' => Helper::highLight($item['email'], $searchField, $searchValue, 'email')],
                ['name' => 'Số Điện Thoại', 'value' => Helper::highLight($item['phone'], $searchField, $searchValue, 'phone')],
                ['name' => 'Địa Chỉ', 'value' => Helper::highLight($item['address'], $searchField, $searchValue, 'address')]
            ];
            $info           = HTML::showUserInfo($arrInfo);

            require_once PATH_LIBRARY . 'Model.php';
            $model      = new Model();
            $booksID        = implode(',', $arrBookID);
            $query = "SELECT `name` FROM `".TBL_BOOK."` WHERE `id` IN ($booksID)";
            $listBookName   = $model->fetchAll($query);

            $new_arr = array_map(function ($e) {
                return $e['name'];
            }, $listBookName);

            $detail = '';
            $totalPrice = 0;
            foreach($new_arr as $key => $lastName){
                $spanNumber = $arrQuantity[$key];
                $span = '<span class="badge badge-pill badge-primary">'.$spanNumber.'</span>';
                $prices = $arrPrice[$key];
                $pricesProduct = $prices * $spanNumber;
                $totalPrice += $pricesProduct;
                $pricesFormat = HTML_Frontend::moneyFormat($pricesProduct);

                $detail .= "- $lastName x $span = $pricesFormat.<br>";
            }
            $totalPriceFormat =  HTML_Frontend::moneyFormat($totalPrice);

            $xhtml         .= '
            <tr>
                <td style="width:100px;">'.$checkbox.'</td>
                <td style="width:100px;">'.$resultCartID.'</td>
                <td style="width:100px;">'.$info.'</td>
                <td style="width:100px;" class="text-center position-relative">'.$status.'</td>
                <td style="width:100px;">'.$detail.'</td>
                <td style="width:100px;">'.$totalPriceFormat.'</td>

                <td class="text-center">'.$created.'</td>                
                <td class="text-center">' . $btnAction . '</td>
            </tr>
            ';
        }
    }else{$empty = $emptyHead;}

?>
<!-- Search & Filter -->
<div class="card card-info card-outline">
    <div class="card-header">
        <h6 class="card-title">Search & Filter</h6>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="row justify-content-between">
            <div class="mb-1">
                <?php echo $btnFilter ;?>
            </div>
            
            <div class="mb-1">
                <form action="" method="GET" id="form_search" name="form_search">
                    <div class="input-group">
                        <?php echo $inputModule . $inputController . $inputAction . $inputSearch ;?>                        
                        <div class="input-group-append">
                            <?php echo $slbSearchBy . $btnSearch . $btnClear;?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- List -->
<div class="card card-info card-outline">
    <div class="card-header">
        <h4 class="card-title">List</h4>
        <div class="card-tools">
            <?php echo $btnReload ;?>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <!-- Control -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
            <div class="mb-1"><?php echo $slbAction . $btnApply ;?></div>
        </div>
        
        <!-- List Content -->
        <form action="#" method="post" class="table-responsive" id="form-table" name="form-table">
            <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                <thead>
                    <tr>
                        <!-- CHECK ALL -->
                        <th style="width:100px;"><?= $checkAll ;?></th>
                        <th style="width:100px;"><?= $lblID ;?></th>
                        <th style="max-width:100px;">Thông Tin</th>
                        <th class="text-center"><?= $lblStatus ;?></th>
                        <th class="text-center" style="width:100px;">Chi Tiết</th>
                        <th style="width:100px;"><?= $lblTotalPrice ;?></th>
                        <th class="text-center"><?= $lblCreated ;?></th>
                        <th class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody><?php echo $xhtml ;?></tbody>
            </table>
            <div><?php echo $inputSortField .$inputSortOrder .$empty;?></div>
        </form>
    </div>
    <div class="card-footer clearfix"><?php echo $paginationHTML ;?></div>
</div>
