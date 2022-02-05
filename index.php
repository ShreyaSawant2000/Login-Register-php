<?php 

include 'config.php';

session_start();
error_reporting(0);

if (isset($_SESSION['admin_login'])) {
    header("location: admin_home.php");
}

if (isset($_SESSION['candidate_login'])) {
    header("location: candidate_home.php");
}

if (isset($_SESSION['voter_login'])) {
    header("location:voter_home.php");
}

if (isset($_SESSION['subadmin_login'])) {
    header("location:subadmin_home.php");
}






if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$usertype = $_POST['usertype'];
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND usertype='$usertype'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
        switch($usertype) {
            case 'Admin':
                $_SESSION['admin_login'] = $email;
                $_SESSION['success'] = "Admin... Successfully Login...";
                header("location: admin_home.php");
            break;
            case 'Candidate':
                $_SESSION['candidate_login'] = $email;
                $_SESSION['success'] = "Candidate... Successfully Login...";
                header("location: candidate_home.php");
            break;
            case 'Voter':
                $_SESSION['voter_login'] = $email;
                $_SESSION['success'] = "Voter... Successfully Login...";
                header("location: voter_home.php");
            break;
            case 'Sub-Admin':
                 $_SESSION['subadmin_login'] = $email;
                 $_SESSION['success'] = "Subadmin... Successfully Login...";
                 header("location: subadmin_home.php");

            break;
            default:
                $_SESSION['error'] = "Wrong email or password or role";
                header("location: index.php");
            }
            }
        else {
		echo "<script>alert('Woops! Email or Password  or usertype is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	

	<title>Login Form </title>
    <style>
        #cars{
    display: block;
    width: 100%;
    padding: 15px 20px;
    margin-bottom: 15px;
    text-align: center;
    border: none;
    background: #f81172;
    outline: none;
    border-radius: 30px;
    font-size: 1.2rem;
    color: #FFF;
    cursor: pointer;
    transition: .3s;


}


        </style>

</head>
<body>

<?php if(isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <?php if(isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>






	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
            <div class="drop">
				<select id="cars" name="usertype" value=" <?php echo $usertype; ?>" required>
					<option selected >Select your usertype</option>
					<option value="Admin">Admin</option>
					<option value="Sub-Admin">Sub-Admin</option>
					<option value="Candidate">Candidate</option>
					<option value="Voter">Voter</option>
				  </select>
			</div>
		

			
             

			
			
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>