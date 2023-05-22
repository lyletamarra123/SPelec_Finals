<?php
require('header.php');
require_once('../includes/info_db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

include('sidebar.php');
ob_start();

$job_type_id = "";
$job_type_name = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['job_type_id'])) {
        header("Location: data_entry_management.php");
        exit;
    }
    $job_type_id = $_GET["job_type_id"];
    $sql = "SELECT * FROM job_types WHERE job_type_id = $job_type_id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: data_entry_management.php");
        exit;
    }
    $job_type_id = $row["job_type_id"];
    $job_type_name = $row["job_type_name"];
    


    $successMessage = "User Added Successfully";

    // Clear user input

} else {

    $job_type_id = $_POST["job_type_id"];
    $job_type_name = $_POST["job_type_name"];
  


    $sql = "UPDATE job_types " .
        "SET job_type_id = '$job_type_id', job_type_name = '$job_type_name'" .
        "WHERE job_type_id = $job_type_id";

    $result = $conn->query($sql);

    if ($result) {
        // Redirect to user_management.php after successful update
        header("Location: data_entry_management.php");
        exit;
    } else {
        die("Invalid Query: " . $conn->errorInfo()[2]);
    }
}
?>
<div class='col-4'>
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
                    <input type="hidden" name="job_type_id" value="<?php echo $job_type_id; ?>">
                        <div class="row">
                            <div class="col-8">

                                <label for="jobName">Job Name</label>
                                <input class="form-input" type="text" id="job_type_name" name="job_type_name" placeholder="..." maxlength="256" required value="<?php echo $job_type_name; ?>">


                            </div>
                        </div>

                        <input class="btn" type="submit" name="submit" value="Update Job ">
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