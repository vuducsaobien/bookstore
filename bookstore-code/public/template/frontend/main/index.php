<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->_title;?>
    <?php $imageURL   = $this->_dirImg; ?>
    <?= $this->_metaHTTP;?>
    <?= $this->_metaName;?>
    <link rel="icon"          href="<?php echo $imageURL;?>/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $imageURL;?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet"    href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;900&display=swap" rel="stylesheet">
    <?= $this->_cssFiles;?>
</head>

<body>
    <script>
        var module = '<?= $this->arrParam['module'] ?>';
        var controller = '<?= $this->arrParam['controller'] ?>';
        var rootURL = '<?php echo URL_ROOT ?>';
    </script>

    <div class="loader_skeleton">
        <div class="typography_section">
            <div class="typography-box">
                <div class="typo-content loader-typo">
                    <div class="pre-loader"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- header start -->
        <?php require_once 'html/header.php' ;?>
    <!-- header end -->

    <!-- LOAD CONTENT -->
        <!-- Tab product --> 
            <?php require_once PATH_MODULE. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php' ;?>     
        <!-- Tab product end -->
    <!-- END LOAD CONTENT -->

    <!-- footer -->
        <?php require_once 'html/footer.php' ;?>
    <!-- footer end -->

    <!-- tap to top -->
        <div class="tap-top top-cls">
            <div>
                <i class="fa fa-angle-double-up"></i>
            </div>
        </div>
    <!-- tap to top end -->

    <!-- script -->
    <?= $this->_jsFiles; ?>
    <?php require_once 'html/script.php' ;?>
</body>

</html>