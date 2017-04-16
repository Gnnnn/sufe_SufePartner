jQuery(document).ready(function($) { 
getqus()
function getqus(){
$.getJSON("re/publish.php?request=view",function(data){
        console.log(data)
        if(data.isLogin == 0){
            self.location='index.html'
        }
        // console.log(data.length)
        for(i=0;i<data.length;i++){
                // console.log(data[i].qusinfo)
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                var pic = ".pic"+(i+1)
                // console.log(info)
                $(info).text(data[i].qusinfo)
                $(title).text(data[i].qustitle)
                $(pic).attr('src',data[i].pic);
                
        }
    })
}

function gettimenow(){
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
            + " " + date.getHours() + seperator2 + date.getMinutes()
            + seperator2 + date.getSeconds();
    return currentdate;

}

$('.tpublish').click(function(){ 
    timee = gettimenow()
    $.ajax({
            url:'re/publish.php?request=tpublish',
            dataType:"json",
            type:"post",
            aysnc:false,
            data:{
                tag:$('.ttagselect option:selected') .val(),
                loca:$(".tloca").val(),
                title:$(".ttitle").val(),
                tel:$(".ttel").val(),
                info:$(".tinfo").val(),
                timee:timee
            },
            success:function(result){
                console.log(result)
                alert("题目已发布成功")
                window.location.reload();
            }
          })
}),

$('.math_view').click(function(){ 
    for(i=0;i<8;i++){
        var a = ".div" + (i+1)
        $(a).addClass("hide")
        $(a).hide()
    }

    $.getJSON("re/publish.php?request=math_view",function(data){
        console.log(data)
        console.log(data.length)
        for(i=0;i<data.length;i++){
                console.log(data[i].qusinfo)
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                console.log(info)
                $(info).text(data[i].qusinfo)
                $(title).text(data[i].qustitle)
        }
    })
}),

$('.english_view').click(function(){ 
    for(i=0;i<8;i++){
        var a = ".div" + (i+1)
        $(a).addClass("hide")
        $(a).hide()
    }
    $.getJSON("re/publish.php?request=english_view",function(data){
        console.log(data)
        console.log(data.length)
        for(i=0;i<data.length;i++){
                console.log(data[i].qusinfo)
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                console.log(info)
                $(info).text(data[i].qusinfo)
                $(title).text(data[i].qustitle)
        }
    })
}),

$('.specialized_view').click(function(){ 
    for(i=0;i<8;i++){
        var a = ".div" + (i+1)
        $(a).addClass("hide")
        $(a).hide()
    }
    $.getJSON("re/publish.php?request=specialized_view",function(data){
        console.log(data)
        console.log(data.length)
        for(i=0;i<data.length;i++){
                console.log(data[i].qusinfo)
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                console.log(info)
                $(info).text(data[i].qusinfo)
                $(title).text(data[i].qustitle)
        }
    })
}),

$('.language_view').click(function(){ 
    for(i=0;i<8;i++){
        var a = ".div" + (i+1)
        $(a).addClass("hide")
        $(a).hide()
    }
    $.getJSON("re/publish.php?request=language_view",function(data){
        console.log(data)
        // console.log(data.length)
        for(i=0;i<data.length;i++){
                console.log(data[i].qusinfo)
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                console.log(info)
                $(info).text(data[i].qusinfo)
                $(title).text(data[i].qustitle)
        }
    })
}),

$('.other_view').click(function(){ 
    for(i=0;i<8;i++){
        var a = ".div" + (i+1)
        $(a).addClass("hide")
        $(a).hide()
    }
    $.getJSON("re/publish.php?request=other_view",function(data){
        console.log(data)
        console.log(data.length)
        for(i=0;i<data.length;i++){
                console.log(data[i].qusinfo)
                var a = ".div" + (i+1)
                $(a).removeClass("hide")
                $(a).show()
                var info = ".info"+(i+1)
                var title = ".title"+(i+1)
                console.log(info)
                $(info).text(data[i].qusinfo)
                $(title).text(data[i].qustitle)
        }
    })
}),

$('.all_view').click(function(){ 
    for(i=0;i<8;i++){
        var a = ".div" + (i+1)
        $(a).addClass("hide")
        $(a).hide()
    }
    getqus()
}),

$('.accept1').click(function(){ 
    var pos = 1
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    // console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),

$('.accept2').click(function(){ 
    var pos = 2
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),
$('.accept3').click(function(){ 
    var pos = 3
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),
$('.accept4').click(function(){ 
    var pos = 4
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),
$('.accept5').click(function(){ 
    var pos = 5
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),
$('.accept6').click(function(){ 
    var pos = 6
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),
$('.accept7').click(function(){ 
    var pos = 7
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
}),
$('.accept8').click(function(){ 
    var pos = 8
    var a = "title"+pos
    var txt = document.getElementById(a).innerText; 
    console.log(txt)
    $.ajax({
        url:"re/publish.php?request=gotodetails",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
            qustitle:txt,
        },
        success:function(result){
            console.log(result)
            self.location='details.html'
            
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})

// $('.a11').click(function(){ 
//     var pos = 8
//     var a = "title"+pos
//     var txt = document.getElementById(a).innerText; 
//     console.log(txt)
//     $.ajax({
//         url:"re/publish.php?request=details",
//         dataType:"json",
//         type:"post",
//         aysnc:false,
//         data:{
//             qustitle:txt,
//         },
//         success:function(result){
//             console.log(result)
            
//         },
//         error:function(result){
//             console.log(result)
//             console.log("error")
//           }
//       })
// })




})
