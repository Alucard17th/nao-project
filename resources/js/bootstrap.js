window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) { }

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
require('bootstrap/dist/js/bootstrap.bundle');

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.private('App.Models.User.' + User.id)
    .notification((notification) => {
        document.getElementById('notif-count').innerHTML = parseInt(document.getElementById('notif-count').innerHTML) + 1

        $("#notif-list").prepend('<li><a class="dropdown-item" href="#">' + notification.message.sender + '\xa0vous a mentionné à </br>' + notification.message.task + '</a></li>');

        console.log(notification.message);
    });


// window.Echo.channel('chat').listen('.chat-message', (event) => {
//     console.log(event)
//     let messageQueue = document.getElementById('message-queue')
//     $("#message-queue").append()
// });

window.Echo.private('user.'+User.id).listen('.chat-message', (event) => {

    console.log(event)
    $('#message-notification').removeClass( "d-none" )

    $('#contact-list').each(function(i, items_list){
        $(items_list).find('li').each(function(j, li){
            if($(li).data('sendto') === event.user.id){
               console.log("Message received From ") 
               console.log(event.user.id)
               console.log(event.user.name)
               $(li).children('div').children('span').html(parseInt($(li).children('div').children('span').html(), 10)+1)
               console.log('LIST VAl ! ')
               console.log($(li).children('div').children('span').html())
            }
        })
    });

    if($('#message-queue').data('sender') === event.user.id)
    {
        let message = `<li class="clearfix">
                        <div class="message-data">
                            <span class="message-data-time">10:10 AM, Today</span>
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                        </div>
                        <div class="message other-message">${event.message}</div>
                    </li>`;
                           
        $("#message-queue").append(message)
        $('#chat-history').scrollTop(1000000);
    }
    

});




