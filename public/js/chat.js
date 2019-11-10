$(document).ready(function () {
    $('.start_chat').click(function () {
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('username');
        make_chat_dialog_box(to_user_id, to_user_name);
        $("#user_dialog_" + to_user_id).dialog({
            autoOpen: false,
            width: $(window).width() > 600 ? 600 : 'auto',
            height: 'auto',
            fluid: true, //new option
            resizable: false,
            modal: false,
            show: {
                effect: "slide",
                duration: 1000
            },
            hide: {
                effect: "fade",
                duration: 1000
            }
        });
        $("#user_dialog_" + to_user_id).dialog('open');


    });
    function make_chat_dialog_box(to_user_id, user_name) {



        var modal_content = '<div id="user_dialog_' + to_user_id + '" class="card user_dialog" title="'+user_name+'" style="width: 580px">';
            modal_content += '<div class="card-body chat_history border p-3 m-2" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '" style="min-height: 450px; max-height: 450px; overflow-y: scroll">';
            modal_content += fetch_user_chat_history(to_user_id);
            modal_content += '</div>';
            modal_content += '<div class="card-footer row">';
            modal_content +=    '<div class="form-group col-10">';
            modal_content +=        '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" required class="form-control "></textarea>';
            modal_content +=    '</div>' +
                '               <div class="form-group col-2" >';
            modal_content +=        '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-info send_chat">Send</button>' +
                '               </div>' +
                '           </div>';
            modal_content += '</div>'

        $('#user_model_details').html(modal_content);
    };

    $(document).on('click', '.send_chat', function(){
        var to_user_id = $(this).attr('id');
        var chat_message = $('#chat_message_'+to_user_id).val();
        $.ajax({
            url:"/messages/insert",
            method:"POST",
            data:{to_user_id:to_user_id, chat_message:chat_message},
            success:function(data)
            {
                $('#chat_message_'+to_user_id).val('');
                $('#chat_history_'+to_user_id).html(data);
            }
        })
    });
    function fetch_user_chat_history(to_user_id)
    {
        $.ajax({
            url:"/messages/chatHistory",
            method:"POST",
            data:{to_user_id:to_user_id},
            success:function(data){
                $('#chat_history_'+to_user_id).html(data);
            }
        })
    }
});




