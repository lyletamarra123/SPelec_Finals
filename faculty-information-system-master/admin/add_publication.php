<?php
require('header.php');
require_once('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['stno'])) {
    header("Location: login.php");
    exit;
}

include('sidebar.php');
ob_start();

$Title ="";
$PublicationType = "";
$PublicationDate = "";
$Author = "";
$AuthorType = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Title = $_POST["Title"] ?? "";
    $PublicationType = $_POST["PublicationType"] ?? "";
    $PublicationDate = $_POST["PublicationDate"] ?? "";
    $Author = $_POST["Author"] ?? "";
    $AuthorType = $_POST["AuthorType"] ?? "";


    $sql = "INSERT INTO publications(Title, PublicationType, PublicationDate, Author, AuthorType) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$Title, $PublicationType, $PublicationDate, $Author, $AuthorType]);

    $successMessage = "Publication  Added Successfully";

    $Title ="";
    $PublicationType = "";
    $PublicationDate = "";
    $Author = "";
    $AuthorType = "";
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
                    <div class="row">
                        <div class="col-8">                    
                            <label for="Title">Title</label>
                            <input class="form-input" type="text" id="Title" name="Title" placeholder="..." maxlength="256" required value="<?php echo $Title; ?>">

                            <label for="PublicationType">Publication Type</label>
                            <input class="form-input" type="text" id="PublicationType" name="PublicationType" placeholder="..." maxlength="256" required value="<?php echo $PublicationType; ?>">

                            <label for="PublicationDate">Publication Date</label>
                            <input class="form-input" type="text" id="PublicationDate" name="PublicationDate" placeholder="..." maxlength="256" required value="<?php echo $PublicationDate; ?>">

                            <label for="Author">Author</label>
                            <select class="form-input" id="Author" name="Author" required>
                                <?php
                                $sql = "SELECT `FacultyID`, `FacultyName` FROM `faculty` ORDER BY `FacultyName` ASC";
                                $result = $conn->query($sql);
                                if ($result) {
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        $factID = $row['FacultyID'];
                                        $label = $row['FacultyName'];
                                        $selected = ($factID == $factID) ? 'selected' : '';
                                        echo "<option value=\"$label\" $selected>$label</option>";
                                    }
                                }
                                ?>
                            </select>

                            <label for="AuthorType">Author Type</label>
                            <input class="form-input" type="text" id="AuthorType" name="AuthorType" placeholder="..." maxlength="256" required value="<?php echo $AuthorType; ?>">
                        </div>
                    </div>
                    <input class="btn" type="submit" name="submit" value="Add Publication  ">
                    <!-- <a href="data_entry_management.php">CANCEL</a> -->
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

<?php require('../footer.php') ?>