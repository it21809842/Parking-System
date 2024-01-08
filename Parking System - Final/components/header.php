<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="icon" type="image/x-icon" href="./img/favicon.ico">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./js/md5.js"></script>
<script src="./js/validationPatterns.js"></script>
<link rel="stylesheet" href="./css/style.css">

<?php
// start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once('./functions/database_config.php');
?>