<?php

use phplogin\controller\TestController;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/controller/TestController.php';
error_reporting(E_ALL);
include "./header/header.php";
if ($_SESSION['page'] != 'Test') {
    header("Refresh:0");
    $_SESSION['page'] = 'Test';
};

$getController = new TestController();
$gettests = $getController->storeTests(['table' => 'questions'], ['category_id' => $_SESSION['category_id']]);
$getanswers = $getController->getanswers();
if (isset($_POST['submit'])) {
    $point = $getController->checkAnswer($_POST);
}
?>

    <form action="" method="post">
        <table class="table">

            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Question</th>
                <th scope="col">Point</th>
                <th scope="col">Answers</th>
            </tr>
            </thead>
            <?php foreach ($gettests as $tests): ?>

            <tbody>
            <tr>
                <th id="getanswers" scope="row"> <?php echo $tests['id'] ?></th>
                <td>
                    <?php echo $tests['content'] ?></td>
                <td><?php echo $tests['point'] ?></td>
                <td>
                    <?php foreach ($getanswers as $answer): ?>
                        <?php if ($answer['questions_id'] == $tests['id']): ?>
                            <label for="<?php echo $answer['id'] ?>">
                                <?php echo $answer['answer'] ?>
                            </label>
                            <input type="radio" id="<?php echo $answer['id'] ?>" value="<?php echo $answer['id'] ?>"
                                   name="fields[<?= $tests['id'] ?>]">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
                <?php endforeach; ?>
                <td>
                    <input type="submit" name="submit" value="submit">
                </td>
            </tr>
            </tbody>
        </table>
    </form>

<?php
include "footer/footer.php";