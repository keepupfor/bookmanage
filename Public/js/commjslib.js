/*
 常用JS方法
 Yinlu 整理收集@2015
 function obj$(id)                      根据id得到对象
 function val$(id)                      根据id得到对象的值
 function trim(str)                     删除左边和右边空格
 function ltrim(str)					   删除左边空格
 function rtrim (str)                   删除右边空格
 function isEmpty(str)                  字符串串是否有值
 function equals(str1, str2)            js判断比较两字符串是否相等
 function equalsIgnoreCase(str1, str2)  js判断忽略大小写比较两个字符串是否相等
 function isChinese(str)                js判断判断是否中文
 function isEmail(strEmail)             js判断是否电子邮件
 function isImg(str)                    js判断是否是一个图片格式的文件jpg|jpeg|swf|gif
 function isInteger(str)                js判断是否是一个整数
 function isFloat                       js判断是否是一个浮点数
 function isPost(str)                   js判断是否邮编(1位至6位
 function isMobile(str)                 js判断是否是手机号
 function isPhone(str)                  js判断是否是电话号码必须包含区号,可以含有分机号
 function isQQ(str)                     js判断是否合法的QQ号码
 function isIP(str)                     js判断是否是合法的IP
 function isDate(str)                   js判断是否日期类型(例:2005-12-12)
 function isIdCardNo(idNumber)          js判断是否是合法的身份证号
 function isMoney(str)					js判断是否是合法的金额
 function getNowTimeString()				获取当前的时间
 function getNowDateString()				获取当前日期
 function getWeekString(_date)			获取日期是星期几
 function toDateAdd(dd,dadd)				时间加减；var datestr=dateadd("2013-4-11",2)
 function toIEDate(str)					兼容IE的时间转换
 function getRequest(paras)				获取浏览器的请求参数 如test.html?id=1111;urlRequest("id")
 function checkInputMaxLen(max,which,callbackfunction) 最大输入字符的检测，并回调 checkInputMaxLen("100",this,function(){})
 function getDateDiffNote(datetime)		计算一个日期字符串与当前日期相差值说明
 function getSubString(str,len,types)	截取字符串
 function stripHtmlTags(str)				去除html标签
 function isMAC(mac)						是否为mac地址
 function getStrLength(str)				获取字符串设计长度（支持中英文）
 function getDateDiff(d1,d2)				时间差；var datestr=DateDiff("2013-4-11","2013-4-20")
 function getTimeDiff(d1,d2,flag)		时间差；var datestr=DateDiff("2013-4-11","2013-4-20","d")
 function isEnglish(val)					是否为英文
 */
function isEnglish(val)
{
    if(val.match(/[a-z]/g)==null&&val.match(/[A-Z]/g)==null)
    {
        return false;
    }

    return true;
}
function getTimeDiff(d1,d2,flag)//时间差；var datestr=DateDiff("2013-4-11","2013-4-20","d")
{
    switch (flag) {
        case "ms":
            msCount = 1;
            break;
        case "s":
            msCount = 1000;
            break;
        case "m":
            msCount = 60 * 1000;
            break;
        case "h":
            msCount = 60 * 60 * 1000;
            break;
        case "d":
            msCount = 24 * 60 * 60 * 1000;
            break;
    }

    try
    {
        var diff = d1.getTime() - d2.getTime();
        alert('diff='+diff);
        var cha = Math.floor(diff / msCount);
        return cha;
    }
    catch(e)
    {
        return false;
    }
}
function getDateDiff(d1,d2)
{
    var day = 24 * 60 * 60 * 1000;
    try
    {
        var dateArr = d1.split("-");
        var checkDate = new Date();
        checkDate.setFullYear(dateArr[0], dateArr[1]-1, dateArr[2]);
        var checkTime = checkDate.getTime();
        var dateArr2 = d2.split("-");
        var checkDate2 = new Date();
        checkDate2.setFullYear(dateArr2[0], dateArr2[1]-1, dateArr2[2]);
        var checkTime2 = checkDate2.getTime();
        var cha = (checkTime - checkTime2)/day;
        return cha;
    }
    catch(e)
    {
        return false;
    }
}
function getStrLength(str){
    var realLength = 0, len = str.length, charCode = -1;
    for (var i = 0; i < len; i++) {
        charCode = str.charCodeAt(i);
        if (charCode >= 0 && charCode <= 128)
            realLength += 1;
        else
            realLength += 2;
    }
    return realLength;
};

function isMAC(mac){
    var temp = /[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}/;
    return mac.match(temp) == null ? false : true;
}
function stripHtmlTags(str){
    return str.toString().replace(/<[^>]+>/g,"");
}
function getSubString(str,len,types)
{
    var retstr=str;
    if (str.length>len)
    {
        if (types==0)
        {
            retstr=retstr.substr(0,len);
        }
        else
        {
            retstr=retstr.substr(0,len-3)+'...';
        }

    }
    return retstr;
}

