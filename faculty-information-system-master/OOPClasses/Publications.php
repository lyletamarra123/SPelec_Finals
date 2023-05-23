<?php
class Publication {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPublicationsList() {
        $sql = "SELECT * FROM publications ORDER BY RAND() LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['Title'] . "</td>";
                echo "<td>" . $row['PublicationType'] . "</td>";
                echo "<td>" . $row['PublicationDate'] . "</td>";
				echo "<td>" . $row['Author'] . "</td>";
				echo "<td>" . $row['AuthorType'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No title or author found.</td></tr>";
        }
    }
    
    public function searchPublications($q, $limit = 4)
    {
        $sql = "SELECT * FROM publications WHERE Author LIKE :q OR Title LIKE :q OR PublicationType LIKE :q LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':q', '%' . $q . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['Title'] . "</td>";
                echo "<td>" . $row['PublicationType'] . "</td>";
                echo "<td>" . $row['PublicationDate'] . "</td>";
                echo "<td>" . $row['Author'] . "</td>";
                echo "<td>" . $row['AuthorType'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No title or author found.</td></tr>";
        }
    }

}
?>
