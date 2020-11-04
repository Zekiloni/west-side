<?php


function dateformat($type)
{
	switch($type)
	{
		case 1:
		{
			$date = date('m/d/Y'); 
			return $date;
		}
		break;
		
		case 2:
		{
			$date = date('m/d/Y - H:i:s');
			return $date;
		}
		break;
		
		case 3:
		{
			$date = date('j F Y');
			return $date;
		}
		break;
	}
}

function GetFullURL()
{
	$fullurl = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	return $fullurl;
}

function RoleplayName($name) {
	$result = str_replace("_", " ", $name);
	return $result;
}

function numberToTime($hours)
{

				$mins  = str_pad($hours %60,2,"0",STR_PAD_LEFT);

				if((int)$hours > 24){
				$days = str_pad(floor($hours /24),2,"0",STR_PAD_LEFT);
				$hours = str_pad($hours %24,2,"0",STR_PAD_LEFT);
				}
				if(isset($days)) { $days = $days." Dana, ";}

				return $days.$hours." Sati, ".$mins." Minuta";
}

function discordMembers() {
	$discord = json_decode(file_get_contents("https://discord.com/api/guilds/762050115564601375/widget.json"), true)['members'];
	$membersCount = 1;
	foreach ($discord as $member) {
		//if ($member['status'] == 'online' || $member['status'] == 'dnd') {
			$membersCount++;
		//}
	}
	return $membersCount;
}

function discordLink() {
	$discord = json_decode(file_get_contents("https://discord.com/api/guilds/762050115564601375/widget.json"), true);
	return $discord['instant_invite'];
}


function Alert($subject, $message, $type)
{
	switch($type)
	{
		case 1: // Error
		{
			echo "
			<div class='alert'>
				<strong>$subject</strong> $message
			</div>
			";
		} break;
		case 2: // Warning
		{
			echo "
			<div class='alert alert-warning' id='message'>
				<strong>$subject</strong> $message
			</div>
			";
		} break;
		case 3: // Success
		{
			echo "
			<div class='alert alert-success' id='message'>
				<strong>$subject</strong> $message
			</div>
			";
		} break;
	}
}

class User 
{
	public function __construct()
    {
        $this->db = new db();
	}

