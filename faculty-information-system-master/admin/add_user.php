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

$fullname = "";
$username = "";
$address = "";
$email = "";
$role = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $role = $_POST["role"];

    // Generate a unique user ID
    $userid = rand();

    $sql = "INSERT INTO User (userid, fullname, username, email, address, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userid, $fullname, $username, $email, $address, $role]);

    $successMessage = "User Added Successfully";
    // Clear user input
    $fullname = "";
    $username = "";
    $email = "";
    $address = "";
    $role = "";
}
?>
<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h3 class="user-list-header">Add user section</h3>
                <a href="user_management.php">
                    <li><i class="fa fa-arrow-right">Back</i></li>
                </a>
                <hr>
                <?php if (!empty($successMessage)): ?>
                    <div class="success-message"><?php echo $successMessage; ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="row">
                        <div class="col-8">
                            <label for="fullname">Full Name</label>
                            <input class="form-input" type="text" id="fullname" name="fullname" placeholder="..." maxlength="256" required value="<?php echo $fullname; ?>">

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
                    <input class="btn" type="submit" name="submit" value="Add User">
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
