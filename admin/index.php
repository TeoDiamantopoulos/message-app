<?php
session_start();
include('authentication.php');
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Panel</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin Panel</li>
    </ol>
    <?php
    include('msg.php');
    ?>
    <div class="row">
    </div>
</div>
<?php

include('includes/footer.php');
include('includes/scripts.php');

?>