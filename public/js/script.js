

$('#upload').hide();
setInterval(function(){
    if($('#inputGroupFile01').val()!=""){
        $('#upload').show();
        $('#imageURL').hide();
    }else{
        $('#upload').hide();
    }
},1000);

function ConfirmDelete(elem)
{
    var id = elem.getAttribute('data-id');
    if (confirm("Delete Account?")) {
        location.href = '/user/deleteFriend?id=' + id;
    }
}

function ConfirmSuggestion(elem)
{
    var id = elem.getAttribute('data-id');
    if (confirm("Delete Suggestion?")) {
        location.href = '/user/deleteSuggestion?id=' + id;
    }
}

function addFriend(elem) {
    var from_id = elem.getAttribute('data-from');
    var to_id = elem.getAttribute('data-to');
    sessionStorage.setItem("friend_request","requested");
    location.href = "/user/friend?from="+from_id+"&to="+to_id;
}

