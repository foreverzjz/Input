/**
 * Created by xiaozhen on 2016/4/4.
 */
var xmlHttp;
xmlHttp =new XMLHttpRequest();
function IsMail(mail){
    var patrn = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (!patrn.test(mail))
        return false;
    else
        return true;
}

    //是否为正确的Email地址
    function checks3(){
        if (document.hbwlFormAjax.用户组.value==""){
            alert ('请选择用户组！');
            document.hbwlFormAjax.用户组.focus();
            return false;
        }
        if (document.hbwlFormAjax.登录账号.value==""){
            alert ('请输入登录账号！');
            document.hbwlFormAjax.登录账号.focus();
            return false;
        }
        if (document.hbwlFormAjax.登录账号.value.replace(/[^\x00-\xff]/g,"**").length<4){
            alert ('登录账号不能少于4个字符！');
            document.hbwlFormAjax.登录账号.focus();
            return false;
        }
        if (document.hbwlFormAjax.登录账号.value.replace(/[^\x00-\xff]/g,"**").length>16){
            alert ('登录账号不能多于16个字符！');
            document.hbwlFormAjax.登录账号.focus();
            return false;
        }
        if (document.hbwlFormAjax.用户姓名.value==""){
            alert ('请输入用户姓名！');
            document.hbwlFormAjax.用户姓名.focus();
            return false;
        }
        if (document.hbwlFormAjax.用户姓名.value.replace(/[^\x00-\xff]/g,"**").length>16){
            alert ('登录账号不能多于16个字符！');
            document.hbwlFormAjax.用户姓名.focus();
            return false;
        }
        if (document.hbwlFormAjax.登录密码.value==""){
            alert ('登录密码不能为空！');
            document.hbwlFormAjax.登录密码.focus();
            return false;
        }
        if (document.hbwlFormAjax.登录密码.value!=document.getElementById("确认密码").value){
            alert ('两次密码不一致！');
            document.getElementById("确认密码").focus();
            return false;
        }
        if (IsMail(document.hbwlFormAjax.Email.value)!=true){
            alert ('电子邮箱格式不正确！');
            document.getElementById("Email").focus();
            return false;
        }
        return true;
    }
