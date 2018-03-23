<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
include($_SERVER['DOCUMENT_ROOT']."/functions.php");
include($_SERVER['DOCUMENT_ROOT']."/header.php");
?>

</head>
<body>

<div class="container marketing" style="margin-top: 50px">
    <div class="alert alert-primary" role="alert">
        This is a primary alert—check it out!
    </div>
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-4">
           <?php $object = getobject(2); $row = $object->fetch_assoc(); echo $row['wobj_content']; ?>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <?php $object = getobject(3); $row = $object->fetch_assoc(); echo $row['wobj_content']; ?>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <?php $object = getobject(4); $row = $object->fetch_assoc(); echo $row['wobj_content']; ?>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->

</body>
