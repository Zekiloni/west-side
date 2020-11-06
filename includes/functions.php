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

	function discordMessage($content)
	{
		$webhookurl = "https://discord.com/api/webhooks/774060787815153674/kDoFZo8zhwCRuX4MiakHD-2ui_0X1lWj0ZCnbkOiyYvQVM2j0NJdyGjnGxAbE66qJ5zK";
		
		$timestamp = date("c", strtotime("now"));
		
		$skin = $userData['Skin'];

		$json_data = json_encode([

			# "content" => " poruka ", # slanje poruka
			# sadrzaj / poruka
			
			"username" => "user control panel", # ime bota
		
			"tts" => false,
		
			"embeds" => [
				[
						
					// Embed Type
					"type" => "rich",
		
					// Embed Description
					"description" => $content,
		
					# link
					// "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",
		
					// Timestamp of embed must be formatted as ISO8601
					#"timestamp" => $timestamp,
		
					// Embed left border color in HEX
					"color" => hexdec( "7b7b7b" ),
		
					# footer
					// "footer" => [ "text" => " ", "icon_url" => "slika.png"],
		
					# slika
					// "image" => [ "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=600" ],
		

					# naslovna slika
					//"thumbnail" => ["url" => "https://i.imgur.com/iBehaSs.png"],
		
					// polja
					/*"fields" => [
						// Field 1
						[
							"name" => "Field #1 Name",
							"value" => "Field #1 Value",
							"inline" => false
						],
						// Field 2
						[
							"name" => "Field #2 Name",
							"value" => "Field #2 Value",
							"inline" => true
						]
					]*/
				]
			]
		
		], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
		
		
		$ch = curl_init( $webhookurl );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec( $ch );
		// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
		// echo $response;
		curl_close( $ch );
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
					$vreme = date("H:i:s d-m-Y");
					discordMessage("**".$vreme."** *".$result[0]['Name']."*"." se upravo prijavio na korisnicki panel. ");
				
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

	public function Register($name, $password , $email)
	{
		$name = $this->db->quote($name);
		$password = $this->db->quote($password);
		$email = $this->db->quote($email);
		#$application = $this->db->quote($application);
		$regDate = date("d/m/Y, H:i:s ");
		$vreme = date("H:i:s d-m-Y");
		$ip = $this->getRealIpAddr();
		$password = strtoupper($this->Whirlpool($password));
		if($this->db->exists("accounts", "Email", $email)) { Alert("Greska !", "Korisnicki racun vec postoji.", 1); }
		else if ($this->db->exists("accounts", "Name", $name)) { Alert("Greska !", "Korisnicki racun vec postoji.", 1); }
		else 
		{ 
			$result = $this->db->query("INSERT INTO `accounts` (`Name`, `Lozinka`, `Email`, `RegDate`, `IP`) VALUES ('".$name."', '".$password."', '".$email."', '".$regDate."', '".$ip."');");
			Alert("Uspesno !","Vas korisnicki racun je registrovan.", 3); 
			discordMessage("**".$vreme."** *".$name." ("."$email".")* [".$ip."] je upravo poslao aplikaciju za pristup serveru.");
			
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