jQuery(document).ready(function($) { 
getqus()
getbest()
function getqus(){
$.getJSON("re/publish2.php?request=view",function(data){
        console.log(data)
        //随机显示
        if(data.isLogin == 0){
            self.location='index.html'
        }
        for(i=data.length-1;i>=data.length-2 ;i--){
                var username = ".user" + (data.length-i)
                var info = ".info"+(data.length-i)
                var title = ".title"+(data.length-i)
                var ans = ".ans"+(data.length-i)
                var time = ".time"+(data.length-i)
                var pic = ".pic"+(data.length-i)
                // console.log("here")
                console.log(i)
                // console.log(title)
                // console.log(data[i].title)
                $(info).text(data[i].details)
                $(title).text(data[i].title)
                $(username).text(data[i].username)
                $(ans).text(data[i].helpernum)
                $(time).text(data[i].time)
                if (data[i].picurl == null ) {}
                else{
                $(pic).attr('src',data[i].picurl);
                	}
        }
    })
}

function getbest(){
$.getJSON("re/publish2.php?request=besthelper",function(data){
        console.log(data)
        $(".besthelper").attr('src',data.pic);
        $(".helper").text(data.helper)
        $(".ansnum").text(data.count)
    })
}

$('.pic1').click(function(){ 
    var pos = 1
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    //获取标题
    // console.log(txt)
    //使用ajax方法传标题，取名qustitle，成功的话跳转
    $.ajax({
        url:"re/publish2.php?request=goto2details",
        dataType:"html",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt
        },
        success:function(result){
            console.log(result)
            self.location='onequestion.html'
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),
$('.pic2').click(function(){ 
    var pos = 2
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    // console.log(txt)
    $.ajax({
        url:"re/publish2.php?request=goto2details",
        dataType:"html",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='onequestion.html'
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})
})