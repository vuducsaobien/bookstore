<?php
    $module         = $this->arrParam['module'];
    // Select Box
    $arrAction = [
        'default'        => '- Bulk Action -', 
        'multi-active'   => 'Multi Active', 
        'multi-inactive' => 'Multi Inactive'
    ];

    $arrGroupACP = [
        ['name'  => '- Select Group ACP -'   , 'id' => 'default'],
        ['name'  => 'Yes'                    , 'id' => '1'],
        ['name'  => 'No'                     , 'id' => '0']
    ];

    $arrSearchBy = [
        ['name'  => '- Search By All -', 'id' => 'all'],
        ['name'  => 'Search By ID', 'id' => 'id'],
        ['name'  => 'Search By Name', 'id' => 'name']
    ];
    
    require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-index.php';
    $slbGroupACP   = HTML::createSelectBox($arrGroupACP, 'filter_group_acp', 'custom-select custom-select-sm', 'width: unset', null, null, $arrParam['filter_group_acp']);
    $btnAdd= '';
    $slbAction = '';
    $btnFilter = '';
    $btnApply = '';
    $btnCancel = '';

    if(!empty($this->Items)){
        foreach($this->Items as $item){
            $id 		    = $item['id'];
            $linkEdit       = URL::createLink($module, $controller, 'form', ['id' => $id]);
            $checkbox       = HTML::showItemCheckbox($id);
            $resultID       = Helper::highLight($item['id'], $searchField, $searchValue, 'id');
            $resultName       = Helper::highLight($item['name'], $searchField, $searchValue, 'name');

            $status	 	    = HTML::showItemState($module, $controller, $id, 'status', $item['status']);
            $group_acp	 	= HTML::showItemState($module, $controller, $id, 'group_acp', $item['group_acp']);          

            $members        = $item['total_members'];
            $created        = HTML::showItemHistory($item['created_by'], $item['created']);
            $modified       = HTML::showItemHistory($item['modified_by'], $item['modified']);
            $btnAction      = HTML::showActionButton($module, $controller, $id);

            $xhtml         .= '
            <tr>
                <td class="text-center">'.$resultID.'</td>
                <td class="text-center"><a href="'.$linkEdit.'">'.$resultName.'</a></td>
                <td class="text-center position-relative">'.$status.'</td>
                <td class="text-center position-relative">'.$group_acp.'</td>
                <td style="width:100px;" class="text-center">'.$members.'</td>
                <td class="text-center">'.$created.'</td>
                <td class="text-center modified-'.$id.'">'.$modified.'</td>     
            </tr>
            ';
        }
    }else{ $empty = $emptyHead;}

    $xhtmlSearch = '
        <th class="text-center">'.$lblID .'</th>
        <th class="text-center">'.$lblName .'</th>
        <th class="text-center">'.$lblStatus .'</th>
        <th class="text-center">'.$lblGroupACP .'</th>
        <th class="text-center">'.$lblMembers .'</th>
        <th class="text-center">'.$lblCreated .'</th>
        <th class="text-center">'.$lblModified .'</th>
    ';

?>

<!-- List -->
<?php require_once PATH_MODULE . $module .DS. 'views' .DS. 'list-index.php';?>

