<?php require('header.php');
require_once('../includes/info_db_connect.php');
if (isset($_SESSION['stno'])) {
} else {
    header("Location: login.php");
}
include('sidebar.php');
ob_start();

$job_type_id = rand();
$job_type_name = "";
$successMessage = "";
?>

<div class='col-4'>


    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $job_type_name = $_POST["job_type_name"] ?? "";

        $sql = "INSERT INTO job_types (job_type_id, job_type_name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$job_type_id, $job_type_name]);

        $successMessage = "Job Added Successfully";
        // Clear user input

        $job_type_id = rand();
        $job_type_name = "";
    }
    ?>
    <div class="box">

        <div class="row">
            <div class="col-8">

                <div class="user-list">

                    <h3 class="user-list-header">Add Job Section </h3>
                    <a href="data_entry_management.php">
                        <li><i class="fa fa-arrow-right">Back </i></li>
                    </a>
                    <hr>

                    <form action="" method="post">
                        <?php if (!empty($successMessage)) : ?>
                            <div class="success-message"><?php echo $successMessage; ?></div>
                            <script>
                                setTimeout(function() {
                                    var successMessage = document.querySelector('.success-message');
                                    successMessage.style.display = 'none';
                                }, 2000);
                            </script>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-8">

                                <label for="jobName">Job Name</label>
                                <input class="form-input" type="text" id="job_type_name" name="job_type_name" placeholder="..." maxlength="256" required value="<?php echo $job_type_name; ?>">


                            </div>
                        </div>

                        <input class="btn" type="submit" name="submit" value="Add ">
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