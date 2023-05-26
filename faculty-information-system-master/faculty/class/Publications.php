<?php
class Publications
{
    private $title;

    private $publicationType;
    private $publicationDate;
    private $facultyId;

    public function __construct($title, $publicationType, $publicationDate, $facultyId)
    {
        $this->title = $title;
        $this->publicationType = $publicationType;
        $this->publicationDate = $publicationDate;
        $this->facultyId = $facultyId;
    }

    public function updatePublication($conn, $title, $publication_type, $publication_date, $facultyId)
    {

        // Update the publication information
        $publicationSql = "UPDATE publications SET title = ?, publication_type = ?, publication_date = ? WHERE faculty_id = ?";
        $publicationStmt = $conn->prepare($publicationSql);
        $publicationStmt->execute([$title, $publication_type, $publication_date, $facultyId]);
    }

    public static function fetchPublicationFromDatabase($publicationId, $conn)
    {
        $sql = "SELECT *  FROM publications WHERE publication_id = :publicationId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':publicationId', $publicationId);
        $stmt->execute();

        $stmt->execute();

        $stmt->execute();

        $publications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $publications;
    }

    public static function fetchPublicationFromDatabase2($title, $publicationType, $publicationDate, $facultyId)
    {
        $sql = "SELECT *  FROM publications";
        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $stmt->execute();

        $stmt->execute();

        $publications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $publications;
    }

    public function getPublicationsList($conn) {
        $sql = "SELECT * FROM publications ORDER BY RAND() LIMIT 4";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['publication_id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['publication_type'] . "</td>";
                echo "<td>" . $row['publication_date'] . "</td>";
				echo "<td>" . $row['faculty_id'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No title or author found.</td></tr>";
        }
    }

    public function searchPublications($conn, $q, $limit = 4)
    {
        $sql = "SELECT * FROM publications WHERE faculty_id LIKE :q OR title LIKE :q OR publication_type LIKE :q LIMIT :limit";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':q', '%' . $q . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['publication_id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['publication_type'] . "</td>";
                echo "<td>" . $row['publication_date'] . "</td>";
				echo "<td>" . $row['faculty_id'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No title or author found.</td></tr>";
        }
    }

    // Getter and Setter for title
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    // Getter and Setter for publicationType
    public function getPublicationType()
    {
        return $this->publicationType;
    }

    public function setPublicationType($publicationType)
    {
        $this->publicationType = $publicationType;
    }

    // Getter and Setter for publicationDate
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;
    }
}
