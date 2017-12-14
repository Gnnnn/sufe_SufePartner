jQuery(document).ready(function($) { 
getqus()
getans()
function getqus(){
$.getJSON("re/publish2.php?request=qusview",function(data){
        console.log(data)
        //随机显示
        if(data.isLogin == 0){
            self.location='index.html'
        }
        for (var i = 0; i <= data.length; i++) {
        $(".info").text(data[i].details)
        $(".title").text(data[i].title)
        $(".user").text(data[i].username)
        // $("ans").text(data[i].helpernum)
        $(".time").text(data[i].time)
        $(".pic11").attr('src',data[i].pic);
        if (data[i].picurl == null ) {}
        else{
        $(".pic").attr('src',data[i].picurl);}
        }
        
    })
}

function getans(){
$.getJSON("re/publish2.php?request=ansview",function(data){
        console.log(data)
        //随机显示
        for(i=0;i<data.length;i++){
            var div = ".div" + (i+1)
            var user = ".user" + (i+1)
            var pic = ".pic" + (i+1)
            var ans = ".ans" + (i+1)
            $(div).removeClass("hide")
            $(div).show()
            $(user).text(data[i].helper)
            $(ans).text(data[i].ans)
            $(pic).attr('src',data[i].pic);
        }
        
    })
}

$(".myans").click(function(){
    // console.log("yes i clicked!")
    $myanswer = $('.myanswer').val()
    $.ajax({
        url:'re/publish2.php?request=myans',
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            myans:$myanswer
        },
        success:function(result){
            console.log($myanswer)
            console.log(result)
            alert("答案已发布成功")
            window.location.reload();
        },
        error:function(result){
            console.log("error")
        }
      })
})

})