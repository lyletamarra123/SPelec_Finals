<?php
require('header.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

include('sidebar.php');
ob_start();
require_once('../includes/info_db_connect.php');
$userid ="";
$fullname = "";
$username = "";
$address = "";
$email = "";
$role = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["userid"])) {
    //     header("Location: user_management.php");
    //     exit;
    // }
    }

    $userid = $_GET["userid"];

    $sql = "SELECT * FROM user WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        // header("Location: user_management.php");
        // exit;
    }

    $fullname = $row["fullname"];
    $username = $row["username"];
    $address = $row["address"];
    $email = $row["email"];
    $role = $row["role"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST["userid"])) {
        header("Location: user_management.php");
        exit;
    }

    $userid = $_POST["userid"];
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $role = $_POST["role"];

    $sql = "UPDATE user SET fullname = ?, username = ?, email = ?, address = ?, role = ? WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fullname, $username, $email, $address, $role, $userid]);
    $successMessage = "User Updated Successfully";
    header("Location: user_management.php");
    exit;
}
?>
<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Edit User</h3>
                <a href="user_management.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>
                <?php if (!empty($successMessage)) : ?>
                    <div class="success-message"><?php echo $successMessage; ?></div>
                <?php endif; ?>
                <form method="post">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                    <div class="row">
                        <div class="col-8">

                            <label for="fullname">Full Name</label>
                            <input class="form-input" type="text" id="fullname" name="fullname"  maxlength="256" required value="<?php echo $fullname; ?>">

                            <label for="username">Username</label>
                            <input class="form-input" type="text" id="username" name="username" placeholder="..." maxlength="256" required value="<?php echo $username; ?>">

                            <label for="email">Email</label>
                            <input class="form-input" type="text" id="email" name="email" placeholder="..." maxlength="256" required value="<?php echo $email; ?>">

                            <label for="address">Address</label>
                            <input class="form-input" type="text" id="address" name="address" placeholder="..." maxlength="256" required value="<?php echo $address; ?>">

                            <label for="role">Role</label>
                            <select class="form-input" id="role" name="role" required>
                                <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>Admin</option>
                                <option value="faculty" <?php if ($role == 'faculty') echo 'selected'; ?>>Faculty</option>
                                <option value="guest" <?php if ($role == 'guest') echo 'selected'; ?>>Guest</option>
                                <option value="students" <?php if ($role == 'students') echo 'selected'; ?>>Students</option>
                            </select>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update User">
                    <a href="user_management.php">CANCEL</a>
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

<!-- Rest of your HTML code -->
<script src="../js/tab.js"></script>
<?php require('../footer.php') ?>
