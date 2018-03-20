<?php
/**
 * Created by PhpStorm.
 * User: jarek
 * Date: 05.03.18
 * Time: 21:33
 */
include_once (dirname(dirname(__FILE__)) . '/config/bundles.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$insertIcons = new \App\Controller\AdminController();
$insertIcons->iconsAction();
