jQuery(document).ready(function($) { 
getqus()
function getqus(){
$.getJSON("re/publish2.php?request=myqus",function(data){
        console.log(data) 
        if(data.isLogin == 0){
            self.location='index.html'
        }
        for(i=0;i<data.length;i++){
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                var time = ".time"+(i+1)
                var username = ".user"+(i+1)
                var pic = ".pic"+(i+1)
                // console.log(info)
                $(info).text(data[i].details)
                $(title).text(data[i].title)
                $(time).text(data[i].time)
                $(username).text(data[i].username)
                $(pic).attr('src',data[i].pic);
                
        }
    })
}
$('.ac1').click(function(){ 
    var pos = 1
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    // console.log(txt)
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
$('.ac2').click(function(){ 
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
}),
$('.ac3').click(function(){ 
    var pos = 3
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
}),
$('.ac4').click(function(){ 
    var pos = 4
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
}),
$('.ac5').click(function(){ 
    var pos = 5
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
}),
$('.ac6').click(function(){ 
    var pos = 6
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
}),
$('.ac7').click(function(){ 
    var pos = 7
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
}),
$('.ac8').click(function(){ 
    var pos = 8
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
}),
$('.ac9').click(function(){ 
    var pos = 9
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
}),
$('.ac10').click(function(){ 
    var pos = 10
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