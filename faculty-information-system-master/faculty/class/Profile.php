<?php

class Profile
{
    private $facultyId;
    private $facultyName;
    private $position;
    private $department;
    private $email;
    private $phoneNumber;

    public function __construct($facultyId, $facultyName, $position, $department, $email, $phoneNumber)
    {
        $this->facultyId = $facultyId;
        $this->facultyName = $facultyName;
        $this->position = $position;
        $this->department = $department;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    // Getter methods
    public function getFacultyId()
    {
        return $this->facultyId;
    }
    public function getFacultyName()
    {
        return $this->facultyName;
    }
    public function getPosition()
    {
        return $this->position;
    }
    public function getDepartment()
    {
        return $this->department;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    // Setter methods
    public function setFacultyId($facultyId)
    {
        $this->facultyId = $facultyId;
    }
    public function setFacultyName($facultyName)
    {
        $this->facultyName = $facultyName;
    }
    public function setPosition($position)
    {
        $this->position = $position;
    }
    public function setDepartment($department)
    {
        $this->department = $department;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    public static function fetchProfileFromDatabase($username, $conn)
    {
        $sql = "SELECT f.faculty_id, f.faculty_name, f.position, f.department, f.email, f.phone_number
        FROM faculty AS f
        JOIN users AS u ON u.user_id = f.user_id
        WHERE u.username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $profile = new Profile(
                $row['faculty_id'],
                $row['faculty_name'],
                $row['position'],
                $row['department'],
                $row['email'],
                $row['phone_number']
            );

            return $profile;
        } else {
            return null;
        }
    }
    public function updateProfile($conn)
    {
        $sql = "UPDATE faculty SET faculty_name = ?, position = ?, department = ?, email = ?, phone_number = ? WHERE faculty_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->facultyName, $this->position, $this->department, $this->email, $this->phoneNumber, $this->facultyId]);
    }


    public static function fetchWorkHistoryFromDatabase($facultyId, $conn)
    {
        $sql = "SELECT * FROM work_history WHERE faculty_id = :facultyId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':facultyId', $facultyId);
        $stmt->execute();

        $workHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $workHistory;
    }

    public static function fetchPublicationFromDatabase($facultyId, $conn)
    {
        $sql = "SELECT * FROM publications WHERE faculty_id = :facultyId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':facultyId', $facultyId);
        $stmt->execute();

        $publications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $publications;
    }
    public static function fetchDegreeFromDatabase($facultyId, $conn)
    {
        $sql = "SELECT * FROM degrees WHERE faculty_id = :facultyId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':facultyId', $facultyId);
        $stmt->execute();

        $degrees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $degrees;
    }
    public static function fetchAwardsFromDatabase($facultyId, $conn)
    {
        $sql = "SELECT * FROM grants_awards WHERE faculty_id = :facultyId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':facultyId', $facultyId);
        $stmt->execute();

        $awards = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $awards;
    }

    public function addWorkHistory($work_history_id, $facultyId, $company_name, $job_title, $start_date, $end_date, $description, $conn)
    {
        // Prepare the SQL statement
        $sql = "INSERT INTO work_history (work_history_id, faculty_id, company_name, job_title, start_date, end_date, description)
                  VALUES (:work_history_id, :faculty_id, :company_name, :job_title, :start_date, :end_date, :description)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':work_history_id', $work_history_id);
        $stmt->bindParam(':faculty_id', $facultyId);
        $stmt->bindParam(':company_name', $company_name);
        $stmt->bindParam(':job_title', $job_title);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':description', $description);

        // Execute the statement
        if ($stmt->execute()) {
            // Work history record added successfully
            // You can perform any additional actions here
        } else {
            // Failed to add the work history record
            // You can handle the error accordingly
        }
    }
    public function addPublication($publication_id, $title, $publication_type, $publication_date, $facultyId, $conn)
{
    // Prepare the SQL statement
    $sql = "INSERT INTO publications (publication_id, title, publication_type, publication_date, faculty_id)
              VALUES (:publication_id, :title, :publication_type, :publication_date, :faculty_id)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':publication_id', $publication_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':publication_type', $publication_type);
    $stmt->bindParam(':publication_date', $publication_date);
    $stmt->bindParam(':faculty_id', $facultyId);

    // Execute the statement
    if ($stmt->execute()) {
        // Publication record added successfully
        // You can perform any additional actions here
    } else {
        // Failed to add the publication record
        // You can handle the error accordingly
    }
}

}
