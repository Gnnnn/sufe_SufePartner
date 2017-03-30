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
                // self.location='takenlist.html';
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
        $(".qusinfo").text(data.qusinfo)
        $(".qustitle").text(data.qustitle)
        $(".qusloca").text(data.qusloca)
        $(".qustel").text(data.qustel)
        $(".username").text(data.username)
        $(".qustime").text(data.qustime)
    })
}