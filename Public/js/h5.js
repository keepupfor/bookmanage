/**
 * Created by netperson on 16/1/4.
 */
function myAlert(_content)
{
    var bgcolor='#666';
    var time=2;
    layer.open({
        content:_content,
        style: 'background-color:'+bgcolor+'; color:#fff; border:none;',
        time: time
    });
}

/*
    framekiller  屏蔽运营商广告 配合<style> html{display:none;} </style>使用
 */
(function(){
    if(self == top) {
        document.documentElement.style.display = 'block';
    } else {
        top.location = self.location;
    }
})();