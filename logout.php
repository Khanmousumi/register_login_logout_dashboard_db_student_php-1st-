<?php

session_start();

// সব session remove
session_unset();

// Session destroy
session_destroy();

// Login page-এ ফিরে যাবে
header("Location: ../login/login.php");
exit();

?>