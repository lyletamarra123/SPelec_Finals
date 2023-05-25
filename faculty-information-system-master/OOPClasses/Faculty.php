<?php
class Faculty {
    private $conn;
    private $facultyID;
    private $facultyName;
    private $position;
    private $department;
    private $email;
    private $phoneNumber;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getFacultyMembers() {
        $sql = "SELECT * FROM faculty ORDER BY RAND() LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['FacultyID'] . "</td>";
                echo "<td>" . $row['FacultyName'] . "</td>";
                echo "<td>" . $row['Position'] . "</td>";
                echo "<td>" . $row['Department'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['PhoneNumber'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No faculty members found.</td></tr>";
        }
    }
    
    public function searchFaculty($q) {
        $sql = "SELECT * FROM faculty WHERE FacultyName LIKE :q LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':q' => '%' . $q . '%']);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = $stmt->rowCount();

        return $result;
    }


    public function getFacultyList() {
        $sql = "SELECT * FROM faculty";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Invalid Query: " . $this->conn->errorInfo()[2]);
            }
            echo "<table>
                <tr>
                    <th>Faculty ID</th>
                    <th>Faculty Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>                      
                </tr>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo 
                    "<tr>
                        <td>{$row['FacultyID']}</td>
                        <td>{$row['FacultyName']}</td>
                        <td>{$row['Position']}</td>
                        <td>{$row['Department']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['PhoneNumber']}</td>               
                        <td>
                            <a href=\"update_faculty.php?FacultyID={$row['FacultyID']}\"><i class='fa fa-edit'></i></a>
                            <a href=\"delete_faculty.php?FacultyID={$row['FacultyID']}\"><i class='fa fa-trash'></i></a>
                        </td>
                    </tr>";
                }
            echo "</table>";
    }

    public function evaluateFaculty() {
        $sql = "SELECT * FROM faculty";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Invalid Query: " . $this->conn->errorInfo()[2]);
            }
            echo "<table>
                <tr>
                    <th>Faculty ID</th>
                    <th>Faculty Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Action</th>                      
                </tr>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo 
                    "<tr>
                        <td>{$row['FacultyID']}</td>
                        <td>{$row['FacultyName']}</td>
                        <td>{$row['Position']}</td>
                        <td>{$row['Department']}</td>             
                        <td>
                            <button>START</button>
                        </td>
                    </tr>";
                }
            echo "</table>";
    }

    public function addFaculty($facultyID, $facultyName, $position, $department, $email, $phoneNumber) {
        $sql = "INSERT INTO faculty(FacultyID, FacultyName, Position, Department, Email, PhoneNumber) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$facultyID, $facultyName, $position, $department, $email, $phoneNumber]);
    }

    public function loadFaculty($facultyID) {
        $sql = "SELECT * FROM faculty WHERE FacultyID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$facultyID]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            header("Location: faculty_management.php");
            exit;
        }

        $this->facultyID = $row["FacultyID"];
        $this->facultyName = $row["FacultyName"];
        $this->position = $row["Position"];
        $this->department = $row["Department"];
        $this->email = $row["Email"];
        $this->phoneNumber = $row["PhoneNumber"];
    }

    public function updateFaculty($facultyID, $facultyName, $position, $department, $email, $phoneNumber) {
        $sql = "UPDATE faculty SET FacultyName = ?, Position = ?, Department = ?, Email = ?, PhoneNumber = ? WHERE FacultyID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$facultyName, $position, $department, $email, $phoneNumber, $facultyID]);
        
        header("Location: faculty_management.php");
        exit;
    }

    public function deleteFaculty($facultyID) {
        $sql = "DELETE FROM faculty WHERE FacultyID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$facultyID]);
    }
    
    public function getFacultyID() {
        return $this->facultyID;
    }

    public function getFacultyName() {
        return $this->facultyName;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getDepartment() {
        return $this->department;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
}
?>
