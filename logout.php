<?php

ob_start();
session_start();
unset($_SESSION['ad_name']);
unset($_SESSION['ad_uid']);
unset($_SESSION['ad_username']);
echo '<script type="text/javascript">window.location="login.php"; </script>';


?>