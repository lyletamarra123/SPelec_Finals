<?php

class GrantsAwards
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getGrantsAwards($limit = 4)
    {
        $sql = "SELECT * FROM grantsAwards ORDER BY RAND() LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['FacultyName'] . "</td>";
                echo "<td>" . $row['GrantsAwards'] . "</td>";
                echo "<td>" . $row['DateAttained'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<p>No faculty member found.</p>";
        }
    }

    public function searchGrantsAwards($q, $limit = 4)
    {
        $sql = "SELECT * FROM grantsAwards WHERE FacultyName LIKE :q LIMIT :limit";
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
                echo "<td>" . $row['GrantsAwards'] . "</td>";
                echo "<td>" . $row['DateAttained'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No faculty member found.</td></tr>";
        }
    }
}
