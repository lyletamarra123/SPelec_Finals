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

$faculty_id = "";
$first_name = "";
$last_name = "";
$contact_info = "";
$work_history = "";
$degrees = "";
$grants_awards = "";
$office_id = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['faculty_id'])) {
        header("Location: faculty_management.php");
        exit;
    }
    $faculty_id = $_GET["faculty_id"];
    $sql = "SELECT * FROM faculty WHERE faculty_id = $faculty_id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: faculty_management.php");
        exit;
    }
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $contact_info = $row["contact_info"];
    $work_history = $row["work_history"];
    $degrees = $row["degrees"];
    $grants_awards = $row["grants_awards"];
    $office_id = $row["office_id"];



    $successMessage = "User Added Successfully";

    // Clear user input

} else {

    $faculty_id = $_POST["faculty_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $contact_info = $_POST["contact_info"];
    $work_history = $_POST["work_history"];
    $degrees = $_POST["degrees"];
    $grants_awards = $_POST["grants_awards"];
    $office_id = $_POST["office_id"];


    $sql = "UPDATE faculty " .
        "SET faculty_id = '$faculty_id', first_name = '$first_name', last_name = '$last_name', contact_info = '$contact_info', work_history = '$work_history', degrees = '$degrees',  grants_awards = '$grants_awards',office_id = '$office_id' " .
        "WHERE faculty_id = $faculty_id";

    $result = $conn->query($sql);

    if ($result) {
        // Redirect to user_management.php after successful update
        header("Location: faculty_management.php");
        exit;
    } else {
        die("Invalid Query: " . $conn->errorInfo()[2]);
    }
}
?>

<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Add user section</h3>
                <a href="faculty_management.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>
                <?php if (!empty($successMessage)) : ?>
                    <div class="success-message"><?php echo $successMessage; ?></div>
                    <script>
                        setTimeout(function() {
                            var successMessage = document.querySelector('.success-message');
                            successMessage.style.display = 'none';
                        }, 2000);
                    </script>
                <?php endif; ?>
                <form method="post">
                    <input type="hidden" name="faculty_id" value="<?php echo $faculty_id; ?>">  
                    <div class="row">
                        <div class="col-8">
                            <label for="first_name">first name</label>
                            <input class="form-input" type="text" id="first_name" name="first_name" placeholder="..." maxlength="256" required value="<?php echo $first_name; ?>">


                            <label for="last_name">last name</label>
                            <input class="form-input" type="text" id="usernlast_nameame" name="last_name" placeholder="..." maxlength="256" required value="<?php echo $last_name; ?>">


                            <label for="contact_info">contact_info</label>
                            <input class="form-input" type="text" id="contact_info" name="contact_info" placeholder="..." maxlength="256" required value="<?php echo $contact_info; ?>">

                            <label for="work_history">work_history</label>
                            <input class="form-input" type="text" id="work_history" name="work_history" placeholder="..." maxlength="256" required value="<?php echo $work_history; ?>">


                            <label for="degrees">degrees</label>
                            <input class="form-input" type="text" id="degrees" name="degrees" placeholder="..." maxlength="256" required value="<?php echo $degrees; ?>">


                            <label for="grants_awards">grants awards</label>
                            <input class="form-input" type="text" id="grants_awards" name="grants_awards" placeholder="..." maxlength="256" required value="<?php echo $grants_awards; ?>">


                            <label for="role">Offices</label>
                            <select class="form-input" id="role" name="office_id" required>
                                <?php
                                $sql = "SELECT office_id, office_address FROM offices";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $officeId = $row['office_id'];
                                        $label = $row['office_address'];
                                        $selected = ($officeId == $office_id) ? 'selected' : '';
                                        echo "<option value=\"$officeId\" $selected>$label</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update Faculty ">
                    <a href="faculty_management.php">CANCEL</a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Rest of your CSS code */

    .success-message {
        color: green;
        font-weight: bold;
        margin-bottom: 10px;
    }
</style>