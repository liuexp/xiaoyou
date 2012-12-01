/*****************************************************
	
文件：kotak.autocoder.business.js
描述：业务脚本库
引用：kotak.core.js

作者：flyby
信箱：fanhuayi@163.com
日期：2009-06-11
******************************************************/


//检测信息表单
function checkArticleForm() {
    if ($('HdnContent')) {
        var oEditor = FCKeditorAPI.GetInstance('HdnContentHTML');
        $('HdnContent').value = oEditor.GetXHTML(true);
    }
    if ($('TxtTitle').value == '') {
        alert('标题必填！');
        $('TxtTitle').focus();
        return false;
    }
    return true;
}

//检测教师表单
function checkTeacherForm() {
    if ($('HdnIntro')) {
        var oEditor = FCKeditorAPI.GetInstance('HdnIntroHTML');
        $('HdnIntro').value = oEditor.GetXHTML(true);        
    }   
    if ($('TxtTeacherType').value == '') {
        alert('教师类型必填！');
        return false;
    }
    if ($('TxtOrderNum').value == '') {
        alert('排序必填！');
        return false;
    }
    return true;
}

function checkPaperForm() {
    if ($('HdnContent')) {
        var oEditor = FCKeditorAPI.GetInstance('HdnContentHTML');
        $('HdnContent').value = oEditor.GetXHTML(true);
    }
    if ($('TxtTitle').value == '') {
        alert('标题必填！');
        $('TxtTitle').focus();
        return false;
    }
    return true;
}

//全文检索
function doSearch() {
    if ($('TxtKeyword').value == '') {
        alert('请输入关键字！');
        $('TxtKeyword').focus();
        return false;
    }
    var condString = $('TxtKeyword').value + '|1||';
    window.location = encodeURI("/WebSite/Search.aspx?cond=" + AjaxHelper.Encrypt(condString).value);
}

//全文检索1
function doSearch1() {
    if ($('TxtKeyword1').value == '') {
        alert('请输入关键字！');
        $('TxtKeyword').focus();
        return false;
    }
    var condString = $('TxtKeyword1').value + '|1|' + $('TxtBenginDate1').value + '|' + $('TxtEndDate1').value;
    window.location = encodeURI("/WebSite/Search.aspx?cond=" + AjaxHelper.Encrypt(condString).value);
}

function showUserLog() {
    $('UserLogDiv').style.top = 40;
    $('UserLogDiv').style.left = 70 + (screen.width) / 2;
    $("signSpan").innerHTML = '';  
    togglePart("UserLogDiv");
}
function showUserPwd() {
    $('UserPwdDiv').style.top = 40;
    $('UserPwdDiv').style.left = 70 + (screen.width) / 2;
    $("signSpan").innerHTML = '';
    togglePart("UserPwdDiv");
}
function clearUserForm() {    
    $("TxtUserId").value = '';
    $("TxtPassword").value ='';
}
function execUserLogin() {
    var userlogInfo = AjaxHelper.WebUserLogin($("TxtUserId").value, $("TxtPassword").value).value;
    if (userlogInfo == "1") {
        window.location.reload();
    } else {
        $("signSpan").innerHTML = '登录失败！';
    }
}
function execUserLogout() {
    var userlogInfo = AjaxHelper.WebUserLogout().value;
    window.location.reload();
}
function execUserSetPwd() {
    if ($("TxtNewPwd").value != $("TxtResPwd").value) {
        $("signSpan").innerHTML = '两次输入不一致！';
        return false;
    }
    var userSet = AjaxHelper.WebUserSetpwd($("TxtOldPwd").value, $("TxtNewPwd").value).value;
    if (userSet == "1") {
        $("signSpan").innerHTML = '密码修改成功！';
    } else {
        $("signSpan").innerHTML = '原密码输入错误！';
    }
}
function clearPassForm() {
    $("TxtOldPwd").value = '';
    $("TxtNewPwd").value = '';
    $("TxtResPwd").value = ''; 
}