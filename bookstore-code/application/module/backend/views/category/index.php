<?php
    $module         = $this->arrParam['module'];
    // Select Box
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
        ['name'  => 'Search By Name', 'id' => 'name']
    ];
    
    require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-index.php';
    $filterSpecial   = HTML::createSelectBox($arrSpecial, 'filter_special', 'custom-select custom-select-sm', 'width: unset', null, null, $arrParam['filter_special']);

    if(!empty($this->Items)){
        foreach($this->Items as $item){
            $id 		    = $item['id'];
            $totalBooks        = $item['total_books'];
            $checkbox       = HTML::showItemCheckbox($id);
            $linkEdit       = URL::createLink($module, $controller, 'form', ['id' => $id]);
            $resultID       = Helper::highLight($item['id'], $searchField, $searchValue, 'id');
            $resultName     = Helper::highLight($item['name'], $searchField, $searchValue, 'name');
            
            $picture        = HTML_Frontend::getSrcPictureAdmin($controller, $item['picture']);
            $status	 	    = HTML::showItemState($module, $controller, $id, 'status', $item['status']);
            $special        = HTML::showItemState($module, $controller, $id, 'special', $item['special']);
            $inputOrdering  = Helper::cmsInput('number', "chkOrdering['$id']", $id, 'chkOrdering form-control form-control-sm m-auto text-center', $item['ordering'], null, 'width: 65px', null, $id);

            $modified       = HTML::showItemHistory($item['modified_by'], $item['modified']);
            $btnAction      = HTML::showActionButton($module, $controller, $id);
            $xhtml         .= '
            <tr>
                <td class="text-center">'.$checkbox.'</td>
                <td class="text-center">'.$resultID.'</td>
                <td class="text-center"><a href="'.$linkEdit.'">'.$resultName.'</a></td>
                <td class="text-center">'.$picture.'</td>
                <td class="text-center position-relative">'.$status.'</td>
                <td class="text-center position-relative">'.$special.'</td>
                <td style="width:100px;" class="text-center">'.$totalBooks.'</td>
                <td class="text-center position-relative">'.$inputOrdering.'</td>
                <td class="text-center modified-'.$id.'">'.$modified.'</td>           
                <td class="text-center">' . $btnAction . '</td>
            </tr>
            ';
        }
    }else{ $empty = $emptyHead;}

    $inputFilterBar = $inputHidden . $filterSpecial ;
    $inputFormSearch = $inputHidden . $inputSearch ;
    $buttonsIndex = $slbSearchBy . $btnSearch . $btnClear ;

    $xhtmlSearch = '
        <th class="text-center">'.$checkAll.'</th>
        <th class="text-center">'.$lblID.'</th>
        <th class="text-center">'.$lblName.'</th>
        <th class="text-center">Picture</th>
        <th class="text-center">'.$lblStatus.'</th>
        <th class="text-center">'.$lblSpecial.'</th>
        <th class="text-center">'.$lblBookNumber.'</th>
        <th class="text-center">'.$lblOrdering.'</th>
        <th class="text-center">'.$lblModified.'</th>
        <th class="text-center">Action</th>
    ';

?>
<!-- Search & Filter -->
<?php require_once PATH_MODULE . $module .DS. 'views' .DS. 'search-index.php';?>

<!-- List -->
<?php require_once PATH_MODULE . $module .DS. 'views' .DS. 'list-index.php';?>

