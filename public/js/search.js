$(document).ready(function(){
    var search_box = $("#search_text");
    var result = $("#result");
    var loading = $("#loading");
    var searchIcon = $('#searchIcon');
    searchIcon.show()
    loading.hide();
    var load_img = false;
    result.hide();
    search_box.on('keyup',function () {
        var txt = $(this).val();
        if (txt != ''){
            result.show();
            $("#loading").fadeOut(500);

            $.ajax({
                url: '/search/search',
                method: "POST",
                data: {search: txt},
                dataType: 'text',
                success: function (data) {
                    $('#result').html(data);
                }
            })
        }
        else {
            result.html('');
            $.ajax({
                url: '/search/search',
                method: "POST",
                data: {search: txt},
                dataType: 'text',
                success: function (data) {
                    result.html(data);
                }
            })
        }

        if(!load_img) {
            searchIcon.hide();
            loading.fadeIn(500);
            loading.fadeOut(1200);
            setTimeout( function(){searchIcon.show();} , 1700)
        }

        load_img = txt.length === 0 ? false : true;

        if(search.length === 0){
            loading.hide();
        }
    });

    $(document).click(function(e) {
        if (e.target.className == "search_text") {
            //alert("don`t hide");
        } else {
            $("#result").hide();
        }
    });
});