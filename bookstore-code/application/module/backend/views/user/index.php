<?php
    $module         = $this->arrParam['module'];
    // Select Box
    $arrAction = [
        'default'        => '- Bulk Action -', 
        'multi-delete'   => 'Multi Delete', 
        'multi-active'   => 'Multi Active', 
        'multi-inactive' => 'Multi Inactive',
    ];

    $arrSearchBy = [
        ['name'  => '- Search By All -', 'id' => 'all'],
        ['name'  => 'Search By ID', 'id' => 'id'],
        ['name'  => 'Search By Username', 'id' => 'username'],
        ['name'  => 'Search By Full Name', 'id' => 'fullname'],
        ['name'  => 'Search By Email', 'id' => 'email']
    ];
    
    require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-index.php';
    $filterGroup	= Helper::cmsSelectbox('filter_group_id', $this->filterGroup, $arrParam['filter_group_id'], 'custom-select custom-select-sm mr-1', 'width: unset');
    
    $xhtml = '';
    if(!empty($this->Items)){
        foreach($this->Items as $item){
            $id 		    = $item['id'];
            $linkEdit       = URL::createLink($module, $controller, 'form', ['id' => $id]);
            $checkbox       = HTML::showItemCheckbox($id);
            $resultID       = Helper::highLight($item['id'], $searchField, $searchValue, 'id');

            $arrInfo        = [
                ['name' => 'Username', 'value' => Helper::highLight($item['username'], $searchField, $searchValue, 'username')],
                ['name' => 'Full Name', 'value' => Helper::highLight($item['fullname'], $searchField, $searchValue, 'fullname')],
                ['name' => 'Email', 'value' => Helper::highLight($item['email'], $searchField, $searchValue, 'email')],
            ];
            $info           = HTML::showUserInfo($arrInfo);

            $slbGroup	    = Helper::cmsSelectbox('slb_group_id', $this->filterGroup, $item['group_id'], 'custom-select custom-select-sm mr-1', 'width: unset', $id, $id);
            $status	 	    = HTML::showItemState($module, $controller, $id, 'status', $item['status']);

            $created      = HTML::showItemHistory($item['created_by'], $item['created']);
            $modified     = HTML::showItemHistory($item['modified_by'], $item['modified']);
            $btnAction      = HTML::showActionButton($module, $controller, $id);

            $xhtml         .= '
            <tr class="'.$readonly.'">
                <td class="text-center">'.$checkbox.'</td>
                <td class="text-center">'.$resultID.'</td>
                <td style="width:100px;">'.$info.'</td>
                <td class="text-center position-relative">'.$slbGroup.'</td>
                <td class="text-center position-relative">'.$status.'</td>
                <td class="text-center">'.$created.'</td>
                <td class="text-center modified-'.$id.'">'.$modified.'</td>
                <td class="text-center">'.$btnAction.'</td>
            </tr>
            ';
        }
    } else { $empty = $emptyHead;}

    $inputFilterBar = $inputHidden . $filterGroup ;
    $inputFormSearch = $inputHidden . $inputSearch ;
    $buttonsIndex = $slbSearchBy . $btnSearch . $btnClear ;

    $xhtmlSearch = '
        <th class="text-center">'.$checkAll.'</th>
        <th class="text-center">'.$lblID.'</th>
        <th style="width:100px;">Info</th>
        <th class="text-center">Group</th>
        <th class="text-center">'.$lblStatus.'</th>
        <th class="text-center">'.$lblCreated.'</th>
        <th class="text-center">'.$lblModified.'</th>
        <th class="text-center">Action</th>
    ';
?>

<!-- Search & Filter -->
<?php require_once PATH_MODULE . $module .DS. 'views' .DS. 'search-index.php';?>

<!-- List -->
<?php require_once PATH_MODULE . $module .DS. 'views' .DS. 'list-index.php';?>


