<?php
session_start();
$con=mysqli_connect("localhost","root","","ecommerce");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/milk_island/');
define('SITE_PATH','http://localhost/milk_island/');
define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/products/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/products/');

define('SERVER_PATH1',$_SERVER['DOCUMENT_ROOT'].'/milk_island/');
define('SITE_PATH1','http://localhost/milk_island/');
define('CATEGORY_IMAGE_SERVER_PATH',SERVER_PATH1.'media/category/');
define('CATEGORY_IMAGE_SITE_PATH',SITE_PATH1.'media/category/');
?>