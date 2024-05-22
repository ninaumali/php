<?php
 
class database{
 
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=loginmethod', 'root', '');
    }
    function check($username, $password) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $stmt = $con->prepare("SELECT * FROM users WHERE user_name = ?");
        $stmt->execute([$username]);
    
        // Fetch the user data as an associative array
        $username = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // If a user is found, verify the password
        if ($username && password_verify($password, $username['pass_word'])) {
            return $username;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
    }

    // function check($username, $password){
    //     $con = $this->opencon();
    //     $query = "Select * from users WHERE user_name='".$username."'&&pass_word='".$password."'";
    //     return $con->query($query)->fetch();
    // }
    function signup($username, $password,  $firstname, $lastname, $birthday, $sex){
        $con = $this->opencon();
 
        $query = $con->prepare("SELECT user_name FROM users WHERE user_name = ?");
        $query->execute([$username]);
        $existingUser= $query->fetch();
        if ($existingUser){
            return false;
        }
        $query = $con->prepare("INSERT INTO users (user_name, pass_word, firstName, lastName, birthday, sex) VALUES (?, ?, ?, ?, ?,?)");
        return $query->execute([$username, $password, $firstname, $lastname, $birthday,$sex]);
    }

//     function signupUser($username, $password, $firstName, $lastName, $birthday, $sex) {
//         $con = $this->opencon();
 
//         $query = $con->prepare("SELECT user_name FROM users WHERE user_name = ?");
//         $query->execute([$username]);
//         $existingUser= $query->fetch();
//         if ($existingUser){
//             return false;
//         }
//         $query = $con->prepare("INSERT INTO users (firstName, lastName, birthday, sex, user_name, pass_word) VALUES (?, ?, ?, ?, ?,?)");
//         $query->execute([$firstName, $lastName, $birthday, $sex, $username, $password]); 
//         return $con->lastInsertId();
//     }

//     function insertAddress($user_id, $street, $barangay, $city, $province) {
//         $con = $this->opencon();
//         return $con->prepare("INSERT INTO user_address (user_id, user_add_street, user_add_barangay, user_add_city, user_add_province) VALUES (?, ?, ?, ?, ?)")
//         ->execute([$user_id, $street, $barangay, $city, $province]);
//  }
 
    function view()
    {
        $con = $this->opencon();
        return $con->query("SELECT users.user_id, users.user_name, users.pass_word, users.firstName, users.lastName, users.user_profile_picture, users.birthday, users.sex, CONCAT(user_address.user_add_street,' ', user_address.user_add_barangay,' ', user_address.user_add_city,' ', user_address.user_add_province) AS address FROM users JOIN user_address ON users.user_id=user_address.user_id")->fetchAll();
} 
function delete($id){
    try {
        $con = $this->opencon();
        $con->beginTransaction();

            $query = $con->prepare("DELETE FROM user_address WHERE user_id = ?");
            $query->execute([$id]);

            $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?");
            $query2->execute([$id]);

            $con->commit();
            return true; 
    }   catch (PDOException $e) {
        $con->rollBack();
        return false;
        }
    }
    function viewdata($id){ 
        try {
            $con = $this->opencon();
            $query = $con->prepare("SELECT users.user_id, users.user_name, users.pass_word, users.firstName, users.lastName, users.birthday, users.sex, user_address.user_add_street, user_address.user_add_barangay,user_address.user_add_city,user_address.user_add_province FROM users JOIN user_address ON users.user_id=user_address.user_id WHERE users.user_id = ?");
            $query->execute([$id]);
            return $query->fetch();
        } catch (PDOException $e) {
            return [];
}
    }
    function updateUser($user_id, $firstName, $lastName, $birthday, $sex, $username, $password) {
        try {
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE users SET firstName=?, lastName=?, birthday=?, sex=?, user_name=?, pass_word=? WHERE user_id=?");
            $query->execute([$firstName, $lastName, $birthday, $sex, $username, $password, $user_id]);
            // Update Successful
            $con->commit();
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return false, etc.)
            $con->rollBack();
            return false;	// Update failed
        }   	
    } 
    function signupUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture)
    {
        $con = $this->opencon();
        // Save user data along with profile picture path to the database
        $con->prepare("INSERT INTO users (firstName, lastName, birthday, sex, user_email, user_name, pass_word, user_profile_picture) VALUES (?,?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture]);
        return $con->lastInsertId();
        }
    
    
    function insertAddress($user_id, $street, $barangay, $city, $province)
    {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, user_add_street, user_add_barangay, user_add_city, user_add_province) VALUES (?,?,?,?,?)")->execute([$user_id, $street, $barangay,  $city, $province]);
          
    }
    function updateUserAddress($user_id, $street, $barangay, $city, $province) {
        try {
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE user_address SET user_add_street=?, user_add_barangay=?, user_add_city=?, user_add_province=? WHERE user_id=?");
            $query->execute([$street, $barangay, $city, $province, $user_id]);
            // Update Successful
            $con->commit();
            return true;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return false, etc.)
            $con->rollBack();
            return false;	// Update failed
        }   	
    }

}