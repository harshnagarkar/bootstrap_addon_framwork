<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
include("../functions.php");
include("../header.php");
$id = $_GET['link'];
//$id = 2;
$object = getobject($id);
$row = $object->fetch_assoc();
?>
<title>Object Writer for <?php echo htmlspecialchars($row['wobj_title']); ?></title>
</head>
<body >
<div>
    <h1><b> Object writer module</b></h1>
    <h3><b></b>Greeting</b></h3>
    <h3>Currently you are writing <?php echo "<u><b>".htmlspecialchars($row['wobj_title'])."</b></u>"."-".htmlspecialchars($row['wobj_date']);  ?></h3>
</div>
<div>
    <script type="text/javascript" src="./xheditor-1.2.1/jquery/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="./xheditor-1.2.1/xheditor_lang/en.js"></script>
    <script type="text/javascript" src="./xheditor-1.2.1/xheditor-1.2.1.min.js"></script>
</div>
<div align = "center">
<form style="margin-top: 100px">
TITLE:-&nbsp;
<input type="text" name="title" value="<?php echo htmlspecialchars($row['wobj_title']);?>" size="80%"/><br><br>
STATUS:-&nbsp;
<input type="text" name="status" value="<?php echo htmlspecialchars($row['wobj_status']); ?>" />&nbsp;&nbsp;
TYPE:-&nbsp;
<input type="text" name="type" value="<?php echo htmlspecialchars($row['wobj_type']); ?>" size="10%"/>&nbsp;&nbsp;
DATE:-&nbsp;
<input type="text" name="date" value="<?php echo htmlspecialchars($row['wobj_date']); ?>" size="10%"/><br><br>
<textarea type="text" name="ele1" id="ele1" class="xheditor"  rows="15" cols="90" >
<?php echo htmlspecialchars($row['wobj_content']); ?>"
</textarea>
<br>
<button class="btn btn-lg btn-primary" type="submit">SUBMIT</button>
</form>
</div>
</body>
</html>