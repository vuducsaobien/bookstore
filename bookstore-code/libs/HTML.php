<?php
class HTML
{
    public static function showActionButton($module, $controller, $id)
    {
        $templateButton = [
            'view' => [
                'icon' => 'eye',
                'text' => 'View',
                'link' => URL::createLink($module, $controller, 'view', ['id' => $id]),        
                'class' => 'btn-primary'
            ],

            'edit' => [
                'icon' => 'pencil-alt',
                'text' => 'Edit',
                'link' => URL::createLink($module, $controller, 'form', ['id' => $id]),
                'class' => 'btn-info'
            ],

            'delete' => [
                'icon' => 'trash-alt',
                'text' => 'Delete',
                'link' => URL::createLink($module, $controller, 'multi_delete', ['id' => $id]),
                // 'link' => 'javascript:deleteItems(\'' . $id . '\');',
                'class' => 'btn-danger btn-delete-item'
            ],

            'reset-password' => [
                'icon' => 'key',
                'text' => 'Reset Password', 
                'link' => URL::createLink($module, $controller, 'reset_password', ['id' => $id]), 
                'class' => 'btn-secondary'
            ]
        ];

        $buttonInArea = [
            'default'   => ['edit', 'delete'],
            'group'     => ['edit', 'delete'],
            'user'      => ['reset-password', 'edit', 'delete'],
            'category'   => ['edit', 'delete'],
            'book'     => ['edit', 'delete'],
            'cart'      => ['view'],
            'slide'   => ['edit', 'delete']
        ];

        $controller = (array_key_exists($controller, $buttonInArea)) ? $controller : 'default';
        $listButton = $buttonInArea[$controller];

        $xhtml = '';

        foreach ($listButton as $btn) {
            $currentButton = $templateButton[$btn];
            $xhtml .= sprintf('
            <a href="%s" class="rounded-circle btn btn-sm %s" title="%s" data-toggle="tooltip">
                <i class="fas fa-%s"></i>
            </a>
            ', $currentButton['link'], $currentButton['class'], $currentButton['text'], $currentButton['icon']);
        }

        return $xhtml;
    }

    public static function showItemState($module, $controller, $id, $state, $value)
    {
        $link     = URL::createLink($module, $controller, 'changeState', ['id' => $id, $state => $value]);
        $class = 'success';
        $icon = 'check';

        if ($value == 'inactive' || $value == '0') {
            $class = 'danger';
            $icon = 'minus';
        }

        $xhtml = '
		<a href="' . $link . '" class="my-btn-state rounded-circle btn btn-sm btn-' . $class . '"><i class="fas fa-' . $icon . '"></i></a>
		';
        return $xhtml;
    }

    // Create Item History
    public static function showItemHistory($by, $time)
    {
        $time =  Helper::formatDate(TIMEDATE_FORMAT, $time);
        $xhtml = '
        <p class="mb-0 history-by"><i class="far fa-user"> ' . $by . '</i></p>
        <p class="mb-0 history-time"><i class="far fa-clock"> ' . $time . '</i></p>
        ';
        return $xhtml;
    }    
    
    public static function showMessage()
    {
        $message = Session::get('notify') ?? '';
        Session::delete('notify');

        if (!empty($message)) {
            $message = '
            <div class="alert alert-' . $message['type'] . ' alert-dismissible" id="admin-message">
                <button type="button" class="close p-2" data-dismiss="alert" aria-hidden="true">×</button>
                <p class="mb-0">' . $message['message'] . '</p>
            </div>
            ';
        }

        return $message;
    }

    public static function showFilterButton($arrParam, $itemStatusCount, $currentFilterStatus)
    {
        $xhtml = '';
        foreach ($itemStatusCount as $key => $value) {
            $link = URL::createLink($arrParam['module'], $arrParam['controller'], 'index', ['filter_status' => $key]);
            if(isset($arrParam['filter_group_acp'])) $link .= '&filter_group_acp=' . $arrParam['filter_group_acp'];
            if(isset($arrParam['filter_group_id'])) $link .= '&filter_group_id=' . $arrParam['filter_group_id'];
            if(isset($arrParam['filter_category_id'])) $link .= '&filter_category_id=' . $arrParam['filter_category_id'];
            if(isset($arrParam['filter_special'])) $link .= '&filter_special=' . $arrParam['filter_special'];
            if(isset($arrParam['search'])) $link .= '&search=' . $arrParam['search'];

            $name = '';
            switch ($key) {
                case 'all':
                    $name = 'All';
                    break;
                case 'active':
                    $name = 'Active';
                    break;
                case 'inactive':
                    $name = 'Inactive';
                    break;
            }
            $active = $key == $currentFilterStatus ? 'info' : 'secondary';
            $xhtml .= '<a href="' . $link . '" class="mr-1 btn btn-sm btn-' . $active . '">' . $name . ' <span class="badge badge-pill badge-light">' . $value . '</span></a>';
        }
        return $xhtml;
    }

    // Create HTML Info User
    public static function showUserInfo($arrInfo, $picture=null)
    {
        $xhtml = '';
        foreach($arrInfo as $item){
            $xhtml .= sprintf('<p class="mb-0">%s: %s</p>', $item['name'], $item['value']);
        }
        
        $xhtml .= $picture;
        return $xhtml;
    }

    // Create Item Checkbox
    public static function showItemCheckbox($id)
    {
        $xhtml = '
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="checkbox-' . $id . '" name="checkbox[]" value="' . $id . '">
            <label for="checkbox-' . $id . '" class="custom-control-label"></label>
        </div>
        ';
        return $xhtml;
    }

    public static function createSelectBox($arrData = null, $name = null, $class = null, $style = null , $id = null, $dataID = null, $keySelected = null)
    {
        $name   = ($name != null) ? 'name="'.$name.'"' : '';
        $class  = ($class != null) ? 'class="'.$class.'"' : '';
        $id     = ($id != null) ? 'id="'.$id.'"' : '';
        $dataID = ($dataID != null) ? 'data-id="'.$dataID.'"' : '';
        $style  = ($style != null) ? 'style="'.$style.'"' : '';
        
        $xhtml  = '<select '.$name.' '.$class.' '.$style.' '.$id.' '.$dataID.'>';
        if(!empty($arrData))
        {
            foreach($arrData as $value)
            {
                if($keySelected == $value['id'])
                {
                    $xhtml .= '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                }
                else
                {
                    $xhtml .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                }
            }
        }
        $xhtml .= '</select>';

        return $xhtml;
    }

    // Creat Side Bar
    public static function createSidebar($controller, $action, $arr)
    {
        $controller = ucfirst($controller);
        $action     = ucfirst($action);
        $parent     = $arr['parent'];
        $child      = $arr['child'];

        //     $arrUser  = ['parent' =>['name' => 'User', 'icon' => 'user','link' => '#'],
        //     'child'  =>[
        //                    ['name' =>'List','icon' => 'list-ul','link' => $linkUserList],
        //                    ['name' => 'Form','icon' => 'edit','link' => $linkUserForm],
        //                    ['name' => 'Reset Pass User','icon' => 'unlock-alt','link' => $linkChangePassUser]
        //                ]
        //    ];
        //     $user       = HTML::createSidebar($controller,$action,$arrUser);


        if (isset($child)) {
            if ($controller == $parent['name']) {
                $openMenu = 'has-treeview menu-open';
                $activeP = 'active';
            }
            $xhtml = '   
                <li class="nav-item ' . $openMenu . '"> 
                    <a href="' . $parent['link'] . '" class="nav-link ' . $activeP . '">
                        <i class="nav-icon fas fa-' . $parent['icon'] . '"></i>
                        <p>' . $parent['name'] . '
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
            ';
            $action = ($action == 'Index') ? 'List' : $action;

            foreach ($child as $value) {
                $active = "";
                if ($controller == $parent['name'] && $action == $value['name']) $active = 'active';
                $xhtml .= '
                            <li class="nav-item">
                                <a href="' . $value['link'] . '" class="nav-link ' . $active . '" >
                                    <i class="nav-icon fas fa-' . $value['icon'] . '"></i>
                                    <p>' . $value['name'] . '</p>
                                </a>
                            </li>
                        ';
            }
            $xhtml .= '</ul></li>';
        } else {
            if ($controller == $parent['name']) {
                $activeP = 'active';
            }
            $xhtml = '   
                        <li class="nav-item "> 
                            <a href="' . $parent['link'] . '" class="nav-link '.$activeP.'">
                                <i class="nav-icon fas fa-' . $parent['icon'] . '"></i>
                                <p>' . $parent['name'] . '</p>
                            </a>
                        </li>
                    ';
        }
        return $xhtml;
    }

    // Create Row Change Password
    public static function rowChangePass($type, $name, $value, $input=null)
    {
        if ($type == 'p') {
            $xhtml = '
            <div class="form-group row align-items-center">
                <label class="col-sm-2 col-form-label text-sm-right">'.$name.'</label>
                <div class="col-sm-8">
                    <p class="form-control form-control-sm bg-light mb-0">'.$value.'</p>
                </div>
            </div>
            ';
            } elseif($type == 'input') {
                $xhtml = '
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label text-sm-right">'.$name.'</label>
                    <div class="col-sm-8">
                        '.$input.'
                    </div>
                </div>
                ';
            }

            return $xhtml;
    }

        
    



    
}

