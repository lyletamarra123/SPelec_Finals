<?php
    session_start();
    include_once('../includes/db_connect.php');
    require_once('../OOPClasses/Awards.php');

    $db = new DBConnect();
    $conn = $db->getConnection();

    $awardSearch = new GrantsAwards($conn);
    $q = $_GET['q'];
    $awardList = $awardSearch->searchGrantsAwards($q);
?>

<div class="card-container">
    <?php
    if (!empty($awardList)) {
        foreach ($awardList as $award) {
            echo '<div class="card">';
            echo '<h3>' . $award['FacultyName'] . '</h3>';
            echo '<p><strong>Grants/Awards:</strong> ' . $award['GrantsAwards'] . '</p>';
            echo '<p><strong>Date Attained:</strong> ' . $award['DateAttained'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No faculty member found.</p>';
    }
    ?>
</div>
<style>
    .card-container {
    display: flex;
    flex-wrap: wrap;
}

.card {
    width: 300px;
    padding: 20px;
    margin: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.card h3 {
    margin-top: 0;
}

.card p {
    margin: 0;
    line-height: 1.5;
}
</style>