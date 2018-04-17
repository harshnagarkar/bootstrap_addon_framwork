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
        $object = connect("SELECT * FROM `web_object` WHERE `ID` = '$id'");
        return $object;
    }

    function get_all_objects(){
       $objects = connect("SELECT `wobj_title` ,`wobj_date`,`ID` FROM `web_object`;");
       return $objects;
    }

    function authenticate_user($email,$pwd){
	    $check = md5($pwd);
        $hash = connect("SELECT * FROM `users` WHERE `user_email` = '$email' and `user_pwd` = '$check'");
        $num_rows = mysqli_num_rows($hash);
        if($num_rows ==1){
            echo 'Sucessfull authentication';
            return $valid = True;

        }
        else{
            header('Location: ../login.php');
        }

    }
    function setemptyobject($title){
        $create = connect("INSERT INTO `web_object` (`wobj_title`,`wobj_content`,`wobj_status`,`wobj_date`) VALUES ('$title','',0,now())");
        $mx = connect("SELECT MAX(ID) FROM Customers");
        return $mx;
    }

    function deleteobject($id){
	    $delete = connect("DELETE FROM `web_object` WHERE ID='$id'");
        if(! $delete ) {
        echo "Delete unsucessfull";
        }
        echo "Deleted data successfully\n";
    }
	?> <?php
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
        $object = connect("SELECT * FROM `web_object` WHERE `ID` = '$id'");
        return $object;
    }

    function get_all_objects(){
       $objects = connect("SELECT `wobj_title` ,`wobj_date`,`ID` FROM `web_object`;");
       return $objects;
    }

    function authenticate_user($email,$pwd){
	    $check = md5($pwd);
        $hash = connect("SELECT * FROM `users` WHERE `user_email` = '$email' and `user_pwd` = '$check'");
        $num_rows = mysqli_num_rows($hash);
        if($num_rows ==1){
            echo 'Sucessfull authentication';
            return $valid = True;

        }
        else{
            header('Location: ../login.php');
        }

    }
    function setemptyobject($title){
        $create = connect("INSERT INTO `web_object` (`wobj_title`,`wobj_content`,`wobj_status`,`wobj_date`) VALUES ('$title','',0,now())");
        $mx = connect("SELECT MAX(ID) FROM Customers");
        return $mx;
    }

    function deleteobject($id){
	    $delete = connect("DELETE FROM `web_object` WHERE ID='$id'");
        if(! $delete ) {
        echo "Delete unsucessfull";
        }
        echo "Deleted data successfully\n";
    }
	?>