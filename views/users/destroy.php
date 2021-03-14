<?php
include '../../Models/User.php';
include '../../header.php';

$user = new User();
if (isset($_REQUEST['id']) && $_REQUEST['id'] > 1) {
    $user->destroy($_REQUEST['id']);
}
