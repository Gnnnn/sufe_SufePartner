jQuery(document).ready(function($) { 
getinfo()
function getinfo(){
$.getJSON("re/publish2.php?request=viewmyinfo",function(data){
        console.log(data)
        if(data.isLogin == 0){
            self.location='index.html'
        }
        $(".myname").text(data.username)
        $(".mygender").text(data.usergender)
        $(".mymail").text(data.usermail)
        $(".mytel").text(data.usertel)
        $(".mytag").text(data.usertag)
        $(".mypic").attr('src',data.userpic);
    })
}
$('.competed').click(function(){ 
    var obj=document.getElementsByName('inst'); 
    //选择所有name="'inst'"的对象，返回数组 
    //取到对象数组后，我们来循环检测它是不是被选中 
    var s=''; 
    for(var i=0; i<obj.length; i++){ 
    if(obj[i].checked) s+=obj[i].value+','; 
    //如果选中，将value添加到变量s中 
    }
    var value  = $('input[name="sex"]:checked').val(); 
    console.log(s)
    console.log(value)
    console.log($(".usertel").val())
    console.log($(".usermail").val())
    $.ajax({
            url:'re/publish2.php?request=myinfo',
            dataType:"html",
            type:"post",
            aysnc:false,
            data:{
                usertag:s,
                usergender:value,
                usertel:$(".usertel").val(),
                usermail:$(".usermail").val()
            },
            success:function(result){
                console.log(result)
                alert("已修改成功")
            self.location='myinfor.html'
            }
          })
}) 

})