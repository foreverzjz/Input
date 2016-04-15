<meta charset="utf-8">

<?php
/**
 实现网站常用的一些功能
 */
//屏蔽所有报错
error_reporting(E_ALL ^ E_NOTICE);
function htmltotext($content)
{
    //将html源码转换为php文本
    //替换<br>回车还有&nbsp的回车
    $content=str_replace("\n","<br>",str_replace(" ","&nbsp;",$content));
    return $content;
}
?>