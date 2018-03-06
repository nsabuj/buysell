var user_id;
var chat_id;


// $.ajaxSetup({
  var csrf_token=$('meta[name="csrf-token"]').attr('content');
// alert(csrf_token);
$(document).ready(function()
{



    user_id = parseInt($('#user_id').html());
    chat_id=parseInt($('#chat_id').html());

    update_style();
   // $('.'+selector).hide();

    if($.isNumeric(chat_id)&&chat_id>0){
       pullData();
    }else {
        return false;
    }

   $('.send').click(function (e) {
       e.preventDefault();
       e.stopPropagation();
       sendMessage();
   });



    $('#text').keyup(function(e) {
        if (e.keyCode == 13) {
            sendMessage();
            e.preventDefault();
            e.stopPropagation();
        }
        else {
            isTyping();
        }

    });



});

function pullData()
{
    retrieveChatMessages();
    retrieveTypingStatus();
    setTimeout(pullData,8000);
}

function retrieveChatMessages()
{
    $.ajax({
        type: "POST",
        url:'/retrieveChatMessages',
        data: {_token:csrf_token,user_id: user_id,chat_id:chat_id},
        success: function( data ) {
            $("#chat-window").append(data);
            update_style();
        }

    });
    return false;
}

function retrieveTypingStatus() {

        $.ajax({
            type: "POST",
            url: '/retrieveTypingStatus',
            data: {_token:csrf_token,user_id: user_id, chat_id: chat_id},
            success: function (username) {
                if (username.length > 0) {
                    $('#typingStatus').html(username + ' is typing');
                }
                else {
                    $('#typingStatus').html('');
                }
            }

        });
    return false;

}


function sendMessage()
{
    var text = $('#text').val();

    if (text.length > 0)
    {



        $.ajax({
            type: "POST",
            url: '/sendMessage',
            data: {_token:csrf_token,user_id: user_id,text: text,chat_id:chat_id},
            success: function (data) {

                $('#chat-window').append('<br><div class="msg-single sender-'+user_id+'">'+text+'</div><br>');
                $('#text').val('');
                notTyping();
                update_style();

            }

        });

    }
    return false;
}

function isTyping()
{
    $.post('/isTyping', {_token:csrf_token,user_id: user_id,chat_id:chat_id});
}

function notTyping()
{
    $.post('/notTyping', {_token:csrf_token,user_id: user_id,chat_id:chat_id});
}

function update_style(){
    var selector='sender-'+user_id;
    $('.'+selector).css({'text-align':'right','color':'#000','float':'right'});
}