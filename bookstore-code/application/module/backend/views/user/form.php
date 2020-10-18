<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
            $module     = $this->arrParam['module'];            
            require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-form.php';
            
            $readonly       = '';
            $required       = 'required';
            if (isset($this->arrParam['id']) || $dataForm['id']) {
                $readonly      = 'readonly';
                $required      = '';
                $inputID       = Helper::cmsInput('hidden', 'form[id]', 'form[id]', 'form-control form-control-sm', $dataForm['id'], null, null, 'readonly');
            }else{
                $inputPassword  = Helper::cmsInput('text', 'form[password]', 'form[password]', 'form-control form-control-sm', $dataForm['password'], null, null, $readonly);
                $rowPassword    = Helper::cmsRowForm('Password', $inputPassword, false, 'form[password]', 'col-sm-2 col-form-label text-sm-right required');          
            }

            $slbGroup           = Helper::cmsSelectbox('form[group_id]', $this->filterGroup, $dataForm['group_id'], 'custom-select custom-select-sm mr-1', 'width: unset');
            $rowGroup	        = Helper::cmsRowForm('Group', $slbGroup, false, 'group_id', 'col-sm-2 col-form-label text-sm-right required');

            // Link Button
            $linkSave           = URL::createLink($module, $controller, $action, ['type' => 'save']);
            $linkSavedAndNew    = URL::createLink($module, $controller, $action, ['type' => 'save-new']);
            $linkSavedAndClose  = URL::createLink($module, $controller, $action, ['type' => 'save-close']);
            $linkCancel         = URL::createLink($module, $controller, 'index');
            // Button
            $btnSave	        = Helper::cmsButton('noIcon', 'Save', null, null, 'btn btn-sm btn-success mr-1', $linkSave);
            $btnSavedAndNew	    = Helper::cmsButton('noIcon', 'Save & New', null, null, 'btn btn-sm btn-success mr-1', $linkSavedAndNew);
            $btnSavedAndClose   = Helper::cmsButton('noIcon', 'Save & Close', null, null, 'btn btn-sm btn-success mr-1', $linkSavedAndClose);
            $btnCancel	        = Helper::cmsButton('noIcon', 'Cancel', null, null, 'btn btn-sm btn-danger mr-1', $linkCancel);
            
        ?>

        <form action="#" method="post" class="mb-0" id="admin-form">
            <div class="card card-info card-outline">
                <div class="card-body">
                        <?php echo $rowUserName . $rowEmail . $rowFullName . $rowStatus . $rowGroup . $rowPassword . $inputToken .$inputID;?>
                </div>
                
                <div class="card-footer">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <?php echo $btnSave . $btnSavedAndNew . $btnSavedAndClose . $btnCancel ;?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->
