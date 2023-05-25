<?php

class CourseSearch
{
    private $conn;
    private $CourseCode;
    private $CourseName;
    private $FacultyName;
    private $Department;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getCourses($limit = 4)
    {
        $sql = "SELECT * FROM courses ORDER BY RAND() LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['CourseCode'] . "</td>";
                echo "<td>" . $row['CourseName'] . "</td>";
                echo "<td>" . $row['FacultyName'] . "</td>";
                echo "<td>" . $row['Department'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No Course or faculty member found.</td></tr>";
        }
    }

    public function searchCourses($q, $limit = 4) {
        $sql = "SELECT * FROM courses WHERE FacultyName LIKE :q OR CourseCode LIKE :q OR CourseName LIKE :q LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':q', '%' . $q . '%');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = $stmt->rowCount();

        return $result;
    }


    public function displayCourses() {
        $sql = "SELECT * FROM courses";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Invalid Query: " . $this->conn->errorInfo()[2]);
        }

        echo "<table>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Faculty Name</th>
                <th>Department</th>
                <th>Action</th>
            </tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                <td>{$row['CourseCode']}</td>
                <td>{$row['CourseName']}</td>
                <td>{$row['FacultyName']}</td>
                <td>{$row['Department']}</td>
                <td>
                    <a href=\"update_course.php?CourseCode={$row['CourseCode']}\"><i class='fa fa-edit'></i></a>
                    <a href=\"delete_course.php?CourseCode={$row['CourseCode']}\"><i class='fa fa-trash'></i></a>
                </td>
            </tr>";
        }
        echo "</table>";
    }

    public function insertCourse($CourseCode, $CourseName, $FacultyName, $Department) {
        $sql = "INSERT INTO courses (CourseCode, CourseName, FacultyName, Department) VALUES (?,?,?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$CourseCode, $CourseName, $FacultyName, $Department]);
    }

    public function loadCourse($CourseCode)
    {
        $sql = "SELECT * FROM courses WHERE CourseCode = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$CourseCode]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$row) {
            header("Location: data_entry_management.php");
            exit;
        }
    
        $this->CourseCode = $row["CourseCode"];
        $this->CourseName = $row["CourseName"];
        $this->FacultyName = $row["FacultyName"];
        $this->Department = $row["Department"];
    }

    public function getFacultyOptions($selectedFacultyID = '') {
        $sql = "SELECT `FacultyID`, `FacultyName` FROM `faculty` ORDER BY `FacultyName` ASC";
        $result = $this->conn->query($sql);

        $options = '';
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $facultyID = $row['FacultyID'];
                $label = $row['FacultyName'];
                $selected = ($facultyID == $selectedFacultyID) ? 'selected' : '';
                $options .= "<option value=\"$label\" $selected>$label</option>";
            }
        }

        return $options;
    }

    public function getDepartmentOptions($selectedDepartmentCode = '') {
        $sql = "SELECT `DepartmentCode`, `DepartmentName` FROM `department`";
        $result = $this->conn->query($sql);

        $options = '';
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $departmentCode = $row['DepartmentCode'];
                $label = $row['DepartmentName'];
                $selected = ($departmentCode == $selectedDepartmentCode) ? 'selected' : '';
                $options .= "<option value=\"$departmentCode\" $selected>$label</option>";
            }
        }

        return $options;
    }

    public function updateCourse($CourseCode, $CourseName, $FacultyName, $Department) {
        $sql = "UPDATE courses SET CourseCode = ?, CourseName = ?, FacultyName = ?, Department = ? WHERE CourseCode = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$CourseCode, $CourseName, $FacultyName, $Department, $CourseCode]);
    
        header("Location: data_entry_management.php");
        exit;
    }
    
    public function deleteCourse($CourseCode) {
        $sql = "DELETE FROM courses WHERE CourseCode = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$CourseCode]);
    }

    public function getCourseCode() {
        return $this->CourseCode;
    }

    public function getCourseName() {
        return $this->CourseName;
    }

    public function getFacultyName() {
        return $this->FacultyName;
    }

    public function getDepartment() {
        return $this->Department;
    }
}
