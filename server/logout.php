<?php
session_start();
session_unset();
session_destroy();
setcookie('user_logged_in', '', time() - 3600, '/');