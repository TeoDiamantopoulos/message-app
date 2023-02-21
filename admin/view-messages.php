<?php
session_start();
include('authentication.php');
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <h5 class="mt-4">View Messages</h5>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Manage Users</li>
        <li class="breadcrumb-item">View Messages</li>
    </ol>
    <?php
    include('msg.php');
    ?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <?php
                    include('msg.php');
                    ?>
                    <div class="card shadow ">
                        <div class="card-header">
                            <h2>View Messages</h2>
                        </div>
                        <div class="card-body ">
                            <div class="accordion" id="chapters">
                                <?php
                                if (isset($_GET['id'])) {
                                    $current_id = mysqli_real_escape_string($con, $_GET['id']);
                                    $query = "SELECT * FROM posts,users WHERE posts.user_id=users.id AND user_id='$current_id'; ";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            $orgDate = $row['created'];
                                            $newDate = date("d-m-Y", strtotime($orgDate));
                                            ?>
                                            <div class="mt-2 ">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading-<?= $row['id_post']; ?>">
                                                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#chapter-<?= $row['id_post']; ?>" aria-expanded="true"
                                                            aria-controls="chapter-<?= $row['id_post']; ?>">
                                                            <div class="me-0 container-fluid">
                                                                <div class="float-start">
                                                                    <h5>
                                                                        <?= $row['title']; ?>
                                                                    </h5>
                                                                </div>
                                                                <div class="float-end">
                                                                    <h6>
                                                                        <?php echo "Submited $newDate"; ?>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id="chapter-<?= $row['id_post']; ?>" class="accordion-collapse collapse "
                                                        aria-labelledby="heading-<?= $row['id_post']; ?>"
                                                        data-bs-parent="#chapters ">
                                                        <div class="accordion-body">
                                                            <strong>
                                                                <?= $row['title']; ?>
                                                            </strong>
                                                            <p>
                                                                <?= $row['body']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <h1>No Record Found</h1>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

        include('includes/footer.php');
        include('includes/scripts.php');

        ?>