<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?= $this->_title;?>
    <?php $imageURL   = $this->_dirImg; ?>
    <?= $this->_metaHTTP;?>
    <?= $this->_metaName;?>
    <link rel="icon"          href="<?php echo $imageURL;?>/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $imageURL;?>/favicon.png" type="image/x-icon">
    <link rel="stylesheet"    href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900">
    <?= $this->_cssFiles;?>
</head>
<body>
    <?php
        require_once PATH_MODULE. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'
    ;?>     

    <!-- script -->
    <?php echo $this->_jsFiles; ?>
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