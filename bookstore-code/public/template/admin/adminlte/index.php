<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $this->_metaHTTP; ?>
    <?php echo $this->_metaName; ?>
    <title><?php echo $this->_title; ?></title>
    <?php echo $this->_cssFiles; ?>
    <?= $this->_jsFiles; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
<!-- <body class="hold-transition sidebar-mini layout-fixed text-sm sidebar-collapse"> -->

    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once 'html/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php require_once 'html/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php require_once 'html/page-header.php'; ?>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!--  LOAD CONTENT -->
                    <?php
                    require_once PATH_MODULE . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
                    ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php require_once 'html/footer.php'; ?>
    </div>
    <!-- ./wrapper -->

    <!-- script -->
</body>

</html>