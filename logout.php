<?php

if (session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}

session_destroy();

header('Location:login.php');
