<?php
session_start();

if (!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "You have to login";
    header("Location: login.php");
    exit(0);
} elseif ($_SESSION['auth_role'] == "1") {
    $_SESSION['message'] = "You are not a user!";
    header("Location: admin/index.php");
    exit(0);
}

include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                include('msg.php');
                ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h4>New Message</h4>
                    </div>
                    <div class="card-body">
                        <form action="allcode.php" method="post">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['auth_user']['user_id']; ?>">
                            <div class="form-group mb-3">
                                <label for="">Title </label>
                                <input type="text" name="title" class="form-control" required
                                    placeholder="Enter your title">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Message</label>
                                <div class="form-floating">
                                    <textarea name="editor" class="form-control" placeholder="Leave a comment here"
                                        id="floatingTextarea2" style="height: 100px "></textarea>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>