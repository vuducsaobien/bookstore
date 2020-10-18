<?php
    /* ------INDEX----- */
        // Link URL
        $arrParam       = $this->arrParam;
        $controller     = $arrParam['controller'];
        $controllerName = ucfirst($controller);
        $action         = $arrParam['action'];
        $linkReload     = URL::createLink($module, $controller, $action);
        $linkAdd        = URL::createLink($module, $controller, 'form');

        $linkCancel         = URL::createLink($module, 'index', 'dashboard');
        $btnCancel          = Helper::cmsButton('noIcon', 'Cancel', null, null, 'btn btn-sm btn-danger mr-1', $linkCancel);    

        // Sort
        $columnPost		= $arrParam['sort_field'];
        $orderPost		= $arrParam['sort_order'];

        $lblID			= Helper::cmsLinkSort('ID', 'id', $columnPost, $orderPost);
        $lblName 		= Helper::cmsLinkSort('Name', 'name', $columnPost, $orderPost);

        $lblStatus		= Helper::cmsLinkSort('Status', 'status', $columnPost, $orderPost);
        $lblOrdering	= Helper::cmsLinkSort('Ordering', 'ordering', $columnPost, $orderPost);
        $lblSpecial		= Helper::cmsLinkSort('Special', 'special', $columnPost, $orderPost);

        $lblCreated		= Helper::cmsLinkSort('Created', 'created', $columnPost, $orderPost);
        $lblCreatedBy	= Helper::cmsLinkSort('Created By', 'created_by', $columnPost, $orderPost);
        $lblModified	= Helper::cmsLinkSort('Modified', 'modified', $columnPost, $orderPost);
        $lblModifiedBy	= Helper::cmsLinkSort('Modified By', 'modified_by', $columnPost, $orderPost);

        $lblMembers 	= Helper::cmsLinkSort('Members*', 'total_members', $columnPost, $orderPost, 'desc');
        $lblGroupACP	= Helper::cmsLinkSort('Group ACP', 'group_acp', $columnPost, $orderPost);    
        $lblBookNumber	= Helper::cmsLinkSort('Book Number*', 'total_books', $columnPost, $orderPost);
        $lblPrice 		= Helper::cmsLinkSort('Price', 'price', $columnPost, $orderPost);
        $lblSaleOff 	= Helper::cmsLinkSort('Sale Off', 'sale_off', $columnPost, $orderPost);
    
        // Pagination
        $paginationHTML		= $this->pagination->showPagination(URL::createLink($module, $controller, $action));
        
        $searchValue    = $arrParam['search'] ?? '';
        $searchField    = $arrParam['filter_search_by'] ?? '';

        $arrSpecial = [
            ['name'  => '- Select Special Category -' , 'id' => 'default'],
            ['name'  => 'Yes'                       , 'id' => '1'],
            ['name'  => 'No'                        , 'id' => '0']
        ];
    
        // MESSAGE
        echo HTML::showMessage();

        $emptyHead = '
            <div class="alert alert-warning alert-dismissible text-center" id="admin-message">
                <button type="button" class="close p-2" data-dismiss="alert" aria-hidden="true">×</button>
                <p class="mb-0">Dữ liệu đang cập nhật !!</p>
            </div>    
        ';
    /* ------INDEX----- */

    /* ------LIST----- */
        // Input
        $inputSortField = Helper::cmsInput('hidden', 'sort_field', null, null, '', null, null);
        $inputSortOrder = Helper::cmsInput('hidden', 'sort_order', null, null, '', null, null);
        $inputCheckAll        = Helper::cmsInput('checkbox', 'check-all', 'check-all', 'custom-control-input');
        // Button
        $btnAdd               = Helper::cmsButton('add', " Add $controllerName", null, null, 'btn btn-sm btn-info', $linkAdd, null, 'fas fa-plus');
        $btnReload            = Helper::cmsButton('add', null, null, 'button', 'btn btn-tool', $linkReload, null, 'fas fa-sync');
        $btnApply	          = Helper::cmsButton('apply', 'Apply', 'bulk-apply', null,  'btn btn-sm btn-info');

        $slbAction = Helper::cmsSelectbox('bulk-action', $arrAction, $arrParam['bulk-action'], 'custom-select custom-select-sm mr-1', 'width: unset', 'bulk-action');
        $checkAll        = Helper::cmscheckAll($inputCheckAll);
    /* ------LIST----- */

    /* ------SEARCH----- */
        // Select Box
        $slbSearchBy   = HTML::createSelectBox($arrSearchBy, 'filter_search_by', 'custom-select custom-select-sm', 'width: unset', null, null, $arrParam['filter_search_by']);

        // Button
        $btnSearch = Helper::cmsButton('button', 'Search', null, 'submit', 'btn btn-sm btn-info');
        $btnClear  = Helper::cmsButton('button', 'Clear', 'btn-clear-search', 'button', 'btn btn-sm btn-danger');

        // Input
        $inputModule     = Helper::cmsInput('hidden', 'module', null, null, $module, null, null);
        $inputController = Helper::cmsInput('hidden', 'controller', null, null, $controller, null, null);
        $inputAction     = Helper::cmsInput('hidden', 'action', null, null, $action, null, null);
        $inputSearch     = Helper::cmsInput('text', 'search', null, 'form-control form-control-sm', $arrParam['search'], null, 'min-width: 300px');

        // Search Status
        $itemsStatusCount = [
            'all'      => $this->countActive + $this->countInactive,
            'active'   => $this->countActive,
            'inactive' => $this->countInactive
        ];

        $currentFilterStatus = $arrParam['filter_status'] ?? 'all';
        $btnFilter = HTML::showFilterButton($arrParam, $itemsStatusCount, $currentFilterStatus);
    /* ------SEARCH----- */

?>
