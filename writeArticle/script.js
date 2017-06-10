/**
 * Created by Данил on 26.05.2017.
 */
function submitArticle(f) {
    var nameArticle = f.nameArticle;
    var textArticle = f.textArticle;
    var hemArticle = f.hem;
    if(nameArticle.value.length>0 && textArticle.value.length>0){
        var data="textArticle="+textArticle.value+"&nameArticle="+nameArticle.value+"&hem="+hemArticle.value;
        $.ajax({
            type: "POST",
            url: 'addArticle.php',
            data: data,
            success: function (data) {
                data=JSON.parse(data);
                if(data){
                    location.href="../news/news.php";
                }
                else{
                    alert(data);
                }
            }
        })
    }
}