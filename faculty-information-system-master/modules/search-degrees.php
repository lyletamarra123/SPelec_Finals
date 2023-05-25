<?php
    require_once('../includes/db_connect.php');
    require_once('../OOPClasses/Degree.php');

    $db = new DBConnect();
    $conn = $db->getConnection();
    $q = $_GET['q'];

    $degreeSearch = new Degree($conn);
    $degreeList = $degreeSearch->searchDegrees($q);
?>

<div class="card-container">
    <?php
    if (!empty($degreeList)) {
        foreach ($degreeList as $degree) {
            echo '<div class="card">';
            echo '<h3>' . $degree['FacultyName'] . '</h3>';
            echo '<p><strong>Degree/s:</strong> ' . $degree['Degree'] . '</p>';
            echo '<p><strong>Date Attained:</strong> ' . $degree['DateAttained'] . '</p>';
            echo '<p><strong>Institution:</strong> ' . $degree['Institution'] . '</p>';
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