/**
 * Created by Saladin on 03.04.2017.
 */
var main = function () {
    $('#password').focus(function () {
        $(this).css({
            'background-color': 'lightblue',
            'outline': 'none'
        });
    });
    $('#secure').submit(function () {
        var pass = $('#password').val(),
            deny = function () {
                $('#password').css({
                    'background-color': 'red'
                });
            };
        $.ajax({
            url: 'scripts/php/admin-log.php',
            method: 'POST',
            dataType: 'text',
            data: {pass: pass},
            success: function (data) {
                switch (data) {
                    case '+':
                        window.location = 'admin.php';
                        break;
                    case '-':
                        deny();
                        break;
                    default:
                        deny();
                        alert('Помилка! Перезавантажте сторінку!');
                }
            },
            error: function () {
                deny();
                alert('Помилка! Перезавантажте сторінку!');
            }
        });
        return false;
    });
};

$(document).ready(main);