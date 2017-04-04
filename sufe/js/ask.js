jQuery(document).ready(function($) { 
getqus()
getbest()
function getqus(){
$.getJSON("re/publish2.php?request=view",function(data){
        console.log(data)
        //随机显示
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
        $(".helper").text(data.helper)
        $(".ansnum").text(data.count)
    })
}

})