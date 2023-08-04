<?php
require_once "dashboard/model/userClass.php";
$user = new user;
if (isset($_GET['id'])) {
    $data = $user->getUserById($_GET['id']);
    $user_name = $data['f_name'] . " " . $data['l_name'];
} else $user_name = null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocked Page</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-4"><img class="w-100" src="img/stop.png"></div>
            <div class="col-7">
                <h1 class="mb-3">
                    This account is Blocked
                </h1>
                <h4 class="mb-3">Dear <?= $user_name ?>,</h4>
                <p>
                    We regret to inform you that your account has been blocked on our website, effective immediately.
                    This decision was made due to a violation of our community guidelines and terms of service.
                    As a platform committed to providing a safe and respectful environment for all our users, we take
                    such matters seriously. Consequently, your account privileges have been revoked, and you will no
                    longer be able to access certain features on our website.
                    If you believe this action was taken in error or would like to seek further clarification, you can
                    contact our support team at <a href="#">essencestoresupport@email.com</a>. However, please note that
                    the
                    decision to block an
                    account is final and is subject to our website's <a href="#">terms</a> and <a href="#">conditions</a>.
                    Thank you for your understanding.
                    Sincerely,
                </p>
                <p><b>EssenceStore Team</b></p>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>