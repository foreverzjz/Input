<?php
header ( "content-type:text/html;charset=utf-8" );
/*
 *利用php， 文件的上传。
 */

//文件格式的控制

//文件编码的判断

//文件的保存位置
?>
<form method="post" enctype="multipart/form-data" action="upload_file.php">
	<p>请输入标题：<input type="text" name="title" id="title" value=""/>
    <p><input type="file" name="file" id="file" />
    <p><input type="submit" value="submit"/>
</form>
