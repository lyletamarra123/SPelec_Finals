<?php
    session_start();
    include_once('../includes/db_connect.php');
    require_once('../OOPClasses/Course.php');

    $db = new DBConnect();
    $conn = $db->getConnection();

    $courses = new CourseSearch($conn);
    $q = $_GET['q'];
    $courseList = $courses->searchCourses($q);
?>

<div class="card-container">
    <?php
    if (!empty($courseList)) {
        foreach ($courseList as $course) {
            echo '<div class="card">';
            echo '<h3>' . $course['CourseCode'] . '</h3>';
            echo '<p><strong>Course Name:</strong> ' . $course['CourseName'] . '</p>';
            echo '<p><strong>Taught By:</strong> ' . $course['FacultyName'] . '</p>';
            echo '<p><strong>Department:</strong> ' . $course['Department'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No course or faculty member found.</p>';
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