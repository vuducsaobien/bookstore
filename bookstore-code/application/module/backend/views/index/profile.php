<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
            $module     = $this->arrParam['module'];
            $readonly   = 'readonly';
            require_once PATH_MODULE . $module .DS. 'views' .DS. 'head-form.php';

            // Link Button
            $linkSave           = URL::createLink($module, $controller, $action, ['type' => 'save']);
            $linkSavedAndClose  = URL::createLink($module, $controller, $action, ['type' => 'save-close']);
            $linkCancel         = URL::createLink($module, 'user', 'index');
            // Button
            $btnSave	        = Helper::cmsButton('noIcon', 'Save', null, null, 'btn btn-sm btn-success mr-1', $linkSave);
            $btnSavedAndClose   = Helper::cmsButton('noIcon', 'Save & Close', null, null, 'btn btn-sm btn-success mr-1', $linkSavedAndClose);
            $btnCancel	        = Helper::cmsButton('noIcon', 'Cancel', null, null, 'btn btn-sm btn-danger mr-1', $linkCancel);

            $inputs     = $inputToken;
            $rows       = $rowUserName . $rowEmail . $rowFullName;
            $buttons    = $btnSave . $btnSavedAndClose . $btnCancel ;
        ?>

        <form action="#" method="post" class="mb-0" id="admin-form">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <?php echo $rows . $inputs?>
                </div>
                
                <div class="card-footer">
                    <div class="col-12 col-sm-8 offset-sm-2">
                        <?php echo $buttons?>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>
<!-- /.content -->