	public function isLogged()
	{
		if(isset($_SESSION['logged']))
		{
			if($_SESSION['logged'] == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		return false;
	}

	public function Login($email, $password)
	{
		$email = $this->db->quote($email);
		$password = $this->db->quote($password);
		if($_COOKIE['login_attemps'] <= 2)
		{
			if($this->db->exists("accounts", "Email", $email))
			{
				$result = $this->db->select("SELECT * FROM `accounts` WHERE `Email` = '$email'");
				$password = strtoupper($this->Whirlpool($password));
				if($password == $result[0]['Lozinka'])
				{
					$redir = $url."home"; header("Location: $redir");
					Alert("Successfully", "Logged in.", 3);
					$_SESSION['logged']   = true;
					$_SESSION['logged_as'] = $result[0]['ID'];
				}
				else
				{ 
					Alert("ERROR !", "Wrong password bro.", 1);  
					setcookie("login_attemps", $_COOKIE['login_attemps']+1, time() + (60 * 10)); // 60 * 10 = 10 minuta

				}
			}
			else 
			{ 
				Alert("ERROR ! !","You dont have account.", 1); 
			}
		}
		else 
		{
			Alert("ERROR !", "You are banned for 10 mins.", 1);  
		}
	}

	public function acountData($id)
	{
		$id = $this->db->quote($id);
		$result = $this->db->select("SELECT * FROM `accounts` WHERE `ID` = '$id'");
		return $result['0'];
	}

	public function Register($first_name, $last_name , $email, $password)
	{
		$first_name = $this->db->quote($first_name);
		$last_name = $this->db->quote($last_name);
		$email = $this->db->quote($email);
		$password = $this->db->quote($password);
		if($this->db->exists("users", "email", $email))
		{
			Alert("ERROR !", "Username already exist.", 1);
		}
		else 
		{ 
			$result = $this->db->query("INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."');");
			Alert("Succesful !","You have been registered.", 3); 
			
		}
	}

	public function isAdmin($id)
	{
		$id = $this->db->quote($id);
		$result = $this->db->select("SELECT * FROM `accounts` WHERE `ID` = '$id'");
		if($result[0]['Admin'] >= 1)	
		{
			return true;
		}
		else
		{
			return false;
		}
		return false;
	}

	public function logout($username) 
	{
		$username = $this->db->quote($username);
		session_start();
		session_unset();
		session_destroy();
		$this->db->query("UPDATE `accounts` SET `online` = '0' WHERE `username` = '".$username."';");
	}

	public function GetAllUsers()
	{
		$result = $this->db->select("SELECT * FROM `accounts`");
		return $result;
	}

	public function getOnlineUsers()
	{
		$result = $this->db->select("SELECT * FROM `accounts` WHERE `online` = '1'");
		return $result;
	}

	public function getAccesories($id)
	{
		$id = $this->db->quote($id);
		$result = $this->db->select("SELECT `accesories` FROM `accounts` WHERE `id` = '$id'");
		return json_encode($result);
	}


	public function GetApplications()
	{
		$result = $this->db->select("SELECT * FROM `applications`");
		return $result;
	}

	public function vehData($id)
	{
		$id = $this->db->quote($id);
		$result = $this->db->select("SELECT * FROM `cars` WHERE `carID` = '$id'");
		return $result['0'];
	}

	public function	getVehicleModel($vehicleid)
	{
		$vehicleid = $this->db->quote($vehicleid);
		$result = $this->db->select("SELECT * FROM `cars` WHERE `carID` = '$vehicleid'");
		return $result['0']['carModel'];
	}

	public function Whirlpool($value)
	{
		return hash('whirlpool', $value);
	}

	public function getRealIpAddr()
	{
		if(!empty($_SERVER['HTTP_CF_CONNECTING_IP']))
		{
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} elseif (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
		
	public function getUserAgent()
	{
		return $_SERVER["HTTP_USER_AGENT"];
	}
	
	public function getUserOS()
	{
		$useragent = $_SERVER["HTTP_USER_AGENT"];
		$user_load = $this->url("http://www.useragentstring.com/?uas=".urlencode($useragent)."&getJSON=all", 5);
		$user_load = json_decode($user_load);
		$os = $user_load->os_type." (".$user_load->os_name.")";
		return $os;
	}

}

class Site
{
	public function __construct()
    {
        $this->db = new db();
	}

	public function getCategories()
	{
		$result = $this->db->select("SELECT * FROM `categories` ");
		return $result; 
	}

	public function getimages()
	{
		$result = $this->db->select("SELECT * FROM `upload_images`");
		return $result; 
	}

	public function deleteCategory($id)
	{
		$this->db->delete("categories", "id", $id);
	}


	public function addPost($naslov, $tekst, $slika)
	{
		$naslov = $this->db->quote($naslov);
		$tekst = $this->db->quote($tekst);
		$slika = $this->db->quote($slika);
		$this->db->query("INSERT INTO `novosti` (`naslov`, `tekst`, `slika`) VALUES ('".$naslov."', '".$tekst."', '".$slika."');");
	}

	public function getPosts()
	{
		$result = $this->db->select("SELECT * FROM `novosti` ORDER BY `id` DESC LIMIT 5");
		if($result) {
			return $result; 
		}
		else { echo '<div class="col-md box-1">Trenutno nema novih vesti.</div>'; }
		
	}

	public function deleteProduct($id)
	{
		$this->db->delete("products", "id", $id);
	}


}


class db  
{
    protected static $connection;

    public function connect() 
	{
        if(!isset(self::$connection))
		{
            self::$connection = new mysqli('localhost', 'root', '', 'wsrp'); # host, user, pass, base
        }
        if(self::$connection === false)
		{
            return FALSE;
        }
        return self::$connection;
    }

    public function query($query)
	{
        $connection = $this->connect();
        $result = $connection->query($query);
		if($result == TRUE)
		{
			return TRUE;
		}
		else
		{
			return '0';
		}
	}

    public function select($query)
	{
        $rows = array();
		$connection = $this->connect();
        $result = $connection->query($query);
        if($result === false)
		{
            return FALSE;
        }
        while ($row = $result->fetch_assoc())
		{
            $rows[] = $row;
        }
		//$result->free();
        return $rows;
    }
	
	public function delete($table, $column, $value)
	{
		
		if($this->exists($table, $column, $value) == 1)
		{
			$result = $this->query("DELETE FROM $table WHERE $column =".$value);
			return TRUE;
		}
		else
		{
			return '0';
		}
	}
	
	public function	exists($table, $column, $value) 
	{
		$connection = $this->connect();
        $result = $connection->query("SELECT * FROM $table WHERE $column = '".$value."'");
		if(isset($result->num_rows)) {
			return $result->num_rows > 0 ? true : false;
		} else return false;	
	}

	/*public function    exists($table, $column, $value) 
    {
        $connection = $this->connect();
        $result = $connection->query("SELECT * FROM $table WHERE $column = '".$value."'");
        if($result == TRUE)
        {
            if($result->num_rows == 1) 
            {
                return TRUE;
            }
            else
            {
                return '0';
            }
        }
    }*/
	
	public function numrows($table)
	{
		$connection = $this->connect();
		$result = $connection->query("SELECT * FROM $table");
		if($result == TRUE)
		{
			if($result->num_rows > 0) 
			{
				return $result->num_rows;
			}
			else
			{
				return '0';
			}
		}
	}
	
    public function error()
	{
        $connection = $this->connect();
        return $connection->error;
    }

    public function quote($value)
	{
        $connection = $this->connect();
        return "" . $connection->real_escape_string($value) . "";
    }
    public function close()
    {
        mysqli_close(self::$connection);
    }
}
?>