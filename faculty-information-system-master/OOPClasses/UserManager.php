<?php

class UserListManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserList()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        
        if (!$result) {
            die("Invalid Query: " . $this->conn->errorInfo()[2]);
        }
        
        echo "<table>
                <tr>
                    <th>User Id</th>
                    <th>username</th>
                    <th>password</th>
                    <th>Role</th>
                    <th>action</th>
                </tr>";
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['role_name']}</td>
                    <td>
                        <a href=\"update_user.php?user_id={$row['user_id']}\"><i class='fa fa-edit'></i></a>
                        <a href=\"delete_user.php?user_id={$row['user_id']}\"><i class='fa fa-trash'></i></a>
                    </td>
                </tr>";
        }
        
        echo "</table>";
    }

    public function addUser($username, $password, $role_name) {
        if ($role_name == 'Admin') {
            $sql = "INSERT INTO staff (StaffNo, Password) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username, $password]);
        } elseif ($role_name == 'Students') {
            $sql = "INSERT INTO student (StudentNo, Password) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username, $password]);
        }

        $sql = "SELECT MAX(user_id) FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $maxUserId = $stmt->fetchColumn();
        $user_id = $maxUserId + 1;

        $sql = "INSERT INTO `users` (user_id, username, password, role_name) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $username, $password, $role_name]);
    }
    
    public function updateUser($user_id, $username, $password, $role_name) {
        $sql = "UPDATE users SET username = ?, password = ?, role_name = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username, $password, $role_name, $user_id]);

        return $stmt->rowCount() > 0;
    }

    public function getUserById($user_id) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function deleteUser($user_id) {
        // Check if the user being deleted is currently logged in
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {
            session_unset();
            session_destroy();
        }

        // Retrieve the role_name and username for the user being deleted
        $sql = "SELECT role_name, username FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $role_name = $result['role_name'];
        $username = $result['username'];

        // Delete the user from the database
        $sql = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);

        // Delete the corresponding record from staff table if role_name is 'Admin'
        if ($role_name == 'Admin') {
            $sql = "DELETE FROM staff WHERE StaffNo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username]);
        }

        // Delete the corresponding record from student table if role_name is 'Students'
        if ($role_name == 'Students') {
            $sql = "DELETE FROM student WHERE StudentNo = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username]);
        }
    }
}