function GetDateDiff(datetime)
{
// 可以将2012 - 12 - 12 12 : 12 : 12字符串转为JS中的时期对象,
// 因为默认情况下只把持2000 / 05 / 05这样形式的字符串转为时间对象
    var dateBegin = new Date(datetime.replace(/-/g, "/"));
    var dateEnd = new Date();
    var dateDiff = dateEnd.getTime() - dateBegin.getTime();
// 计算相差的天数
    var dayDiff = Math.floor(dateDiff / (24 * 3600 * 1000));//计算相差的天数
    var hourleft = Math.floor(dateDiff / (3600 * 1000)); //计算相差的小时数
    var minuteleft = Math.floor(dateDiff / (60 * 1000)); //计算相差的分钟数
    var returnstr = "";
    if(dayDiff > 5) //前天以前就直接返回时间字符串
    {
        return datetime;
    }
    else if (hourleft>=24)
    {
        returnstr += dayDiff+"天前 ";
    }
    else if (hourleft>=1)
    {
        returnstr += hourleft+"小时前 ";
    }
    else if (minuteleft>=1)
    {
        returnstr += minuteleft+"分钟前 ";
    }
    else
    {
        if (Math.floor(dateDiff / 1000)<0)
        {
            returnstr += "1秒前 ";
        }
        else
        {
            returnstr += Math.floor(dateDiff / 1000) +"秒前 ";
        }
    }
    return returnstr;
}
function checkInputMaxLen(max,which,callbackfunction) {
    var maxChars = max;
    if (which.value.length > maxChars)
        which.value = which.value.substring(0,maxChars);
    var curr = maxChars - which.value.length;
    callbackfunction(curr);
}
function getRequest(paras)
{
    var url = location.href;
    var paraString = url.substring(url.indexOf("?")+1,url.length).split("&");
    var paraObj = {}
    for (i=0; j=paraString[i]; i++){
        paraObj[j.substring(0,j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=")+1,j.length);
    }
    var returnValue = paraObj[paras.toLowerCase()];
    if(typeof(returnValue)=="undefined"){
        return "";
    }else{
        return returnValue;
    }
}
function toIEDate(str) {
    if(str==null)
        return false;
    str = str.split('-');
    var date = new Date();
    date.setFullYear(str[0]);
    date.setMonth(str[1]-1); //js 月从0开始
    date.setDate(str[2]);
    date.setHours(0);
    date.setMinutes(0);
    date.setSeconds(0);
    return date;
}
function toDateAdd(dd,dadd)
{
//可以加上错误处理
    try
    {
        var inday = new Date(dd)
        inday = inday.valueOf()
        inday = inday + dadd * 24 * 60 * 60 * 1000
        inday = new Date(inday)
        var retday=inday.getFullYear()+"/"+(inday.getMonth() + 1)+"/"+inday.getDate()
        return retday;
    }
    catch(e)
    {
        return false;
    }
}
function getWeekString(_date)
{
    var d = new Date(Date.parse(_date.replace(/-/g, "/")));
    var weekDay=d.getDay();
    if (weekDay=="0")
    {
        return "周日";
    }
    else if (weekDay=="1")
    {
        return "周一";
    }
    else if (weekDay=="2")
    {
        return "周二";
    }
    else if (weekDay=="3")
    {
        return "周三";
    }
    else if (weekDay=="4")
    {
        return "周四";
    }
    else if (weekDay=="5")
    {
        return "周五";
    }
    else if (weekDay=="6")
    {
        return "周六";
    }
}
function getNowDateString()
{
    var d = new Date();
    var vYear = d.getFullYear();
    var vMon = d.getMonth() + 1;
    var vDay = d.getDate();
    s=vYear+'-'+(vMon<10 ? "0" + vMon : vMon)+'-'+(vDay<10 ? "0"+ vDay : vDay);
    return s;
}
function getNowTimeString()
{
    var d = new Date();
    var vYear = d.getFullYear();
    var vMon = d.getMonth() + 1;
    var vDay = d.getDate();
    var h = d.getHours();
    var m = d.getMinutes();
    var se = d.getSeconds();
    s=vYear+"-"+(vMon<10 ? "0" + vMon : vMon)+'-'+(vDay<10 ? "0"+ vDay : vDay)+' '+(h<10 ? "0"+ h : h)+':'+(m<10 ? "0" + m : m)+':'+(se<10 ? "0" +se : se);
    return s;
}
function obj$(id)
{
    return document.getElementByIdx(id);
}
function val$(id)
{
    var obj = document.getElementByIdx(id);
    if(obj !== null)
    {
        return obj.value;
    }
    return null;
}
function trim(str)
{
    return str.replace(/(^\s*)|(\s*$)/g, '');
}
function ltrim(str)
{
    return str.replace(/^\s*/g,'');
}
function rtrim(str)
{
    return str.replace(/\s*$/,'');
}
function isEmpty(str)
{
    if(str != null && str.length > 0)
    {
        return true;
    }
    return false;
}
function equals(str1, str2)
{
    if(str1 == str2)
    {
        return true;
    }
    return false;
}
function equalsIgnoreCase(str1, str2)
{
    if(str1.toUpperCase() == str2.toUpperCase())
    {
        return true;
    }
    return false;
}
function isChinese(str)
{
    var str = str.replace(/(^\s*)|(\s*$)/g,'');
    if (!(/^[\u4E00-\uFA29]*$/.test(str)
        && (!/^[\uE7C7-\uE7F3]*$/.test(str))))
    {
        return false;
    }
    return true;
}
function isEmail(str)
{
    if(/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/.test(str))
    {
        return true
    }
    return false;
}
function isImg(str)
{
    var objReg = new RegExp("[.]+(jpg|jpeg|swf|gif)$", "gi");
    if(objReg.test(str))
    {
        return true;
    }
    return false;
}
function isInteger(str)
{
    if(/^-?\d+$/.test(str))
    {
        return true;
    }
    return false;
}
function isFloat(str)
{
    if(/^(-?\d+)(\.\d+)?$/.test(str))
    {
        return true;
    }
    return false;
}
function isPostCode(str)
{
    if(/^\d{1,6}$/.test(str))
    {
        return true;
    }
    return false;
}
function isMobile(str)
{
    if(/^1[34578]\d{9}/.test(str))
    {
        return true;
    }
    return false;
}
function isPhone(str)
{
    if(/^(0[1-9]\d{1,2}-)\d{7,8}(-\d{1,8})?/.test(str))
    {
        return true;
    }
    return false;
}
function isQQ(str){
    if(/^\d{5,9}$/.test(str))
    {
        return true;
    }
    return false;
}
function isIP(str){
    var reg = /^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/;
    if(reg.test(str))
    {
        return true;
    }
    return false;
}
function isDate(str)
{
    var reg = /^((((1[6-9]|[2-9]\d)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))$/;
    if(reg.test(str))
    {
        return true;
    }
    return false;
}
function isIdCardNo(idNumber)
{
    var factorArr = new Array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2,1);
    var varArray = new Array();
    var lngProduct = 0;
    var intCheckDigit;
    //var idNumber.length = ;

    if ((idNumber.length != 15) && (idNumber.length != 18))
    {
        return false;
    }
    for(i=0;i<idNumber.length;i++)
    {
        varArray[i] = idNumber.charAt(i);
        if ((varArray[i] < '0' || varArray[i] > '9') && (i != 17))
        {
            return false;
        }
        else if (i < 17)
        {
            varArray[i] = varArray[i]*factorArr[i];
        }
    }
    if (idNumber.length == 18)
    {
        var date8 = idNumber.substring(6,14);
        if (checkDate(date8) == false)
        {
            return false;
        }
        for(i=0;i<17;i++)
        {
            lngProduct = lngProduct + varArray[i];
        }
        intCheckDigit = 12 - lngProduct % 11;
        switch (intCheckDigit)
        {
            case 10:
                intCheckDigit = 'X';
                break;
            case 11:
                intCheckDigit = 0;
                break;
            case 12:
                intCheckDigit = 1;
                break;
        }
        if (varArray[17].toUpperCase() != intCheckDigit)
        {
            return false;
        }
    }
    else
    {
        var date6 = idNumber.substring(6,12);
        if (checkDate(date6) == false)
        {
            return false;
        }
    }
    return true;
}
function isMoney(v)
{
    if(v=="")return false;
    var a=/^[0-9]*(\.[0-9]{1,2})?$/;
    if(!a.test(v))
    {
        return false;
    }
    else
    {
        return true;
    }
}
function AjaxPost(_url,_parame,_callback)
{
    $.post(_url, _parame, _callback, "json");
}
/*分页*/
//直接输入要插入的对象，形成样式
//_page:当前页数
//_size:每页显示数
//_sum:数据总和
//_obj:要插入的对象
//_callbackfunction:回调的函数名称 _callbackfunction(page,size)
function splitPager(_page,_size,_sum,_obj,_callbackfunction)
{
    var _indexpage;
    var _prepage;
    var _nextpage;
    var _endpage;
    _sum=parseInt(_sum);
    _page=parseInt(_page);
    _size=parseInt(_size);
    if (_sum > _size) {
        if (_sum % _size == 0) {
            _sumpage = _sum	/ _size;
        } else {
            _sumpage = _sum / _size + 1;
        }
    } else {
        _sumpage = 1;
    }
    _sumpage = parseInt(_sumpage, 10);
    _page = parseInt(_page);
    if (_page < 1) {
        _page = 1;
    }
    if (_page > _sumpage) {
        _page = _sumpage
    }
    if(_page>1)
        _prepage=_page-1;
    else
        _prepage=_page;
    if(_page==_sumpage)
        _nextpage=_sumpage;
    else
        _nextpage=_page+1;

    _indexpage=1;
    _endpage=_sumpage;

    var pagestr=_indexpage+":"+_prepage+":"+_nextpage+":"+_endpage+":"+_sumpage;
    var pagelistarr=pagestr.split(":"); //字符分割
    //pagelistarr[0]  首页;    //pagelistarr[1]  上页;    //pagelistarr[2]  下页;    //pagelistarr[3]  尾页;    //pagelistarr[4]  总页数;
    var footpagerhtml=' <div class="tj-1Page">';
    /*footpagerhtml+='记录总数：'+_sum+'条 当前：'+_page+'/'+pagelistarr[4]+' 页 <a href="javascript:'+_callbackfunction+'(\''+pagelistarr[0]+'\',\''+_size+'\');">&nbsp;首页&nbsp;</a>|<a href="javascript:'+_callbackfunction+'(\''+pagelistarr[1]+'\',\''+_size+'\');">&nbsp;上页&nbsp;</a>|<a href="javascript:'+_callbackfunction+'(\''+pagelistarr[2]+'\',\''+_size+'\');">&nbsp;下页&nbsp;</a>|<a href="javascript:'+_callbackfunction+'(\''+pagelistarr[3]+'\',\''+_size+'\');">&nbsp;尾页</a></div>';*/
    footpagerhtml+='记录总数：'+_sum+'条 当前：'+_page+'/'+pagelistarr[4]+' 页 ';
    if (_page==1)
    {
        footpagerhtml+='&nbsp;首页&nbsp;|&nbsp;上页&nbsp;|';
    }
    else
    {
        footpagerhtml+='<a href="javascript:void(0);" onclick="'+_callbackfunction+'(\''+pagelistarr[0]+'\',\''+_size+'\');">&nbsp;首页&nbsp;</a>|<a href="javascript:void(0);" onclick="'+_callbackfunction+'(\''+pagelistarr[1]+'\',\''+_size+'\');">&nbsp;上页&nbsp;</a>|';
    }
    if (_page==pagelistarr[4])
    {
        footpagerhtml+='&nbsp;下页&nbsp;|&nbsp;尾页&nbsp;';
    }
    else
    {
        footpagerhtml+='<a href="javascript:void(0);" onclick="'+_callbackfunction+'(\''+pagelistarr[2]+'\',\''+_size+'\');">&nbsp;下页&nbsp;</a>|<a href="javascript:void(0);" onclick="'+_callbackfunction+'(\''+pagelistarr[3]+'\',\''+_size+'\');">&nbsp;尾页</a></div>';
    }
    document.getElementById(_obj).innerHTML="";
    document.getElementById(_obj).innerHTML=footpagerhtml;

}
/*分页*/
//分页计算
//_page:当前页数
//_size:每页显示数
//_sum:数据总和
function splitPagerArray(_page,_size,_sum)
{
    var _indexpage;
    var _prepage;
    var _nextpage;
    var _endpage;
    _sum=parseInt(_sum);
    _page=parseInt(_page);
    _size=parseInt(_size);
    if (_sum > _size) {
        if (_sum % _size == 0) {
            _sumpage = _sum	/ _size;
        } else {
            _sumpage = _sum / _size + 1;
        }
    } else {
        _sumpage = 1;
    }
    _sumpage = parseInt(_sumpage, 10);
    _page = parseInt(_page);
    if (_page < 1) {
        _page = 1;
    }
    if (_page > _sumpage) {
        _page = _sumpage
    }
    if(_page>1)
        _prepage=_page-1;
    else
        _prepage=_page;
    if(_page==_sumpage)
        _nextpage=_sumpage;
    else
        _nextpage=_page+1;

    _indexpage=1;
    _endpage=_sumpage;

    var pagestr=_indexpage+":"+_prepage+":"+_nextpage+":"+_endpage+":"+_sumpage+":"+_sum;
    var pagelistarr=pagestr.split(":"); //字符分割
    //pagelistarr[0]=首页
    //pagelistarr[1]=上一页
    //pagelistarr[2]=下一页
    //pagelistarr[3]=尾页
    //pagelistarr[4]=总页数
    //pagelistarr[5]=总记录数
    return pagelistarr;
}