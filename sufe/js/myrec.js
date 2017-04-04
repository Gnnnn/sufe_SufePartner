jQuery(document).ready(function($) { 
getqus()
function getqus(){
$.getJSON("re/publish.php?request=myrec",function(data){
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
                var loca = ".loca"+(i+1)
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
                // console.log(data[i].qusloca)
                // console.log(loca)
                $(loca).text(data[i].qusloca)
                $(tel).text(data[i].qustel)
                $(user).text(data[i].username)
                if(data[i].over == 1){
                $(status).text("结束")//应该是已结束，但是三个字自动变两行，很丑。小晋来做
                }
                else{
                $(status).text("正在")//应该是正在进行，但是三个字自动变两行，很丑。小晋来做
                }
        }
    })
}

})