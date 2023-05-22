<?php require('header.php');
require_once('../includes/info_db_connect.php');
if (isset($_SESSION['stno'])) {
} else {
    header("Location: login.php");
}
include('sidebar.php');
ob_start();
$office_id = rand();
$office_address = "";
?>


<div class='col-4'>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $department_id = $_POST["department_id"] ?? "";
        $office_address = $_POST["office_address"] ?? "";


        // Generate a unique user ID
        // $userid = uniqid();

        $sql = "INSERT INTO offices (office_id, office_address) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$office_id, $office_address]);

        $successMessage = "Office Added Successfully";

        // Clear user input

        $office_id = rand();
        $office_address = "";
    }
    ?>


    <div class="row">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Add Office Section </h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back </i></li>
                </a>
                <hr>
                <form action="" method="post">
                    <div class="row">
                        <?php if (!empty($successMessage)) : ?>
                            <div class="success-message"><?php echo $successMessage; ?></div>
                            <script>
                                setTimeout(function() {
                                    var successMessage = document.querySelector('.success-message');
                                    successMessage.style.display = 'none';
                                }, 3000);
                            </script>
                        <?php endif; ?>
                        <div class="col-8">

                            <label for=" Office Adress">Office address</label>
                            <input class="form-input" type="text" id="office_address" name="office_address" placeholder="..." maxlength="256" required value="<?php echo $office_address; ?>">
                        </div>
                    </div>

                    <input class="btn" type="submit" name="submit" value="Add Office address">
                </form>
            </div>
        </div>
    </div>

</div>


<style>
    .user-list {
        border: 1px solid #ccc;
        padding: 10px;
        width: 100%;
        background-color: #f7f7f7;
    }

    .user-list ul {
        list-style-type: none;
        padding: 0;
    }

    .user-list li {
        border-bottom: 1px solid #ccc;
        padding: 5px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .icons {
        display: flex;
        gap: 10px;
    }

    .icons:last-child {
        margin-left: auto;
    }

    .icon {
        display: flex;
        align-items: flex-end;

    }

    .user-list-header {
        margin-right: 10px;
    }

    .box {
        padding-bottom: 30%;
    }
    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>