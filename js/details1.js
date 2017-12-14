jQuery(document).ready(function($) { 
getdetails()

$('.acceptnow').click(function(){ 
    $.ajax({
        url:"re/publish.php?request=accept",
        dataType:"json",
        type:"post",
        aysnc:false,
        data:{
        },
        success:function(result){
            console.log(result)
            if(result.success==1){
                console.log("SUCCESS")
                alert("接受成功")
                self.locaton='myrec.html';
            }
            else{
                console.log("ERROR")
            }
        },
        error:function(result){
            console.log(result)
            console.log("error")
          }
      })
})

})

function getdetails(){
$.getJSON("re/publish.php?request=viewdetails",function(data){
        console.log(data)
        if(data.isLogin == 0){
            self.location='index.html'
        }
        $(".qusinfo").text(data.qusinfo)
        $(".qustitle").text(data.qustitle)
        $(".qusloca").text(data.qusloca)
        $(".qustel").text(data.qustel)
        $(".username").text(data.username)
        $(".qustime").text(data.qustime)
        $(".pic").attr('src',data.pic);

    })
}