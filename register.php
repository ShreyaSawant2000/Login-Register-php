<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['firstname'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $collegename = $_POST['collegename'];
  $branch=$_POST['branch'];
  $year1 = $_POST['year1'];
  $gender = $_POST['gender'];
  $isstudent = $_POST['isstudent'];
  $usertype = $_POST['usertype'];
  $studentid = $_POST['studentid'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (firstname,lastname, email,phone,collegename,branch, year1,gender,isstudent,usertype,studentid, password)
					VALUES ('$firstname','$lastname', '$email','$phone','$collegename','$branch','$year1','$gender','$isstudent','$usertype','$studentid', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
        header("Location: index.php");
				$firstname = "";
        $lastname="";
				$email = "";
        $phone="";
        $collegename ="";
        $branch="";
        $year="";
        $gender ="";
        $isstudent="";
        $usertype="";
        $studentid ="";
        
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="register.css">

	<title>Register Form </title>
</head>
<body>
<!-- 	
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
              -->
			  <form  class="signup-form" action="" method="POST">

      <!-- form header -->
      <div class="form-header">
        <h1 style="font-size: 2rem; font-weight: 800;">Registeration Form</h1>
      </div>

      <!-- form body -->
      <div class="form-body">

        <!-- Firstname and Lastname -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label for="firstname" class="label-title">First name *</label>
            <input type="text" id="firstname" name="firstname" class="form-input" placeholder="Enter your first name" />
          </div>
          <div class="form-group right">
            <label for="lastname" class="label-title">Last name</label>
            <input type="text" id="lastname" name="lastname" class="form-input" placeholder="Enter your last name" />
          </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="email" class="label-title">Email*</label>
          <input type="email" id="email" class="form-input" name="email" placeholder="Enter your email" required="required">
        </div>
        
        <!--Phone-->
        <div class="form-group">
            <label for="phone" class="label-title">Phone*</label>
            <input type="phone" id="phone" name="phone" class="form-input" placeholder="Enter your phone" required="required">
          </div>

           <!--College name-->
        <div class="form-group">
            <label for="college" class="label-title">College Name*</label>
            <input type="college" id="college" name="collegename" class="form-input" placeholder="Enter your College Name" required="required">
          </div>

           <!-- Branch and Year -->
        <div class="horizontal-group">
            <div class="form-group left" >
              <label class="label-title">Branch*</label>
              <select class="form-input" id="level" name="branch" required="required" >
                <option value="" selected="selected"></option>
                <option value="Computer">Computer</option>
                <option value="It">It</option>
                <option value="Mechnical">Mechnical</option>
                <option value="Chemical">Chemical</option>
                <option value="Electronics">Electronics</option>
                <option value="Civil">Civil</option>
                <option value=">Civil and Infrastructure">Civil and Infrastructure</option>
                <option value="Artificial Intelligence and Data Science">Artificial Intelligence and Data Science</option>

              </select>
            </div>
            <div class="form-group right">
                <label class="label-title">Year *</label>
              <select class="form-input" id="level" name="year1" >
                <option value="" selected="selected"></option>
                <option value="First Year">First Year</option>
                <option value="Second Year">Second Year</option>
                <option value="Third Year">Third Year</option>
                <option value="Fourth Yea">Fourth Year</option>

              </select>
              
            </div>
          </div>















       
        <!-- Gender and Is Student -->
        <div class="horizontal-group">
          <div class="form-group left">
            <label class="label-title">Gender:</label>
            <div class="input-group">
              <label for="male"><input type="radio" name="gender" value="male" id="male"> Male</label>
              <label for="female"><input type="radio" name="gender" value="female" id="female"> Female</label>
            </div>
          </div>
          <div class="form-group right">
            <label class="label-title">Is Student</label>
            <div class="input-group">
                <label for="Yes"><input type="radio" name="isstudent" value="yes" id="Yes"> Yes</label>
                <label for="No"><input type="radio" name="isstudent" value="no" id="No"> No</label>
              </div>
          </div>
        </div>

        <!-- usertype and studentid -->
        <div class="horizontal-group">
          <div class="form-group left" >
            <label class="label-title">Usertype</label>
            <select class="form-input" id="level"name="usertype" >
              <option value="Admin">Admin</option>
              <option value="Voter">Voter</option>
              <option value="Candidate">Candidate</option>
            </select>
          </div>
          <div class="form-group right">
            <!-- <label for="experience" class="label-title">Income</label> -->
            <label for="StudentID" class="label-title">Students Enter StudentID *</label>
            <input type="text" id="StudentID" class="form-input" name="studentid" placeholder="Enter your StudentID" required="required" />
          </div>
        </div>

         <!-- Passwrod and confirm password -->
         <div class="horizontal-group">
            <div class="form-group left">
              <label for="password" class="label-title">Password *</label>
              <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required="required">
            </div>
            <div class="form-group right">
              <label for="confirm-password" class="label-title">Confirm Password *</label>
              <input type="password" class="form-input" id="confirm-password" name="cpassword" placeholder="Enter your password again" required="required">
            </div>
          </div>
  

        

      <!-- form-footer -->
      <hr>
	  <div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text"> Already have an account ? <a href="index.php">Sign in</a>.</p>




      <!-- <div class="form-footer">
        
       
        <p> Already have an account ?<a href="index.php"> Sign in</a>.</p>
    
        <button type="submit" class="registerbtn"><b>Register</b></button>
      </div>
       -->
      <!-- <div class="container signin">
        <p>Already have an account? <a href="http://127.0.0.1:5501/userlogin.html">Sign in</a>.</p>
      </div>
      </div> -->

    </form>

    <!-- Script for range input label -->
    <script>
      var rangeLabel = document.getElementById("range-label");
      var experience = document.getElementById("experience");

      function change() {
      rangeLabel.innerText = experience.value + "K";
      }
    </script>
	








			
</body>
</html>