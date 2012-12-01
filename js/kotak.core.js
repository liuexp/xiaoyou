
/*****************************************************	
文件：kotak.core.js
作者：flyby
信箱：fanhuayi@163.com
日期：2009-04-27
******************************************************/

function $(objId) {
    try {
        return document.getElementById(objId);
    } catch (e) {
        alert(e.name + ":" + e.message);
        return false;
    }
}

function $V(objId) {
    try {
        return document.getElementById(objId).value;
    } catch (e) {
        alert(e.name + ":" + e.message);
        return false;
    }
}

function toHtml(sText) {
    sText = sText.replace(/\r\n/g, '<br>')
    sText = sText.replace(/[ ]/g, "&nbsp;")
    return sText
}
function isSpace(strMain) {
    var strComp = strMain
    try {
        if (strComp == "　" || strComp == "" || strComp == " " || strComp == null || strComp.length == 0 || typeof strMain == "undefined" || strMain == "undefined") {
            return true
        } else {
            return false
        }
    } catch (e) { return false }
}

function openPage(url, title, params) {
    if (isSpace(title)) {
        title = '';
    }
    var scroll = (params.scroll) ? params.scroll : 'yes';
    var status = (params.status) ? params.status : 'yes';
    var menubar = (params.menubar) ? params.menubar : 'yes';
    var resizable = (params.resizable) ? params.resizable : 'yes';

    var width = (params.width) ? params.width : window.screen.availWidth;
    var height = (params.height) ? params.height : window.screen.availHeight;
    var frm = window.open(url, title, "scrollbars=" + scroll + ", status=" + status + ", menubar=" + menubar + " ,resizable=" + resizable + ",width=" + width + ",height=" + height + ",left=" + (window.screen.availWidth - width) / 2 + ",top=" + (window.screen.availHeight - height) / 2);
    frm.focus();
}

function windowMaximize() {
    top.moveTo(0, 0);
    top.resizeTo(screen.availWidth,screen.availHeight);
}

function fullScreen() {
    try{
        var wsh = new ActiveXObject("WScript.Shell");
        wsh.SendKeys("^{F11}");
        window.status = 'no';
    }
    catch(e)
    {
        alert('请修改AxtiveX的安全设置！或者直接按“F11”键。');
        return false;
    }
}


String.prototype.trim = function() {
    return this.replace(/(^s*)|(\s*$)/g, "");
}
String.prototype.trimLeft = function() {
    return this.replace(/(^s*)/g, "");
}
String.prototype.trimLeft0 = function() {
    return this.replace(/(^0*)/g, "");
}
String.prototype.trimRight = function() {
    return this.replace(/(\s*)/g, "");
}

String.prototype.pedLeft = function(chr, len) {
    var headStr = "";
    var srcStr = this;
    if (srcStr.length < len) {
        for (var i = 0; i < len - srcStr.length; i++) {
            headStr += fillChr;
        }
    }
    return headStr + srcStr;
}

var StringBuilder = function() {
    this._buffer = [];
    this._arg1 = "";
    this._arg2 = "";
    if (arguments.length > 0) this._arg1 = String(arguments[0]);
    if (arguments.length > 1) this._arg2 = String(arguments[1]);
}
StringBuilder.prototype.append = function(str) {
    this._buffer[this._buffer.length] = String(str);
}
StringBuilder.prototype.toString = function() {
    return (this._arg2 ? this._arg1 : "") + this._buffer.join(this._arg2 + this._arg1) + this._arg2;
}
StringBuilder.prototype.clear = function() {
    this._buffer = [];
}
StringBuilder.prototype.add = StringBuilder.prototype.append;


//显示一个Web部件
function showPart(partId) {
    var partObj = $(partId);
    if (partObj) {
        partObj.style.display = "block";
    }
}
//隐藏一个Web部件
function hidePart(partId) {
    var partObj = $(partId);
    if (partObj) {
        partObj.style.display = "none";
    }
}

//切换显示一个Web部件
function togglePart(partId) {
    var partObj = $(partId);
    if (partObj) {
        if (partObj.style.display == "none") {
            partObj.style.display = "block";
        } else {
            partObj.style.display = "none";
        }
    }
}

function toggleClass(obj) {
    obj.className = (obj.className == 'uparrow') ? 'downarrow' : 'uparrow';
    obj.setAttribute('class', (obj.className == 'uparrow') ? 'downarrow' : 'uparrow');
}

function toggleArrow(obj) {
    var src = obj.src;
    if (src.indexOf('left') > 0) {
        src = src.replace('left', 'down');
    } else {
        src = src.replace('down', 'left');
    }
    
    obj.src = src;
    obj.setAttribute('src', src);
}
//清除一个Web部件
function clearPart(partId) {
    var partObj = $(partId);
    if (partObj) {
        partObj.innerHTML = '';
        partObj.style.display = "none";
    }
}

//缩放字体大小
function doZoom(objId, sizePx) {
    $(objId).style.fontSize = sizePx + 'px';
}

//设定Cookie值
function SetCookie(name, value){
    var expdate = new Date();
    var argv = SetCookie.arguments;
    var argc = SetCookie.arguments.length;
    var expires = (argc > 2) ? argv[2] : null;
    var path = (argc > 3) ? argv[3] : null;
    var domain = (argc > 4) ? argv[4] : null;
    var secure = (argc > 5) ? argv[5] : false;
    if (expires != null) expdate.setTime(expdate.getTime() + (expires * 1000));
    document.cookie = name + "=" + escape(value) + ((expires == null) ? "" : ("; expires=" + expdate.toGMTString()))
+ ((path == null) ? "" : ("; path=" + path)) + ((domain == null) ? "" : ("; domain=" + domain))
+ ((secure == true) ? "; secure" : "");
}

//删除Cookie
function DelCookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = GetCookie(name);
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}

//获得Cookie的原始值
function GetCookie(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) == arg)
            return GetCookieVal(j);
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0) break;
    }
    return null;
}
//获得Cookie解码后的值
function GetCookieVal(offset) {
    var endstr = document.cookie.indexOf(";", offset);
    if (endstr == -1)
        endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
}





