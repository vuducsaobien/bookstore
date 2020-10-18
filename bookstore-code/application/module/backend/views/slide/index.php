<?php
    $module         = $this->arrParam['module'];
    
    $arrAction = [
        'default'        => '- Bulk Action -', 
        'multi-delete'   => 'Multi Delete', 
        'multi-active'   => 'Multi Active', 
        'multi-inactive' => 'Multi Inactive'
    ];

    $arrSearchBy = [
        ['name'  => '- Search By All -', 'id' => 'all'],
        ['name'  => 'Search By ID', 'id' => 'id'],
        ['name'  => 'Search By Name', 'id' => 'name'],
        ['name'  => 'Search By Description', 'id' => 'description'],
        ['name'  => 'Search By Link', 'id' => 'link']
    ];

    require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-index.php';

    if(!empty($this->Items)){
        foreach($this->Items as $item){
            $id 		    = $item['id'];
            $ordering       = $item['ordering'];

            $linkEdit       = URL::createLink($module, $controller, 'form', ['id' => $id]);
            $checkbox       = HTML::showItemCheckbox($id);
            $resultID       = Helper::highLight($item['id'], $searchField, $searchValue, 'id');
            $picture        = HTML_Frontend::getSrcPictureAdmin($controller, $item['picture'], '300', '124');
            $status	 	    = HTML::showItemState($module, $controller, $id, 'status', $item['status']);            

            $inputOrdering  = Helper::cmsInput('number', "chkOrdering['$id']", $id, 'chkOrdering form-control form-control-sm m-auto text-center', $ordering, null, 'width: 65px', null, $id);
            $created        = HTML::showItemHistory($item['created_by'], $item['created']);
            $modified       = HTML::showItemHistory($item['modified_by'], $item['modified']);
            $arrInfo        = [
                ['name' => 'Name', 'value' => Helper::highLight($item['name'], $searchField, $searchValue, 'name')],
                ['name' => 'Description', 'value' => Helper::highLight($item['description'], $searchField, $searchValue, 'description')],
                ['name' => 'Link', 'value' => Helper::highLight($item['link'], $searchField, $searchValue, 'link')]
            ];
            $info           = HTML::showUserInfo($arrInfo, $picture);

            $btnAction      = HTML::showActionButton($module, $controller, $id);    
            $xhtml         .= '
            <tr>
                <td class="text-center">'.$checkbox.'</td>
                <td class="text-center">'.$resultID.'</td>
                <td style="width:100px;">'.$info.'</td>
                <td class="text-center position-relative">'.$status.'</td>
                <td class="text-center position-relative">'.$inputOrdering.'</td>
                <td class="text-center">'.$created.'</td>
                <td class="text-center modified-'.$id.'">'.$modified.'</td>
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

            <div>
                <form action="#" method="post" class="table-responsive" id="admin-form" name="admin-form">
                    <?php echo $btnAdd . ' ' . $btnCancel;?>
                </form>
            </div>

        </div>
        
        <!-- List Content -->
        <form action="#" method="post" class="table-responsive" id="form-table" name="form-table">
            <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center"><?= $checkAll ;?></th>
                        <th class="text-center"><?= $lblID ;?></th>
                        <th>Info</th>
                        <th class="text-center"><?= $lblStatus ;?></th>
                        <th class="text-center"><?= $lblOrdering ;?></th>
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
