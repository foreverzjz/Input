<?php
header ( "content-type:text/html;charset=utf-8" );
include "../includes/model.class.php";
@$model =new Model("content");
@mysql_query("set names 'utf8'");

include "../user/simpleDict.php";
if(file_exists("../text/sensitive.txt")){}
else{
	SimpleDict::make("../text/SensitiveWord.txt", "../text/sensitive.txt");
}
$dict = new SimpleDict("../text/sensitive.txt");
?>
<?php
if ((($_FILES["file"]["type"] == "text/plain"))){
	$title_name=$_POST["title"];
	if ($_FILES["file"]["error"] > 0){
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }else{
		$fp = fopen($_FILES["file"]["tmp_name"], 'r');
		/* while (!feof($fp)) {
			$line = fgets($fp);
			$u=explode('# ', $line);//如果有分割
			mysql_query("INSERT INTO `user` (title)VALUES('trim($line)')",$conn);
			$model->insert(array('content'=>$line));
		} */
		$content = fread($fp,$_FILES["file"]["size"]);
		fclose($fp);
		$content = preg_replace('/[\r\n]+/', "\n", $content);//过滤掉多余的空行
		$content = preg_replace('/\s(?=\s)/', '', $content);
		$replaced = $dict->replace($content, "");
		if(strlen($content)>strlen($replaced)){
			echo "已将敏感词过滤后存储！";
		}else{
			echo "已存储！";
		}
		$model->insert(array('content'=>$replaced));
    }
}else{
	echo "文件格式不正确--txt";
}
?>