<?php
    // Link URL
    $arrParam       = $this->arrParam;
    $module         = $arrParam['module'];
    $controller     = $arrParam['controller'];
    $controllerName = ucfirst($controller);
    $action         = $arrParam['action'];
    $dataForm       = $arrParam['form'];

    // MESSAGE
    $error = $this->errors;
    if (!empty($error)) { echo $message = $error; } else { echo $message = HTML::showMessage(); }

    // Input
    $inputToken        = Helper::cmsInput('hidden', 'form[token]', 'form[token]', null, time());
    $inputFullName     = Helper::cmsInput('text', 'form[fullname]', 'form[fullname]', 'form-control form-control-sm', $dataForm['fullname']);
    $inputName         = Helper::cmsInput('text', 'form[name]', 'form[name]', 'form-control form-control-sm', $dataForm['name']);
    $inputOrdering      = Helper::cmsInput('number', 'form[ordering]', 'form[ordering]', 'form-control form-control-sm', $dataForm['ordering']);

    $inputUserName     = Helper::cmsInput('text', 'form[username]', 'form[username]', 'form-control form-control-sm', $dataForm['username'], null, null, $readonly);
    $inputEmail        = Helper::cmsInput('text', 'form[email]', 'form[email]', 'form-control form-control-sm', $dataForm['email'], null, null, $readonly);
    $inputPicture       = Helper::cmsInput('file', 'picture', 'picture', 'form-control form-control-sm', $dataForm['picture']);

    $inputShortDes      = '<textarea id="form[short_description]" name="form[short_description]" value="'.$dataForm['short_description'].'" 
    class="form-control form-control-sm" rows="4">'.$dataForm['short_description'].'</textarea>';
    $inputDescription   = '<textarea id="form[description]" name="form[description]" value="'.$dataForm['description'].'" 
    class="form-control form-control-sm" rows="20">'.$dataForm['description'].'</textarea>';
    $inputPrice         = Helper::cmsInput('number', 'form[price]', 'form[price]', 'form-control form-control-sm', $dataForm['price']);
    $inputSaleOff       = Helper::cmsInput('number', 'form[sale_off]', 'form[sale_off]', 'form-control form-control-sm', $dataForm['sale_off']);  

    $inputLink          = Helper::cmsInput('text', 'form[link]', 'form[link]', 'form-control form-control-sm', $dataForm['link']);

    // Select Box
    $arrStatus   = [
        ['name'  => '- Select Status -', 'id' => 'default'],
        ['name'  => 'Active', 'id' => 'active'],
        ['name'  => 'Inactive', 'id' => 'inactive']
    ];
    $arrGroupACP = [
        ['name'  => '- Select Group ACP -', 'id' => 'default'],
        ['name'  => 'Yes', 'id' => '1'],
        ['name'  => 'No', 'id' => '0']
    ];
    $arrSpecial   = [
        ['name'  => "- Special $controllerName ? -",  'id' => 'default'],
        ['name'  => 'Yes',                   'id' => '1'],
        ['name'  => 'No',                 'id' => '0']
    ];

    $slbSpecial         = HTML::createSelectBox($arrSpecial, 'form[special]', 'custom-select custom-select-sm', 'width: unset', null, null, $dataForm['special']);
    $slbGroupACP = HTML::createSelectBox($arrGroupACP, 'form[group_acp]', 'custom-select custom-select-sm', 'width: unset', null, null, $dataForm['group_acp']);
    $slbStatus   = HTML::createSelectBox($arrStatus, 'form[status]', 'custom-select custom-select-sm', 'width: unset', null, null, $dataForm['status']);

    // Row
    $rowStatus         = Helper::cmsRowForm('Status', $slbStatus, false, 'status', 'col-sm-2 col-form-label text-sm-right required');
    $rowOrdering       = Helper::cmsRowForm('Ordering', $inputOrdering, false, 'ordering', 'col-sm-2 col-form-label text-sm-right required');
    $rowSpecial         = Helper::cmsRowForm("Special $controllerName", $slbSpecial, false, 'special', 'col-sm-2 col-form-label text-sm-right required');

    $rowFullName	    = Helper::cmsRowForm('Fullname', $inputFullName, false, 'form[fullname]', 'col-sm-2 col-form-label text-sm-right');
    $rowGroupACP       = Helper::cmsRowForm('Group ACP', $slbGroupACP, false, 'group_acp', 'col-sm-2 col-form-label text-sm-right required');
    $rowName           = Helper::cmsRowForm('Name', $inputName, false, 'name', 'col-sm-2 col-form-label text-sm-right required');

    $rowUserName	    = Helper::cmsRowForm('Username', $inputUserName, false, 'form[username]', 'col-sm-2 col-form-label text-sm-right '.$required.'');
    $rowEmail		    = Helper::cmsRowForm('Email', $inputEmail, false, 'form[email]', 'col-sm-2 col-form-label text-sm-right '.$required.'');

    $rowShortDes        = Helper::cmsRowForm('Short Description', $inputShortDes, false, 'short_description', 'col-sm-2 col-form-label text-sm-right');
    $rowDescription     = Helper::cmsRowForm('Description', $inputDescription, false, 'description', 'col-sm-2 col-form-label text-sm-right');
    $rowPrice           = Helper::cmsRowForm('Price', $inputPrice, false, 'price', 'col-sm-2 col-form-label text-sm-right');
    $rowSaleOff         = Helper::cmsRowForm('Sale Off', $inputSaleOff, false, 'sale_off', 'col-sm-2 col-form-label text-sm-right');


?>
