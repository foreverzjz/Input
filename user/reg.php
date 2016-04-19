<meta charset="utf-8">
<script src="../js/jquery-1.8.3.min.js"></script>
<script language=JavaScript>
	$(document).ready(function(){
	  $("#a").blur(function(){
		alert("This input field has lost its focus.");
	  });
	  $("#b").blur(function(){
		alert("aaa");
	  });
	});
function IsMail(mail){
var patrn = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
if (!patrn.test(mail))
{
    return false;
}
else
{
    return true;
}
}

//是否为正确的Email地址
function checkreg() {
    if (reg.G_ID.value == "") {
        alert('请选择用户组！');
        reg.G_ID.focus();
        return false;
    }
    if (reg.U_Account == "") {
        alert('请输入登录账号！');
        reg.U_Account.focus();
        return false;
    }
    if (reg.U_Account.value.replace(/[^\x00-\xff]/g, "**").length < 6) {
        alert('登录账号不能少于6个字符！');
        reg.U_Account.focus();
        return false;
    }
    if (document.reg.U_Account.value.replace(/[^\x00-\xff]/g, "**").length > 16) {
        alert('登录账号不能多于16个字符！');
        document.reg.U_Account.focus();
        return false;
    }
    if (reg.U_Name.value == "") {
        alert('请输入用户姓名！');
        reg.U_Name.focus();
        return false;
    }
    if (reg.U_Name.value.replace(/[^\x00-\xff]/g, "**").length > 16) {
        alert('登录账号不能多于16个字符！');
        reg.U_Name.focus();
        return false;
    }
    if (reg.U_Password.value.length < 6) {
        alert('登录密码要大于6位！');
        reg.U_Password.focus();
        return false;
    }
    if (reg.U_Password.value != reg.R_Password.value) {
        alert('两次密码不一致！');
        reg.R_Password.focus();
        return false;
    }
    if (IsMail(reg.U_Email.value) != true) {
        alert('电子邮箱格式不正确！');
        reg.U_Email.focus();
        return false;
    }
    if(reg.E_Mail.value.length>32)
    {
        alert("请邮箱不过超过32个字符");
        return false;
    }
    return true;
}
</script>
<div align="center">
    <div style="width:450px">
        <br><div class="MainCount_in" style="font-size: larger; font-weight: bold">用户注册</div>
        <form id="reg" name="reg" method="post" action="check.php" onsubmit="return checkreg()">
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="tableLine" id="regBody">
                <tr>
                    <td  height="38" align="right">用 户 组:</td>
                    <td ><select name="G_ID" class="inputText"  onchange="stringtonum()">
                            <option   value="" selected="selected">请选择</option>
                            <option value="1">安徽省</option>
                            <option value="2">澳门</option>
                            <option value="3">北京市</option>
                            <option value="4">福建省</option>
                            <option value="5">甘肃省</option>
                            <option value="6">广东省</option>
                            <option value="7">广西省</option>
                            <option value="8">贵州省</option>
                            <option value="9">海南省</option>
                            <option value="10">海外</option>
                            <option value="11">河北省</option>
                            <option value="12">河南省</option>
                            <option value="13">黑龙江</option>
                            <option value="14">湖北省</option>
                            <option value="15">湖南省</option>
                            <option value="16">吉林省</option>
                            <option value="17">江苏省</option>
                            <option value="18">江西省</option>
                            <option value="19">辽宁省</option>
                            <option value="20">内蒙古</option>
                            <option value="21">宁夏</option>
                            <option value="22">青海省</option>
                            <option value="23">山东省</option>
                            <option value="24">山西省</option>
                            <option value="25">陕西省</option>
                            <option value="26">上海市</option>
                            <option value="27">四川省</option>
                            <option value="28">台湾</option>
                            <option value="29">天津市</option>
                            <option value="30">西藏</option>
                            <option value="31">香港</option>
                            <option value="32">新疆</option>
                            <option value="33">云南省</option>
                            <option value="34">浙江省</option>
                            <option value="35">重庆市</option>
                        </select>
                        省</td>
                </tr>
                <tr>
                    <td align="right">登录账号:</td>
                    <td><input name="U_Account" id="登录账号" type="text" class="inputText" value="" />(用于登录系统，请牢记！)</td>
                </tr>
                <tr>
                    <td align="right">用户姓名:</td>
                    <td><input name="U_Name" type="text" class="inputText" id="a"/></td>
                </tr>
                <tr>
                    <td align="right">登录密码:</td>
                    <td><input name="U_Password"  type="password" class="inputText" />密码要大于6位</td>
                </tr>
                <tr>
                    <td align="right">确认密码:</td>
                    <td><input name="R_Password" type="password" class="inputText"   /></td>
                </tr>
                <tr>
                    <td align="right">电子邮箱:</td>
                    <td><input name="U_Email" type="text" class="inputText" value=""  maxlength="30"/>(邮箱格式：abc@qq.com)</td>
                </tr>
                <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="submit" value="注 册" /></td>
                </tr>
            </table>
        </form>

    </div>
</div>


