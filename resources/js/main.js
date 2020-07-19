$(document).ready(function(){

    $('.modal').modal();

    $('#signin').click( function () {
        json = {};
        if($('#username').val() === "") {
            $('#username').next().next().attr("data-error", "Empty");
            $('#username').addClass('invalid');
        } else  if($('#pass').val() === "") {
            $('#username').next().next().attr("data-error", "Empty");
            $('#pass').addClass('invalid');
        } else {
            json['user'] = $('#username').val();
            json['password'] = $('#pass').val();
            $.ajax({
                type: 'POST',
                url: '/api/sign',
                data: json,
                success: function (data) {
                    if (data === "Success") {
                        location.replace("/");
                    } else {
                        $('#username').next().next().attr("data-error", "The login or password is incorrect");
                        $('#pass').next().next().attr("data-error", " ");
                        $('#username').addClass('invalid');
                        $('#pass').addClass('invalid');
                    }

                }
            });
        }
    });

    $('#exit-admin').click( function () {
        $.ajax({
            type: 'POST',
            url: '/api/exitAdmin',
            data: "exit",
            success: function (data) {
                location.replace("/");
            }
        });
    });

    $('#create-new-task').click( function () {
        json = {};
        pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
        if($('#username-task').val() === "") {
            $('#username-task').addClass('invalid');
        } else  if($('#email-task').val() === "") {
            $('#email-task').addClass('invalid');
        } else  if($('#textarea1').val() === "") {
            $('#textarea1').addClass('invalid');
        } else {
            json['name'] = $('#username-task').val();
            json['email'] = $('#email-task').val();
            json['text'] = $('#textarea1').val();
            $.ajax({
                type: 'POST',
                url: '/api/createTask',
                data: json,
                success: function (data) {
                    if(data === "Success") {
                        location.replace("/");
                    }
                }
            });
        }
    });

    $('#edit-task').click( function () {
        json = {};
       if($('#textarea2').val() === "") {
            $('#textarea2').addClass('invalid');
        } else {
            json['text'] = $('#textarea2').val();
            json['id'] = $('#id-task').val();
            json['cookie'] = encodeURIComponent(get_cookie('admin'));
            $.ajax({
                type: 'POST',
                url: '/api/editTask',
                data: json,
                success: function (data) {
                    console.log(data);
                    if(data === "Success") {
                        location.reload();
                    } else if(data === "Error") {
                        alert('Пожалуйста, авторизуйтесь');
                    }
                }
            });
        }
    });

    function get_cookie ( cookie_name )
    {
        var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );

        if ( results )
            return ( unescape ( results[2] ) );
        else
            return null;
    }



});