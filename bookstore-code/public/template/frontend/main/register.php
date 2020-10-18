<!DOCTYPE html>
<html lang="en">

<head>
    <?php $imageURL   = $this->_dirImg;?>
    <?= $this->_title;?>
    <?= $this->_metaHTTP;?>
    <?= $this->_metaName;?>
    <link rel="icon"          href="<?php echo $imageURL;?>/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $imageURL;?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet"    href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900">
    <?= $this->_cssFiles;?>
</head>

<body>
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
            <?php
                echo require_once PATH_MODULE. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
            ?>     
        <!-- Tab product end -->
    <!-- END LOAD CONTENT -->

    <!-- footer -->
        <?php require_once 'html/footer.php' ;?>
    <!-- footer end -->

    <!-- tap to top -->
        <?php require_once 'html/tap_to_top.php' ;?>
    <!-- tap to top end -->

    <!-- script -->
    <?= $this->_jsFiles; ?>
    <script>
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
            document.getElementById("search-input").focus();
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>
</body>

</html>