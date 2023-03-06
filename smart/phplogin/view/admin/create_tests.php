<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../header/header.php";
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/controller/TestController.php';

if ($_SESSION['page'] != 'Create Test') {
    header("Refresh:0");
    $_SESSION['page'] = 'Create Test';
}
$test = new \phplogin\controller\TestController();
if (isset($_POST['createtest'])) {
    $test->create($_POST);
}
?>
    <div class="container">

        <div class="row">
            <form method="POST" action="">
                <div class="form-group">
                    <div class="col-12 mb-5 mt-5">
                        <label class="col-sm-2 control-label" for="category">Category</label>
                        <input type="text" id="category" name="category">
                    </div>
                    <div class="col-12 mb-5 mt-5">
                        <label class="col-sm-2 control-label" for="name">Question</label>
                        <input type="text" id="name" name="name">
                    </div>
                    <div class="col-12 mb-5 mt-5">
                        <label class="col-sm-2 control-label" for="point">point</label>
                        <input type="number" min="1" id="point" max="5" name="point">
                    </div>
                    <label class="col-sm-2 control-label" for="field1">Create answers</label>
                    <div class="col-sm-10">
                        <div class="dynamic-wrap">
                            <div class="entry input-group">
                                <p>
                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                    <input type="radio" value="0" name="correct_answer[]">
                                </p>

                                <p>
                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                    <input type="radio" value="1" name="correct_answer[]">
                                </p>
                                <p>
                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                    <input type="radio" value="2" name="correct_answer[]">
                                </p>
                                <p>
                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                    <input type="radio" value="3" name="correct_answer[]">
                                </p>
                                <p>
                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                    <input type="radio" value="4" name="correct_answer[]">
                                </p>
                                <p>

                                </p>
                                <span class="input-group-btn">
                            <input class="btn btn-success  btn-add" name="createtest" type="submit" value="Add answer">
                          </span>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
include "../footer/footer.php";
?>