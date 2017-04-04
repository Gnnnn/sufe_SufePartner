jQuery(document).ready(function($) { 
getqus()
function getqus(){
$.getJSON("re/publish.php?request=mypublish",function(data){
    console.log("well!")
        console.log(data)
        // console.log(data.length)
        for(i=0;i<data.length;i++){
                // console.log(data[i].qusinfo)
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                var time = ".time"+(i+1)
                // var loca = ".loca"+(i+1)
                var tel = ".tel"+(i+1)
                var status = ".status"+(i+1)
                var user = ".user"+(i+1)
                var suc = ".success"+(i+1)
                var er = ".error"+(i+1)
                var isCombutton = ".isCombutton"+(i+1)
                // console.log(time)
                // console.log(data[i].qustime)
                $(info).text(data[i].qusinfo)
                $(title).text(data[i].qustitle)
                $(time).text(data[i].qustime)
                // $(loca).text(data[i].qusloca)
                $(tel).text(data[i].qustel)
                $(user).text(data[i].username)
                if(data[i].over == 1){
                $(status).text("结束")//应该是已结束，但是三个字自动变两行，很丑。小晋来做
                }
                else{
                $(status).text("正在")//应该是正在进行，但是四个字自动变两行，很丑。小晋来做
                $(isCombutton).removeClass("hide")
                $(isCombutton).show()
                if(data[i].qustel){
                    console.log(data[i].qustel)
                   $(suc).removeClass("hide")
                    $(er).removeClass("hide")
                    $(suc).show()
                    $(er).show() 
                }
                else{
                    console.log(data[i].qustel)
                    $(er).removeClass("hide")
                    $(er).show()
                }
                }
        }
    })
}

$(".success1").click(function(){
//完成交易，积分交易
    var pos = 1
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskS",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已完成交易！")
            }
            else{
                alert("交易失败.")
            }
            window.location.reload();

            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})


$(".error1").click(function(){
   //完成交易但积分不交易 
   console.log("stop!")
   var pos = 1
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskE",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已删除！")
            }
            else{
                alert("删除失败.")
            }
            window.location.reload();
            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})

$(".success2").click(function(){
//完成交易，积分交易
    var pos = 2
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskS",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已完成交易！")
            }
            else{
                alert("交易失败.")
            }
            window.location.reload();
            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})


$(".error2").click(function(){
   //完成交易但积分不交易 
   var pos = 2
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskE",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已删除！")
            }
            else{
                alert("删除失败.")
            }
            window.location.reload();
            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})
$(".success3").click(function(){
//完成交易，积分交易
    var pos = 3
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskS",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已完成交易！")
            }
            else{
                alert("交易失败.")
            }
            window.location.reload();

            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})


$(".error3").click(function(){
   //完成交易但积分不交易 
   var pos = 3
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskE",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已删除！")
            }
            else{
                alert("删除失败.")
            }
            window.location.reload();
            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})
$(".success4").click(function(){
//完成交易，积分交易
    var pos = 4
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskS",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已完成交易！")
            }
            else{
                alert("交易失败.")
            }
            window.location.reload();

            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})


$(".error4").click(function(){
   //完成交易但积分不交易 
   var pos = 4
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=competeTaskE",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            if(result.isUpdate == 1){
                alert("已删除！")
            }
            else{
                alert("删除失败.")
            }
            window.location.reload();
            // self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})


})