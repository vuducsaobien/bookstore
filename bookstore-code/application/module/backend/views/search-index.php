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
                <?php echo $btnFilter; ?>
            </div>

            <div class="mb-1">
                <form id="filter-bar" name="filter-bar" method="GET" action="">
                    <?php echo $inputFilterBar; ?>
                </form>
            </div>

            <div class="mb-1">
                <form action="" method="GET" id="form_search" name="form_search">
                    <div class="input-group">
                        <?php echo $inputFormSearch; ?>
                        <div class="input-group-append">
                            <?php echo $buttonsIndex; ?>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>