<?php 
require 'config/constants.php';
session_destroy();
unset($_SESSION['user-id']);
header('location:' .ROOT_URL);
die();