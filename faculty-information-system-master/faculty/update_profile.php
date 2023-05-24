<?php
require('.././header.php');
require('sidebar.php');
ob_start();
require_once("class/Profile.php");

require_once('../includes/info_db_connect.php');
$db = new DBConnectInfo();
$conn = $db->getConnection();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit;
}

// Fetch the profile from the database
$facultyId = $_SESSION['username'];
$profile = Profile::fetchProfileFromDatabase($facultyId, $conn);

// Check if the profile exists
if (!$profile) {
    // Handle the case when profile is not found
    echo "Profile not found.";
    exit;
}

$facultyName = $profile->getFacultyName();
$position = $profile->getPosition();
$department = $profile->getDepartment();
$email = $profile->getEmail();
$phoneNumber = $profile->getPhoneNumber();

$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facultyName = $_POST['FacultyName'];
    $position = $_POST['Position'];
    $department = $_POST['Department'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];

    // Update the profile
    $profile->setFacultyName($facultyName);
    $profile->setPosition($position);
    $profile->setDepartment($department);
    $profile->setEmail($email);
    $profile->setPhoneNumber($phoneNumber);
    $profile->updateProfile($conn);

    // Redirect back to the profile page after updating
    header('Location: profile.php');
    exit();
}
?>

<div class='col-4'>
    <div class="box">
        <div class="col-8">
            <div class="user-list">
                <h1 class="user-list-header">Profile</h1>
                <a href="profile.php">
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
                <form method="post" action="update_profile.php">
                    <input type="hidden" name="FacultyId" value="<?php echo $profile->getFacultyId(); ?>">
                    <div class="row">
                        <div class="col-8">
                            <label for="FacultyName">Faculty Name</label>
                            <input class="form-input" type="text" id="FacultyName" name="FacultyName" placeholder="..." maxlength="256" required value="<?php echo $facultyName; ?>">

                            <label for="Position">Position</label>
                            <input class="form-input" type="text" id="Position" name="Position" placeholder="..." maxlength="256" required value="<?php echo $position; ?>">

                            <label for="Department">Department</label>
                            <input class="form-input" type="text" id="Department" name="Department" placeholder="..." maxlength="256" required value="<?php echo $department; ?>">

                            <label for="Email">Email</label>
                            <input class="form-input" type="text" id="Email" name="Email" placeholder="..." maxlength="256" required value="<?php echo $email; ?>">

                            <label for="PhoneNumber">Phone Number</label>
                            <input class="form-input" type="text" id="PhoneNumber" name="PhoneNumber" placeholder="..." maxlength="256" required value="<?php echo $phoneNumber; ?>">
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Update Faculty">
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS styles */

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

<?php require('.././footer.php'); ?>