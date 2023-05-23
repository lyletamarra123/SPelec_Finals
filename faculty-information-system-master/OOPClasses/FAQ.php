<?php

class FAQManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getFAQs()
    {
        $sql = "SELECT * FROM faq ORDER BY RAND() LIMIT 5";
        $stmt = $this->conn->query($sql);
        $resulCheck = $stmt->rowCount();

        if ($resulCheck > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<button class='accordion'>" . $row['faqHeading'] . "</button>";
                echo "<div class='panel'>" . $row['faqContent'] . "</div>";
            }
        }
    }
}
