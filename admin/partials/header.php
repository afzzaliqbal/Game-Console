<?php
session_start();
require '../partials/header.php';

if(!isset($_SESSION['usr-id']))

{
  header('location:' .ROOT_URL . 'signin.php');
  die();
  
}
