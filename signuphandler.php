<?php
	if(isset($_POST['mode'])) {
		if ($_POST['mode'] == "reg") {
			$uid = $_POST['uid'];
			$pass = $_POST['pass'];
			$eid = $_POST['eid'];

			include 'config.php';

			$sqlu = "SELECT * FROM users WHERE username='$uid'";
			$sqle = "SELECT * FROM users WHERE email='$eid'";
			$resu = pg_query($conn,$sqlu);
			$rese = pg_query($conn,$sqle);

			if(pg_num_rows($resu)>0) {
				pg_close($conn);
				die("username exists");
			}
			else if(pg_num_rows($rese)>0) {
				pg_close($conn);
				die("email exists");
			}
			else{
				// $stmt = $conn->prepare("INSERT INTO users (username,pass,email) VALUES (?,?,?)");
			  // $stmt->bind_param("sss",$uid,$pass,$eid);
			  // $stmt->execute();
			  // $stmt->close();
				//simple way to do the above, but less secure
				$sql = "INSERT INTO users (username,email,password) VALUES ('$uid','$eid','$pass');";
				$scheck = pg_query($conn, $sql);
				if (!$scheck) {
					pg_close($conn);
					die("signup_failed");
				}
				else {
					pg_close($conn);
					die("signup_success");
				}
				pg_close($conn);
				exit();
			}
		}
		elseif ($_POST['mode'] == "login") {
			$uid = $_POST['uid'];
			$pass = $_POST['pass'];

			include 'config.php';

			$sqll = "SELECT * FROM users WHERE username= '$uid'";
			$result = pg_query($conn, $sqll);
			if($row = pg_fetch_assoc($result)) {
				$opass = $row['password'];
				if ($opass == $pass) {
					pg_close($conn);
					die("login_success");
				}
				elseif ($opass != $pass) {
					pg_close($conn);
					die("login_failed");   //wrong password
				}
			}
			else {
				pg_close($conn);
				die("login_failed");   //wrong uid
				}
			}
		pg_close($conn);
		exit();
	}
	else {
		echo "only request from crystal punch is allowed.";
	}
?>
