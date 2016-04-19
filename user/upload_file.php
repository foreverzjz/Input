<?php
header ( "content-type:text/html;charset=utf-8" );
include "../includes/model.class.php";
include "../user/simpleDict.php";

define ('UTF32_BIG_ENDIAN_BOM'   , chr(0x00) . chr(0x00) . chr(0xFE) . chr(0xFF));
define ('UTF32_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE) . chr(0x00) . chr(0x00));
define ('UTF16_BIG_ENDIAN_BOM'   , chr(0xFE) . chr(0xFF));
define ('UTF16_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE));
define ('UTF8_BOM'               , chr(0xEF) . chr(0xBB) . chr(0xBF));

function detect_utf_encoding($text) {
	$first2 = substr($text, 0, 2);
	$first3 = substr($text, 0, 3);
	$first4 = substr($text, 0, 3);

	if ($first3 == UTF8_BOM) return 'UTF-8';
	elseif ($first4 == UTF32_BIG_ENDIAN_BOM) return 'UTF-32BE';
	elseif ($first4 == UTF32_LITTLE_ENDIAN_BOM) return 'UTF-32LE';
	elseif ($first2 == UTF16_BIG_ENDIAN_BOM) return 'UTF-16BE';
	elseif ($first2 == UTF16_LITTLE_ENDIAN_BOM) return 'UTF-16LE';
}
function getFileEncoding($str){
	$encoding=mb_detect_encoding($str);
	if(empty($encoding)){
		$encoding=detect_utf_encoding($str);
	}
	return $encoding;
}
function substr_cut($str_cut,$length){
	if (strlen($str_cut) > $length) {
		for($i=0; $i < $length; $i++)
			if (ord($str_cut[$i]) > 128) $i++;
		$str_cut = substr($str_cut,0,$i)."..";
	}
	return $str_cut;
}

@$model =new Model("article");
@mysql_query("set names 'utf8'");

if(file_exists("../text/sensitive.txt")){}
else{
	SimpleDict::make("../text/SensitiveWord.txt", "../text/sensitive.txt");
}
$dict = new SimpleDict("../text/sensitive.txt");

if ((($_FILES["file"]["type"] == "text/plain"))){
	if ($_FILES["file"]["error"] > 0){
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }else{
		if($_FILES["file"]["size"]<100){
			echo "上传过小！";
		}
		else {
			$fp = fopen($_FILES["file"]["tmp_name"], 'r');
			$title=basename($_FILES["file"]["name"],".txt");
			/* while (!feof($fp)) {
				$line = fgets($fp);
				$u=explode('# ', $line);//如果有分割
				mysql_query("INSERT INTO `user` (title)VALUES('trim($line)')",$conn);
				$model->insert(array('content'=>$line));
			} */
			$judge="";
			$content = fread($fp, $_FILES["file"]["size"]);
			fclose($fp);

			$content=iconv(getFileEncoding($content),'UTF-8',$content);//更改编码格式

			$substr_content=substr_cut($content,4000);//文章过大，截取

			if(strlen($substr_content)<strlen($content)){
				$judge=$judge."上传文章过大，已截取！";
			}
			$rep_content = preg_replace('/[\r\n]+/', "\n", $substr_content);//过滤掉多余的空行
			$rep_content = preg_replace('/\s(?=\s)/', '', $rep_content);//过滤多余空格
			//$rep_content = preg_replace("/\s|　/", "", $rep_content);//过滤所有空格

			$replaced = $dict->replace($rep_content, "");//过滤敏感词

			if (strlen($rep_content) > strlen($replaced)) {
				echo "已将敏感词过滤后存储！".$judge;
			} else {
				echo "已存储！".$judge;
			}
			$model->insert(array('AR_Title'=>$title,'AR_Content' => $replaced));
		}
    }
}else{
	echo "文件格式不正确--txt";
}
echo "<p>"."<a href='../user/upload.php'>"."<input type='button' value='返回',name='return'/>"."</a>";
?>