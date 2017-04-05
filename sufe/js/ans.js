jQuery(document).ready(function($) { 
getqus()
// getbest()
function getqus(){
$.getJSON("re/publish2.php?request=ansview",function(data){
        console.log(data)
        //随机显示
        $(info).text(data[i].details)
        $(title).text(data[i].title)
        $(username).text(data[i].username)
        $(ans).text(data[i].helpernum)
        $(time).text(data[i].time)
        if (data[i].picurl == null ) {}
        else{
        $(pic).attr('src',data[i].picurl);}
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