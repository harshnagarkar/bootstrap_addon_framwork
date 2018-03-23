 <?php
 error_reporting(E_ALL);
 ini_set("display_errors","On");
 include("../functions.php");
 include("../header.php");

// $validate = authenticate_user($_POST['email'],$_POST['passwd']);
 $validate = true;
//$hash = connect("SELECT `user_pwd` FROM `users` WHERE `user_email` = ".$_POST['email']."");
//echo $hash;
//if($hash==md5($_POST['passwd'])){
//    echo 'Sucessfull authentication';
//    $valid = True;
//}
//else{
//    echo 'Your sure about the password';
//    $valid = True;
//}
 ?>
 <title>Dashboard of Web Objects</title>
</head>
 <body style="margin-top: 40px">
 <br>
 Create a new object:
<!-- <button onclick="--><?php //$n =setemptyobject(); ?><!--">Click me</button>-->
<!-- --><?php //if(!empty($n)) echo "Created at ID"$n?>
 <div align="top">
<table style="border: 1px solid black; border-collapse: collapse; width: 70%; ">
 <?php
 if($validate){
     $result = get_all_objects();
     while($row = $result->fetch_assoc())
     {
         echo "<tr >";
         echo "<th>".$row['wobj_title'] . "</th> <th>" . $row['wobj_date']. "</th><th>"."<a href='object_writer.php?link=" .$row['ID']  . " '>Edit</a></th>";
         echo "</tr>";
         echo "<br>";
     }
     }
 else{
         echo "acces denied";
 }
 ?>
</table>
 </div>
 </body>
 </html>

