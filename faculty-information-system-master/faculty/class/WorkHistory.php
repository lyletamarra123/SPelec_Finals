<?php

class WorkHistory
{
    private $workHistoryId;
    private $facultyId;
    private $companyName;
    private $jobTitle;
    private $startDate;
    private $endDate;
    private $description;

    public function __construct($workHistoryId, $facultyId, $companyName, $jobTitle, $startDate, $endDate, $description)
    {
        $this->workHistoryId = $workHistoryId;
        $this->facultyId = $facultyId;
        $this->companyName = $companyName;
        $this->jobTitle = $jobTitle;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->description = $description;
    }
    // Getters
    public function getWorkHistoryId()
    {
        return $this->workHistoryId;
    }
    public function getFacultyId()
    {
        return $this->facultyId;
    }
    public function getCompanyName()
    {
        return $this->companyName;
    }
    public function getJobTitle()
    {
        return $this->jobTitle;
    }
    public function getStartDate()
    {
        return $this->startDate;
    }
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getDescription()
    {
        return $this->description;
    } // Setters
    public function setWorkHistoryId($workHistoryId)
    {
        $this->workHistoryId = $workHistoryId;
    }
    public function setFacultyId($facultyId)
    {
        $this->facultyId = $facultyId;
    }
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function updateWorkHistory($conn)
    {
        $sql = "UPDATE work_history SET company_name = ?, job_title = ?, start_date = ?, end_date = ?, description = ? WHERE work_history_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$this->companyName, $this->jobTitle, $this->startDate, $this->endDate, $this->description, $this->workHistoryId]);
    }
    public static function fetchWorkHistoryFromDatabase($workHistoryId, $conn)
    {
        try {
            $sql = "SELECT * FROM work_history WHERE work_history_id = :workHistoryId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':workHistoryId', $workHistoryId);
            $stmt->execute();

            $workHistoryData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($workHistoryData) {
                $workHistory = new WorkHistory(
                    $workHistoryData['work_history_id'],
                    $workHistoryData['faculty_id'],
                    $workHistoryData['company_name'],
                    $workHistoryData['job_title'],
                    $workHistoryData['start_date'],
                    $workHistoryData['end_date'],
                    $workHistoryData['description']
                );

                return $workHistory;
            }

          echo "hello";
        } catch (PDOException $e) {
            // Log the error to a file or display a more detailed error message
            error_log('Error fetching work history: ' . $e->getMessage());
            // You can also echo the error message for debugging purposes
            // echo 'Error fetching work history: ' . $e->getMessage();
            return null;
        }
    }

}
