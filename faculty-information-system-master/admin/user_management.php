<?php
require('header.php');
require_once('../includes/db_connect.php');

if (isset($_SESSION['stno'])) {
} else {
    header("Location: login.php");
}

include('sidebar.php');
ob_start();
?>

<div class='col-6' style="width: 50%;">
    <div class="box">
        <form action="" method="post">  
            <div class="row">
                <div class="">
                    <div class="user-list">
                        <h3 class="user-list-header">User List</h3>
                        <a href="add_user.php"><i class="fa fa-plus"> Add user</i></a>
                        <hr>
                        <?php
                        require_once('../OOPClasses/UserManager.php');
                        $db = new DBConnect();
			            $conn = $db->getConnection();
                        $userListManager = new UserListManager($conn);
                        $userListManager->getUserList();  // Call the getUserList() method
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .user-list {
        padding: 10px;
        width: 100%;
        background-color: #f7f7f7;
    }

    .user-list table {
        width: 100%;
        border-collapse: collapse;
    }

    .user-list th,
    .user-list td {
        padding: 8px;
        border-bottom: 1px solid #ccc;
        text-align: left;
    }

    .user-list th {
        background-color: #f2f2f2;
    }

    .user-list-header {
        margin-right: 10px;
    }
</style>
<script></script>
<?php require('../footer.php') ?>
