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
                    <thead><tr><?php echo $xhtmlSearch ;?></tr></thead>
                    <tbody><?php echo $xhtml ;?></tbody>
                </table>
                <div><?php echo $inputSortField .$inputSortOrder .$empty;?></div>
            </form>
        </div>
        <div class="card-footer clearfix"><?php echo $paginationHTML ;?></div>
    </div>
