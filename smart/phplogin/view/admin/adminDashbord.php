<?php
require "../header/header.php";
include $_SERVER['DOCUMENT_ROOT'] . '/smart/phplogin/controller/AdminController.php';
if ($_SESSION['page'] != 'Admin Page') {
    header("Refresh:0");
    $_SESSION['page'] = 'Admin Page';
}
$admin = new \phplogin\controller\AdminController();
$users = $admin->getUser();
if (isset($_POST['createUser'])) {
    $admin->createUser($_POST);
    header("Refresh:0");
}
if (isset($_POST['Update'])) {
    $admin->update($_POST);
    header("Refresh:0");
}
if (isset($_POST['deleteUser'])) {
    $admin->delete($_POST);
}
$getalltests = $admin->getoivote()
?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="p-4 border rounded " autocomplete="off" method="post">
                        <input class="form-control mt-2" value=""
                               type="email" placeholder="email" name="email">
                        <input class="form-control mt-2"
                               value=""
                               type="text" placeholder="name" name="name">
                        <input class="form-control mt-2"
                               value=""
                               type="password" placeholder="password" name="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="createUser" class="btn btn-primary" value="Save changes">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalDel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="alert-danger">Have you deleted this user?</p>
                </div>
                <div class="modal-footer d-flex ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form autocomplete="off" method="post">
                        <input type="hidden" id="delhidden" value="" name="deletebyID">
                        <input type="submit" type="button" name="deleteUser" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end del-->
    <!--end Modal Create-->
    <div class="modal fade" id="exampleModalUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                </div>
                <div class="modal-body">
                    <form class="p-4 border rounded " autocomplete="off" method="post">
                        <input class="form-control mt-2" value=""
                               type="email" placeholder="email" name="email">
                        <input class="form-control mt-2"
                               value=""
                               type="text" placeholder="name" name="name">
                        <select name="role" class="form-select mt-2" aria-label="Default select example">
                            <option selected value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <input type="hidden" id="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="Update" class="btn btn-primary" value="Save changes">
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--end Modal Update-->
    <div class="container mt-3">
<?php if (!is_null($getalltests)): ?>
        <div class="d-flex flex-wrap justify-content-center ">
            <table class="table-success mt-2 table">
                <thead>
                <tr>
                    <th scope="row">User Name</th>
                    <th scope="row">Category</th>
                    <th scope="col">Point</th>
                </tr>
                </thead>
                <?php foreach ($getalltests as $quiz): ?>
                <tbody>
                <tr>
                    <th scope=""><?php echo $quiz["user_name"]  ?></th>
                    <td class=""><?php echo $quiz['category'] ?></td>
                    <td colspan=""><?php echo $quiz['point'] ?></td>
                    <?php endforeach; ?>

                </tr>
                </tbody>

            </table>
        </div>
<?php endif; ?>
        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-success ">Create</button>
        <table class="table ">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Handled</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <?php if($_SESSION['user_id'] != $user['id']): ?>
                <th scope="row"><?php echo $user['id'] ?></th>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td class="d-flex">
                    <button onclick="getId(<?php echo $user['id'] ?>)" data-bs-toggle="modal"
                            data-bs-target="#exampleModalUp" class="btn m-2 btn-warning" >Update
                    </button>
                </td>
                <td>
                    <button onclick="getId(<?php echo $user['id'] ?>)" data-bs-toggle="modal"
                            data-bs-target="#exampleModalDel" class="btn m-2 btn-danger">Delete
                    </button>
                </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type='text/javascript' src='/public/script.js'></script>
    </body>
    </html>
    <?php
include "../footer/footer.php";