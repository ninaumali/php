<?php
require_once('classes/database.php');
$con = new database();
$error_message = '';
 
if (isset($_POST['Signup'])) {
    $username = $_POST['user_name'];
    $password = $_POST['pass_word'];
    $confirmpassword = $_POST['confirmpassword'];
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];

        if ($password == $confirmpassword) {
            if($con->signup($username, $password, $firstname, $lastname, $birthday, $sex)) {
                header('location:login.php');
                exit();
            } else {
                $error_message = "Username already exists. Please choose a different username.";
            }
        } else {
            $error_message = "Password did not match.";
        }
    } else {
        $error_message = "Please fill all fields.";
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
 
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
 
<div class="container-fluid signup-container rounded shadow">
  <h2 class="text-center mb-4">Sign Up</h2>
 
  <form method="post">
    <div class="form-group">
      <label for="firstName">First Name:</label>
      <input type="text" class="form-control" name="firstName" placeholder="Enter First Name">
    </div>
    <div class="form-group">
      <label for="lastName">Last Name:</label>
      <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name">
    </div>
    <div class="form-group">
      <label for="birthday" class="form-label">Birthday:</label>
      <input type="date" class="form-control" name="birthday">
      <div class="form-group">
      <label for="sex" class="form-label">Sex:</label>
      <select class="form-select" name="sex">
        <option selected disabled>Select Sex</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    </div>
    <div class="form-group">
      <label for="user_name">Username:</label>
      <input type="text" class="form-control" name="user_name" placeholder="Enter username">
    </div>
    <div class="form-group">
      <label for="pass_word">Password:</label>
      <input type="password" class="form-control" name="pass_word" placeholder="Enter password">
    </div>
    <div class="form-group">
      <label for="confirmpassword">Confirm Password:</label>
      <input type="password" class="form-control" name="confirmpassword" placeholder="Enter password">
    </div>
    <?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <input type="submit" name="Signup" class="btn btn-danger btn-block" value="Sign Up">
  </form>
</div>
 
<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
 
</body>
</html>
 