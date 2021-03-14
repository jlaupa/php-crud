<?php
include '../../Models/User.php';
include '../../header.php';

$user = new User();

if (isset($_REQUEST['id']) && $_REQUEST['id'] > 1) {
    $user->one($_REQUEST['id']);
}

if (!empty($_POST['save'])) {
    unset($_POST['save']);

    if (isset($_REQUEST['id']) && $_REQUEST['id'] < 1) {
        $result = $user->store($_POST);
    } else {
        $result = $user->update($_POST);
    }
}

include 'fields.php';
include '../../footer.php';
