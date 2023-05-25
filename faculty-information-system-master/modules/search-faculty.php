<?php
    session_start();
    include_once('../includes/db_connect.php');
    require_once('../OOPClasses/Faculty.php');

    $db = new DBConnect();
    $conn = $db->getConnection();

    $faculty = new Faculty($conn);
    $q = $_GET['q'];
    $facultyList = $faculty->searchFaculty($q);
?>

<div class="card-container">
    <?php
    if (!empty($facultyList)) {
        foreach ($facultyList as $faculty) {
            echo '<div class="card">';
            echo '<h3>' . $faculty['FacultyName'] . '</h3>';
            echo '<p><strong>Faculty ID:</strong> ' . $faculty['FacultyID'] . '</p>';
            echo '<p><strong>Position:</strong> ' . $faculty['Position'] . '</p>';
            echo '<p><strong>Department:</strong> ' . $faculty['Department'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $faculty['Email'] . '</p>';
            echo '<p><strong>Phone Number:</strong> ' . $faculty['PhoneNumber'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No faculty members found.</p>';
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