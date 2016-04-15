<meta charset="utf-8">
<?php
session_start();
/**
 从数据库获取信息，来判断用户是否重名
 * 邮箱也是不可以重复的。
 */

/*
 * 用户的注册
 */
include("../includes/function.php");
require("../includes/db.php");
//声明变量
$U_Account=trim($_POST[U_Account]);
$U_Email=trim($_POST[U_Email]);
$U_Password=md5($_POST[U_Password]);
$G_ID=trim($_POST[G_ID]);//用户区域
$U_Name=trim($_POST[U_Name]);//用户名
$U_Regtime=date("Y-m-j H:i:s");//注册时间
//需要用到的sql语句
$checksql="select U_Account from user WHERE U_Account='$U_Account' limit 1";
$email="select U_Account from user WHERE U_Email='$U_Email' limit 1";
$sql="INSERT INTO `inputsystem`.`user` (`U_ID`, `ROLE_ID`, `G_ID`, `U_Account`, `U_Password`, `U_Email`, `U_Name`, `U_Reg`) 
VALUES (NULL, '5', '$G_ID', '$U_Account', '$U_Password', '$U_Email', '$U_Name', '$U_Regtime');";
//新建一个数据库实例
$userdb=new db("localhost","root","","inputsystem");
$check=$userdb->query($checksql);
$info=$userdb->fetch_array($check);
if($info!=false)
{
    echo"<script language='javascript'>alert('该用户名已经存在');location.href='reg.php'</script>";
    exit;
}
$checkemail=$userdb->query($email);
$infoemail=$userdb->fetch_array($checkemail);
if($infoemail!=false)
{
    echo"<script language='javascript'>alert('该邮箱已经存在');location.href='reg.php'</script>";
    exit;
}
if($userdb->query($sql))
{

        echo "<script language=\"JavaScript\"> alert('注册成功');location.href='login.php'</script>";
        session_register("U_Account");
        $_SESSION["U_Account"]=$U_Account;
        exit;
}
else
{
        echo "<script language=\"JavaScript\"> alert('注册失败');location.href=\"reg.php\"</script>";
        exit;
}


?>