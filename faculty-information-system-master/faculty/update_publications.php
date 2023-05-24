<?php

require('.././header.php');
require('sidebar.php');
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit;
}

// require_once("class/Profile.php");
require_once("class/Publications.php");
require_once('../includes/info_db_connect.php');
$db = new DBConnectInfo();
$conn = $db->getConnection();
$id = $_GET['id'] ?? null;


$publications = Publications::fetchPublicationFromDatabase($id, $conn);

foreach ($publications as $pub) {

    $title = $pub['title'];
    $publication_type = $pub['publication_type'];
    $publication_date = $pub['publication_date'];
}


$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $title = $_POST['title'];
    $publication_type = $_POST['publication_type'];
    $publication_date = $_POST['publication_date'];

    $publication = new Publications("", "", "", "");

    $publications->setTitle($title);
    $publications->setPublicationType($publication_type);
    $publications->setPublicationDate($publication_date);




    // Update the profile


    // Redirect back to the profile page after updating
    header('Location: publications.php');
    exit();
}

?>

<div>
    <div class="row">
        <div class="col-3">
            <h1>Publications</h1>
            <form method="post" action="update_publications.php">
                <input type="hidden" name="publication_id" value="<?php echo $id; ?>">
                <label for="title">Publication Title</label>
                <input class="form-input" type="text" id="title" name="title" placeholder="..." maxlength="256" required value="<?php echo $title; ?>">

                <label for="publication_type">Publication Type</label>
                <input class="form-input" type="text" id="publication_type" name="publication_type" placeholder="..." maxlength="256" value="<?php echo $publication_type; ?>">

                <label for="publication_date">Publication Type</label>
                <input class="form-input" type="text" id="publication_date" name="publication_date" placeholder="YY-MM-DD" maxlength="256" value="<?php echo $publication_date; ?>">
                <input class="btn" type="submit" name="submit" value="Update Faculty">

        </div>
    </div>
</div>

<?php require('.././footer.php'); ?>