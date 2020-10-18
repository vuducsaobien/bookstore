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
                    <?php echo $inputModule . $inputController . $inputAction . $filterGroup ;?>                        
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
                    <tr><!-- CHECK ALL -->
                        <th class="text-center"><?= $checkAll ;?></th>
                        <th class="text-center"><?= $lblID ;?></th>
                        <th style="width:100px;">Info</th>
                        <th class="text-center">Group</th>
                        <th class="text-center"><?= $lblStatus ;?></th>
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

