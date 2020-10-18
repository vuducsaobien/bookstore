<?php 
    $module         = $this->arrParam['module'];
    // Select Box
    $arrAction = [
        'default'        => '- Bulk Action -', 
        'multi-delete'   => 'Multi Delete', 
        'multi-active'   => 'Multi Active', 
        'multi-inactive' => 'Multi Inactive',
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
                <td class="text-center">'.$checkbox.'</td>
                <td class="text-center">'.$resultID.'</td>
                <td class="text-center"><a href="'.$linkEdit.'">'.$resultName.'</a></td>

                <td class="text-center position-relative">'.$status.'</td>
                <td class="text-center position-relative">'.$group_acp.'</td>

                <td style="width:100px;" class="text-center">'.$members.'</td>
                <td class="text-center">'.$created.'</td>
                <td class="text-center modified-'.$id.'">'.$modified.'</td>                
                <td class="text-center">' . $btnAction . '</td>
            </tr>
            ';
        }
    }else{ $empty = $emptyHead;}

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
                <form id="filter-bar" name="filter-bar" method="GET" action="">  
                    <?php echo $inputModule . $inputController . $inputAction . $slbGroupACP ;?>                        
                </form>
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
            <?php echo $btnAdd ;?>
        </div>
        
        <!-- List Content -->
        <form action="#" method="post" class="table-responsive" id="form-table" name="form-table">
            <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                <thead>
                    <tr>
                        <!-- CHECK ALL -->
                        <th class="text-center"><?= $checkAll ;?></th>
                        <th class="text-center"><?= $lblID ;?></th>
                        <th class="text-center"><?= $lblName ;?></th>
                        <th class="text-center"><?= $lblStatus ;?></th>
                        <th class="text-center"><?= $lblGroupACP ;?></th>
                        <th class="text-center"><?= $lblMembers ;?></th>
                        <th class="text-center"><?= $lblCreated ;?></th>
                        <th class="text-center"><?= $lblModified ;?></th>
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


