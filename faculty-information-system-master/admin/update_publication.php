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

$publication_id = "";
$faculty_id = "";
$title = "";
$author = "";
$publication_type_id = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['publication_id'])) {
        header("Location: data_entry_management.php");
        exit;
    }
    $publication_id = $_GET["publication_id"];
    $sql = "SELECT * FROM publications WHERE publication_id = $publication_id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        header("Location: data_entry_management.php");
        exit;
    }
    $faculty_id = $row["faculty_id"];
    $title = $row["title"];
    $author = $row["author"];
    $publication_type_id = $row["publication_type_id"];


    $successMessage = "User Added Successfully";

    // Clear user input

} else {

    $publication_id = $_POST["publication_id"];
    $faculty_id = $_POST["faculty_id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publication_type_id = $_POST["publication_type_id"];



    $sql = "UPDATE publications " .
        "SET publication_id = '$publication_id', faculty_id = '$faculty_id', title = '$title',author = '$author', publication_type_id = '$publication_type_id'" .
        "WHERE publication_id = $publication_id";

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
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Add publication section</h3>
                <a href="data_entry_management.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>


                <form method="post">
                    <div class="row">
                        <div class="col-8">
                            <input type="hidden" name="publication_id" value="<?php echo $publication_id; ?>">
                            <label for="faculty_id">faculty</label>
                            <select class="form-input" id="faculty_id" name="faculty_id" required>
                                <?php
                                $sql = " SELECT faculty_id,last_name,first_name FROM faculty";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $faculty_id = $row['faculty_id'];
                                        $fname = $row['first_name'];
                                        $lname = $row['last_name'];
                                        $selected = ($faculty_id == $faculty_id) ? 'selected' : '';
                                        echo "<option value=\"$faculty_id\" $selected>$lname,  $fname  </option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="title">title</label>
                            <input class="form-input" type="text" id="title" name="title" placeholder="..." maxlength="256" required value="<?php echo $title; ?>">

                            <label for="author">author</label>
                            <input class="form-input" type="text" id="author" name="author" placeholder="..." maxlength="256" required value="<?php echo $author; ?>">

                            <label for="publication_type_id">publication Type</label>
                            <select class="form-input" id="publication_type_id" name="publication_type_id" required>
                                <?php
                                $sql = "SELECT publication_type_id,publication_type_name FROM publication_types";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $publication_type_id = $row['publication_type_id'];
                                        $publication_type_name = $row['publication_type_name'];

                                        $selected = ($publication_type_id == $publication_type_id) ? 'selected' : '';
                                        echo "<option value=\"$publication_type_id\" $selected>  $publication_type_name  </option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Add Publication  ">
                    <a href="data_entry_management.php">CANCEL</a>
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