 <?php
	include('/var/DB/DBpass.php');
	
	function connect($qexecution){
		$mysqli = new mysqli(DBHOST, USERNAME, PASSWORD, DBNAME);

		if ($mysqli->connect_errno) {
			die('Could not connect to server'.DBHOST."<br />");
		}
		else{
            $result = mysqli_query($mysqli,$qexecution);
		}
		return $result;
	}

	function getobject($id){
        $object = connect("SELECT * FROM `web_object` WHERE `ID` =".$id.";");
        return $object;
    }

    function get_all_objects(){
       $objects = connect("SELECT `wobj_title` ,`wobj_date`,`ID` FROM `web_object`;");
       return $objects;
    }

    function authenticate_user($email,$pwd){
        $hash = connect("SELECT `user_pwd` FROM `users` WHERE `user_email` = ".$email."");
        echo $hash;
        if($hash==md5($pwd)){
            echo 'Sucessfull authentication';
            $valid = True;
        }
        else{
            echo 'Your sure about the password';
            $valid = false;
        }
        return $valid;
    }
    function setemptyobject(){
        $create = connect("INSERT INTO `web_object` (`wobj_title`,`wobj_content`,`wobj_status`,`wobj_date`) VALUES ('','',0,now());");
        $mx = connect("SELECT MAX(ID) FROM Customers;");
        return $mx;
    }

	?>