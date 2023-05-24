<?php

require('.././header.php');
require('sidebar.php');

require_once("class/Profile.php");

require_once('../includes/info_db_connect.php');
$db = new DBConnectInfo();
$conn = $db->getConnection();


$facultyId = $_SESSION['username']; 
$profile = Profile::fetchProfileFromDatabase($facultyId, $conn);

if ($profile) {
    $facultyId = $profile->getFacultyId();
} else {

    echo "Profile not found.";
}
$publications = Profile::fetchPublicationFromDatabase($facultyId, $conn);


?>

<div>
    <div class="row">
        <div class="col-6">
            <h1>Publications</h1>
            <a href="add_publications.php" > Add</a>
            <div class="row">
                <?php foreach ($publications as $publication) : ?>
                    <h2>Title: <?php echo $publication['title']; ?>   </h2>
                    <p>Publication ID: <?php echo $publication['publication_id']; ?>     
                       <a href="update_publications.php" > Edit</a></p>
               
                    <p>Type: <?php echo $publication['publication_type']; ?></p>
                    <p>Date: <?php echo $publication['publication_date']; ?></p>
                    <?php
                    ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<?php require('.././footer.php'); ?>