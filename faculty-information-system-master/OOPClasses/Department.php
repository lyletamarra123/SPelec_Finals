<?php

class DepartmentSearch
{
    private $conn;
    private $DepartmentCode;
    private $DepartmentName;
    private $Email;
    private $Phone;
    private $Location;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getDepartments($limit = 4)
    {
        $sql = "SELECT * FROM department ORDER BY RAND() LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['DepartmentCode'] . "</td>";
                echo "<td>" . $row['DepartmentName'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['Phone'] . "</td>";
                echo "<td>" . $row['Location'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No Department found.</td></tr>";
        }
    }

    public function searchDepartments($q, $limit = 4)
    {
        $sql = "SELECT * FROM department WHERE DepartmentCode LIKE :q OR DepartmentName LIKE :q OR Location LIKE :q LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':q', '%' . $q . '%');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['DepartmentCode'] . "</td>";
                echo "<td>" . $row['DepartmentName'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['Phone'] . "</td>";
                echo "<td>" . $row['Location'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No title or author found.</td></tr>";
        }
    }

    public function displayDepartments() {
        $sql = "SELECT * FROM department";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Invalid Query: " . $this->conn->errorInfo()[2]);
        }

        echo "<table>
            <tr>
                <th>Department Code</th>
                <th>Department Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Action</th>
            </tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                <td>{$row['DepartmentCode']}</td>
                <td>{$row['DepartmentName']}</td>
                <td>{$row['Email']}</td>
                <td>{$row['Phone']}</td>
                <td>{$row['Location']}</td>
                <td>
                    <a href=\"update_department.php?DepartmentCode={$row['DepartmentCode']}\"><i class='fa fa-edit'></i></a>
                    <a href=\"delete_department.php?DepartmentCode={$row['DepartmentCode']}\"><i class='fa fa-trash'></i></a>
                </td>
            </tr>";
        }

        echo "</table>";
    }

    public function insertDepartment($DepartmentCode, $DepartmentName, $Email, $Phone, $Location) {
        $sql = "INSERT INTO department(DepartmentCode, DepartmentName, Email, Phone, Location) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$DepartmentCode, $DepartmentName, $Email, $Phone, $Location]);
    }

    public function loadDepartment($DepartmentCode) {
        $sql = "SELECT * FROM department WHERE DepartmentCode = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$DepartmentCode]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            header("Location: data_entry_management.php");
            exit;
        }
    
        $this->DepartmentCode = $row["DepartmentCode"];
        $this->DepartmentName = $row["DepartmentName"];
        $this->Email = $row["Email"];
        $this->Phone = $row["Phone"];
        $this->Location = $row["Location"];
    }

    public function updateDepartment($DepartmentCode, $DepartmentName, $Email, $Phone, $Location) {
        $sql = "UPDATE department " . "SET DepartmentCode = ?, DepartmentName = ?, Email = ?, Phone = ?, Location = ? " . "WHERE DepartmentCode = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$DepartmentCode, $DepartmentName, $Email, $Phone, $Location, $DepartmentCode]);

        header("Location: data_entry_management.php");
        exit;
    }

    public function deleteDepartment($DepartmentCode) {
        $sql = "DELETE FROM department WHERE DepartmentCode = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$DepartmentCode]);
    }

    public function getDepartmentCode() {
        return $this->DepartmentCode;
    }

    public function getDepartmentName() {
        return $this->DepartmentName;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getPhone() {
        return $this->Phone;
    }

    public function getLocation() {
        return $this->Location;
    }
}
