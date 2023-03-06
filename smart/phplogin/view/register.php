<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] .'/smart/phplogin/controller/HomeController.php';
include "./header/header.php";

use HomeController as home;

if (isset($_SESSION['id'])) {
    header("location: index.php");
}
if (isset($_POST['submit'])) {

    home::create($_POST);
}
?>
    <div class="container mt-4 d-flex justify-content-center">
        <div class="w-50 text-center mt-4 ">
            <h1>Register</h1>
            <!--            --><?php //if (home::$error): ?>
            <!--            <p class="text-danger" >--><?php //echo home::$error ?><!-- </p>-->
            <!--            --><?php //endif; ?>
            <form class="p-4" autocomplete="off" method="post">
                <input class="form-control mt-2" value=""
                       type="email" placeholder="email" name="email">
                <input class="form-control mt-2"
                       value=""
                       type="text" placeholder="name" name="name">
                <input class="form-control mt-2"
                       value=""
                       type="password" placeholder="password" name="password">
                <input class="form-control mt-2"
                       value=""
                       type="password" placeholder="Confirm Password" name="confirmPassword">
                <input class="btn  btn-success mt-2" type="submit" name="submit">

            </form>
        </div>


    </div>
<?php
include "./footer/footer.php";
?>