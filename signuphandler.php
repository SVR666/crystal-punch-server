<?php
	if(isset($_POST['mode']))
	{
		if ($_POST['mode'] == "reg")
		{
			$uid = $_POST['uid'];
			$pass = $_POST['pass'];

			include 'config.php';

			$sqlu = "SELECT * FROM users WHERE username ='$uid'";
			$resu = pg_query($conn,$sqlu);

			if(pg_num_rows($resu)>0)
			{
				pg_close($conn);
				die("username already exists");
			}
			else
			{
				$sql = "INSERT INTO users (username,password) VALUES ('$uid','$pass');";
				$scheck = pg_query($conn, $sql);

				if (!$scheck)
				{
					pg_close($conn);
					die("signup failed");
				}
				else
				{
					$sql = "INSERT INTO winloss (username,win,loss) VALUES ('$uid',0,0);";
					pg_query($conn, $sql);
					pg_close($conn);
					die("signup_success");
				}
				pg_close($conn);
				exit();
			}
		}
		elseif ($_POST['mode'] == "login")
		{
			$uid = $_POST['uid'];
			$pass = $_POST['pass'];

			include 'config.php';

			$sqll = "SELECT * FROM users WHERE username = '$uid'";
			$result = pg_query($conn, $sqll);
			if($row = pg_fetch_assoc($result))
			{
				$opass = $row['password'];
				if ($opass == $pass)
				{
					$sqlw = "SELECT * FROM winloss WHERE username = '$uid'";
					$resw = pg_query($conn, $sqlw);
					$winloss = pg_fetch_assoc($resw);
					$win = $winloss['win'];
					$loss = $winloss['loss'];
					$coin = $winloss['coins'];
					pg_close($conn);
					die("login_success|".$win."|".$loss."|".$coin);
				}
				elseif ($opass != $pass)
				{
					pg_close($conn);
					die("username/password doesn't match");   //wrong password
				}
			}
			else
			{
				pg_close($conn);
				die("username/password doesn't match");   //wrong uid
			}
		}
		pg_close($conn);
		exit();
	}
	else
	{
		echo "only request from crystal punch is allowed.";
	}
?>
