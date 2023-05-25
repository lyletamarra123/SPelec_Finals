<?php
    session_start();
    include_once('../includes/db_connect.php');
    require_once('../OOPClasses/Work.php');

    $db = new DBConnect();
    $conn = $db->getConnection();

    $workHistory = new WorkHistory($conn);
    $q = $_GET['q'];
    $workList = $workHistory->searchFaculty($q);
?>

<div class="card-container">
    <?php
    if (!empty($workList)) {
        foreach ($workList as $work) {
            echo '<div class="card">';
            echo '<h3>' . $work['FacultyName'] . '</h3>';
            echo '<p><strong>Company Name:</strong> ' . $work['CompanyName'] . '</p>';
            echo '<p><strong>Job Title:</strong> ' . $work['JobTitle'] . '</p>';
            echo '<p><strong>Start Date:</strong> ' . $work['StartDate'] . '</p>';
            echo '<p><strong>End Date:</strong> ' . $work['EndDate'] . '</p>';
            echo '<p><strong>Description:</strong> ' . $work['Description'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No work history found.</p>';
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