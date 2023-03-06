<?php

use phplogin\controller\AdminController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../header/header.php";
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/controller/AdminController.php';
$admin = AdminController::class;

if ($_SESSION['page'] != 'Admin Login') {
    header("Refresh:0");
    $_SESSION['page'] = 'Admin Login';
}
if (isset($_POST['submit'])) {
    $admin::loginAdmin($_POST);
}
?>
    <div class="container mt-4 d-flex justify-content-center">
        <div class="w-50 text-center mt-4 ">
            <h1>Admin Login</h1>
            <?php if (!is_null($admin::$error)): ?>
                <p class="text-danger"><?php echo $admin::$error ?>  </p>
            <?php endif; ?>
            <form class="p-4" autocomplete="off" method="post">
                <input class="form-control mt-2" value=""
                       type="email" name="email">
                <input class="form-control mt-2"
                       value=""
                       type="password" name="password">
                <input class="btn  btn-success mt-2" type="submit" name="submit">
            </form>
        </div>
    </div>
<?php
include "../footer/footer.php";
?>