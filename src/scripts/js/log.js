/**
 * Created by NeoNemo on 13.12.2016.
 */
var main = function () {
    $('#login-form').submit(function () {
        $.permission = false;

        var error = $('.error-data'),
            dataAreValid = function () {
                var login = $('#login').val().trim(),
                    password = $('#password').val().trim();
                $.ajax({
                    url: 'scripts/php/logDataValid.php',
                    async: false,
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        login: login,
                        password: password
                    },
                    success: function(data) {
                        switch (data) {
                            case 'permitted':
                                $.permission = true;
                                error.hide(300);
                                break;
                            case 'denied':
                                error.show(300);
                                break;
                            default:
                                $('main').empty().html(
                                    '<h1>Виникла проблема!</h1>' +
                                    '<p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:' +
                                    '<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a>' +
                                    '<br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>');
                        }
                    },
                    error: function (xhr, text, description) {
                        $('main').empty().html(
                            '<h1>Виникла проблема!</h1>' +
                            '<p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "' + text + '":<br>' + xhr.status + ' - ' + description + '<br>' +
                            'Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>'
                        );
                    }
                });
            },
            permitted = function () {
                dataAreValid();
                return $.permission;
            };

        return permitted();
    });
};

$(document).ready(main);