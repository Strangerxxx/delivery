<?php
	function db_connect(){
		mysql_connect (db_host, db_user, db_pass);
		mysql_select_db (db_name);
	}

	function regUser($login, $pass, $email){
		if(empty($login) && preg_match("/^\w{3,}$/", $login)) $return .= "Login required";
		elseif(empty($pass) && preg_match("/\A(\w){6,20}\Z/", $pass)) $return .= "Password required";
		elseif(empty($email) && preg_match("/^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/", $email)) $return .= "Email required";
		else {
			$login = mysql_real_escape_string($login);
			$pass = md5(mysql_real_escape_string($pass));
			$email = mysql_real_escape_string($email);
			if(mysql_num_rows( mysql_query("SELECT id FROM users WHERE login='".$login."'") or die(mysql_error()) ) > 0) $return .= "Username exists";
			elseif(mysql_num_rows( mysql_query("SELECT id FROM users WHERE email='".$email."'") or die(mysql_error()) ) > 0) $return .= "Email exists";
			else{
				mysql_query("INSERT INTO users (login, pass, email) VALUES ('".$login."', '".$pass."', '".$email."')") or die(mysql_error());
				$return .= "Success";
			}
		}
		return $return;
	}

	function loginUser($login, $pass){
		if(empty($login) && preg_match("/^\w{3,}$/", $login)) $return .= "Login required";
		elseif(empty($pass) && preg_match("/\A(\w){6,20}\Z/", $pass)) $return .= "Password required";
		else{
			$login = mysql_real_escape_string(trim($login));
			$pass = md5(mysql_real_escape_string(trim($pass)));
			$row = mysql_fetch_row(mysql_query("SELECT id FROM users WHERE login='".$login."' AND password='".$pass."'"));
			$userid = $row[0];
			if(empty($userid)) $return .= "Pair of login/pass does not exist";
			else{
				$sessionid = time().":".$userid.":".md5(rand()).":".md5($_SERVER['REMOTE_ADDR']);
				$hash = md5($_SERVER['REMOTE_ADDR']);
				mysql_query("INSERT INTO sessions (userid, sessionid) values ('".$userid."', '".$sessionid."', '".$hash."')") or die(mysql_error());
				$_SESSION['sessionid'] = md5($sessionid);
				$_SESSION['hash'] = md5($hash);
				$return .= "Success";
			}
		}
		return $return;
	}
	function checkUserLogin($sessionid, $userhash){
		$userhash = md5($_SERVER['REMOTE_ADDR']);
		if($userhash == $hash){
			$sql = mysql_query("SELECT * FROM sessions WHERE sessionid = '".$sessionid."', hash = '".$hash."'") or die(mysql_error());
			if(mysql_num_rows($row) == 0) return false;
			else {
				$rows = mysql_fetch_array($sql);
				return $rows['userid'];
			}
		}

	}
?>