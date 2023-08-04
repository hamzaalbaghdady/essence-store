<?php
require_once "../model/userClass.php";
$user = new user;
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $data = $user->getUserById($user_id);
    if ($data['status'] === "Blocked") {
        if ($data['pass'] === "Unset")
            $user->updateStatus($user_id, "not member");
        else $user->updateStatus($user_id, "Member");
    } else
        $user->updateStatus($user_id, "Blocked");

    header("Location:table.php");
}
