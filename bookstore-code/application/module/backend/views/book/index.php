<?php
    $module         = $this->arrParam['module'];
    
    $arrAction = [
        'default'        => '- Bulk Action -', 
        'multi-delete'   => 'Multi Delete', 
        'multi-active'   => 'Multi Active', 
        'multi-inactive' => 'Multi Inactive',
        'multi-special'   => 'Multi Special', 
        'multi-unspecial' => 'Multi Unspecial'
    ];

    $arrSearchBy = [
        ['name'  => '- Search By All -', 'id' => 'all'],
        ['name'  => 'Search By ID', 'id' => 'id'],
        ['name'  => 'Search By Name', 'id' => 'name'],
        ['name'  => 'Search By Price', 'id' => 'price'],
        ['name'  => 'Search By Sale Off', 'id' => 'sale_off']
    ];

    require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-index.php';
    $filterSpecial   = HTML::createSelectBox($arrSpecial, 'filter_special', 'custom-select custom-select-sm', 'width: unset', null, null, $this->arrParam['filter_special']);
    $filterCategory	= Helper::cmsSelectbox('filter_category_id', $this->filterCategory, $this->arrParam['filter_category_id'], 'custom-select custom-select-sm mr-1', 'width: unset');

    if(!empty($this->Items)){
        foreach($this->Items as $item){
            $id 		    = $item['id'];
            $ordering       = $item['ordering'];
            $saleoff        = $item['sale_off'] .'%';
            $checkbox       = HTML::showItemCheckbox($id);
            $linkEdit       = URL::createLink($module, $controller, 'form', ['id' => $id]);

            $resultID       = Helper::highLight($item['id'], $searchField, $searchValue, 'id');
            $resultName     = Helper::highLight($item['name'], $searchField, $searchValue, 'name');
            $price          = number_format($item['price'], 0, ',', '.') . MONEY_VALUE;
            
            $picture        = HTML_Frontend::getSrcPictureAdmin($controller, $item['picture'], '98', '150');
            $resultPrice    = Helper::highLight($price, $searchField, $searchValue, 'price');
            $resultSaleOff  = Helper::highLight($saleoff, $searchField, $searchValue, 'sale_off');

            $slbCategory	= Helper::cmsSelectbox('slb_category_id', $this->filterCategory, $item['category_id'], 'custom-select custom-select-sm mr-1', 'width: unset', $id, $id);
            $status	 	    = HTML::showItemState($module, $controller, $id, 'status', $item['status']);            
            $special        = HTML::showItemState($module, $controller, $id, 'special', $item['special']);
            $inputOrdering  = Helper::cmsInput('number', "chkOrdering['$id']", $id, 'chkOrdering form-control form-control-sm m-auto text-center', $ordering, null, 'width: 65px', null, $id);
            
            $btnAction      = HTML::showActionButton($module, $controller, $id);
            $xhtml         .= '
            <tr>
                <td class="text-center">'.$checkbox.'</td>
                <td class="text-center">'.$resultID.'</td>
                <td class="text-center" style="width:100px;"><a href="'.$linkEdit.'">'.$resultName.'</a></td>
                <td class="text-center">'.$picture.'</td>
                <td class="text-center position-relative">'.$resultPrice.'</td>
                <td class="text-center position-relative">'.$resultSaleOff.'</td>
                <td class="text-center position-relative">'.$slbCategory.'</td>
                <td class="text-center position-relative">'.$status.'</td>
                <td class="text-center position-relative">'.$special.'</td>
                <td class="text-center position-relative">'.$inputOrdering.'</td>
                <td class="text-center">' . $btnAction . '</td>
            </tr>
            ';
        }
    }else{$empty = $emptyHead;}

    $inputFilterBar = $inputHidden . $filterSpecial . ' ' . $filterCategory ;
    $inputFormSearch = $inputHidden . $inputSearch ;
    $buttonsIndex = $slbSearchBy . $btnSearch . $btnClear ;

    $xhtmlSearch = '
        <th class="text-center">'. $checkAll .'</th>
        <th class="text-center">'. $lblID .'</th>
        <th class="text-center">'. $lblName .'</th>
        <th class="text-center">Picture</th>
        <th class="text-center">'. $lblPrice .'</th>
        <th class="text-center">'. $lblSaleOff .'</th>
        <th class="text-center">Category</th>
        <th class="text-center">'. $lblStatus .'</th>
        <th class="text-center">'. $lblSpecial .'</th>
        <th class="text-center">'. $lblOrdering .'</th>
        <th class="text-center">Action</th>
    ';

?>
<!-- Search & Filter -->
<?php require_once PATH_MODULE . $module .DS. 'views' .DS. 'search-index.php';?>

<!-- List -->
<?php require_once PATH_MODULE . $module .DS. 'views' .DS. 'list-index.php';?>

