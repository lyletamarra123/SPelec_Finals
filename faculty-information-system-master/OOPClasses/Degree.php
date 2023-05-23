<?php

class Degree
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getDegrees($limit = 4)
    {
        $sql = "SELECT * FROM degrees ORDER BY RAND() LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['FacultyName'] . "</td>";
                echo "<td>" . $row['Degree'] . "</td>";
                echo "<td>" . $row['DateAttained'] . "</td>";
                echo "<td>" . $row['Institution'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No faculty member found.</td></tr>";
        }
    }

    public function searchDegrees($q, $limit = 4)
    {
        $sql = "SELECT * FROM degrees WHERE FacultyName LIKE :q LIMIT :limit";
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
                echo "<td>" . $row['Degree'] . "</td>";
                echo "<td>" . $row['DateAttained'] . "</td>";
                echo "<td>" . $row['Institution'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No faculty member found.</td></tr>";
        }
    }
}
