<?php
/**
 * Created by PhpStorm.
 * User: xiaozhen
 * Date: 2016/4/14
 * Time: 19:52
 */
session_start();
require("./checkcode.php");  //先把类包含进来，实际路径根据实际情况进行修改。
$_vc = new checkcode();  //实例化一个对象
$_vc->doimg();
$_SESSION['authnum_session'] = $_vc->getCode();//验证码保存到SESSION中
?>