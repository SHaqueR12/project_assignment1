<?php
include '../lib/Session.php' ;
Session::checklogin();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/database.php'; ?>
<?php include "../helpers/format.php";?>

<?php 
$db=new database();
$fm=new format();
?>



<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password recover</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$email = $fm->validation($_POST['email']);
			
			$email = mysqli_real_escape_string($db->link, $email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				echo "Opps!! Invalid email...";
			}
            else{
                $mquery = "select * from user where email='$email' limit 1";
                $mailcheck = $db->select($mquery);
		 if($mailcheck != false)
		 {
			while($value=$mailcheck->fetch_assoc())
            {
                $userid=$value['id'];
                $username=$value['username'];
            }
            $text= substr($email, 0 ,3);
            $random= rand(10000, 99999);
            $newpass ="$text$random"; 
            $password=md5($newpass);
            $upquery = "update user set 
            password = '$password' where id = '$userid' ";
            $update_row = $db->update($upquery);
			$to = "$email";
			$from = "riyaaa@gmail.com";
			$headers ="From: $from\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' ."\r\n"; 
			$subject = "Your Password";
			$message = "Your username is  ".$username." and password is ".$newpass." Please visit website to login.";
            $sendmail = mail($to, $subject, $message, $headers);
			if($sendmail)
			{
				echo "<span style='color:green; font-size:18px;'>Email is sent.</span>";
			}else
			{
				echo "<span style='color:red; font-size:18px;'>Email not sent.</span>";
			}
		 }
		
			
		 else
		 {
			echo "<span style='color:red; font-size:18px;'>Email not exists.</span>";
		 }}
        }
		?>
		<form action="" method="post">
			<h1>Recover password</h1>
			<div>
				<input type="text" placeholder="Enter your email" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="send mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Demo Project of Sanjida</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>