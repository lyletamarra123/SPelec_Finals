<?php

class WorkHistory
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getWorkHistory($limit = 4)
    {
        $sql = "SELECT * FROM workHistory ORDER BY RAND() LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['FacultyName'] . "</td>";
                echo "<td>" . $row['CompanyName'] . "</td>";
                echo "<td>" . $row['JobTitle'] . "</td>";
                echo "<td>" . $row['StartDate'] . "</td>";
                echo "<td>" . $row['EndDate'] . "</td>";
                echo "<td>" . $row['Description'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No faculty members found.</td></tr>";
        }
    }

    public function searchFaculty($q, $limit = 4)
    {
        $sql = "SELECT * FROM workHistory WHERE FacultyName LIKE :q LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':q', '%' . $q . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['FacultyName'] . "</td>";
                echo "<td>" . $row['CompanyName'] . "</td>";
                echo "<td>" . $row['JobTitle'] . "</td>";
                echo "<td>" . $row['StartDate'] . "</td>";
                echo "<td>" . $row['EndDate'] . "</td>";
                echo "<td>" . $row['Description'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No faculty members found.</td></tr>";
        }
    }
}
