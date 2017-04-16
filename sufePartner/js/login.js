jQuery(document).ready(function($) { 
getbutton()
function getbutton(){
    $.getJSON("re/publish.php?request=islogin",function(data){
            console.log(data)
        if(data.islogin == 1){
            $(".main_nav").hide()
            $(".myname").text(data.name)
        }
    })
}
	$(".login_button").click(function(){
        console.log($(".username").val())
        console.log($(".password").val())
		$.ajax({
            url:'re/login.php?request=login',
            dataType:"html",
            type:"post",
            aysnc:false,
            data:{
                username:$(".username").val(),
                password:$(".password").val()
            },
            success:function(result){
                console.log(result)
                // $(".login_button").hide()
                self.location='index.html'
            }
          })
	})
	$(".register_button").click(function(){
		$.ajax({
            url:'re/login.php?request=register',
            dataType:"json",
            type:"post",
            aysnc:false,
            data:{
                username:$(".usernameg").val(),
                password:$(".passwordg").val(),
                tel:$(".telg").val()

            },
            success:function(result){
                console.log(result)
            }
          })
	})
})