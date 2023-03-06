<?php

use phplogin\controller\TestController;

require "./header/header.php";
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/controller/TestController.php';

if ($_SESSION['page'] != 'Home') {
    header("Refresh:0");
    $_SESSION['page'] = 'Home';
}

$getController = new TestController();
$store = $getController->store('category');
if (isset($_POST['submit'])) {

    $_SESSION['category_id'] = $_POST['category'];
    header('location: tests.php');
}
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}
$getquiz = $getController->getpivote();

?>
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center ">
            <table class="table-success mt-2 table">
                <thead>
                <tr>
                    <th scope="row">Category Name</th>
                    <th scope="row">Questions Content</th>
                    <th scope="col">Success answer</th>
                    <th scope="col">Category point</th>
                </tr>
                </thead>
                <?php foreach ($getquiz as $quiz): ?>
                <tbody>
                <tr>
                    <th scope=""><?php echo $quiz['category_name'] ?></th>
                    <td class=""><?php echo $quiz['content'] ?></td>
                    <td colspan=""><?php echo $quiz['answer'] ?></td>
                    <td colspan=""><?php echo $quiz['point']; ?></td>

                    <?php endforeach; ?>
                </tr>
                </tbody>

            </table>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <form method="post" action="" class="mt-5">
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInputGridtr"
                               placeholder="<?php echo $_SESSION['name'] ?>"
                               value="<?php echo $_SESSION['name'] ?>">
                        <label for="floatingInputGridtr">User Name</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input type="hidden" name="category_id" id="category" value="">
                        <select name="category" class="form-select" id="floatingSelectGrid"
                                aria-label="Floating label select example">
                            <?php foreach ($store as $category): ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                            <?php endforeach; ?>

                        </select>
                        <label for="floatingSelectGrid">Works with selects</label>
                    </div>
                </div>
            </div>
            <input class="btn btn-outline-primary mt-2" type="submit" name="submit" value="submit">
        </form>
    </div>
<?php
include "./footer/footer.php";





