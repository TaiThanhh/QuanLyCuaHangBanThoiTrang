<?php
    session_start();
    require 'Class/Customer.php';
    $logout = Customer::Logout();
?>