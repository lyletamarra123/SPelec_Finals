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
