var main = function () {
    var currentForm = null;
    $('#jur, #fiz').click(function () {
        var target = $('input:checked').attr('id'),
            form = $('#register');
        if (currentForm !== target) {
            form.slideUp(500, function () {
                form.load(target + '.html', function () {
                    form.slideDown(500);
                    form.css('display', 'flex');
                });
            });
            currentForm = target;
        }
    });
    $('#register').submit(function () {
        $.mail_permission = false;
        $.number_permission = false;
        $.address_permission = false;
        $.password_permission = false;

        var errors = {
            mail: $('.error-mail'),
            password: $('.error-pass'),
            address: $('.error-address'),
            number: $('.error-number')
        },
            mailIsValid = function () {
            var email = $('#email').val().trim();
            $.ajax({
                url: 'scripts/php/regDataValid.php',
                async: false,
                type: 'POST',
                dataType: 'text',
                data: {
                    value: email,
                    type: 'email'
                },
                success: function(data) {
                    switch (data) {
                        case 'permitted':
                            $.mail_permission = true;
                            errors.mail.hide(300);
                            break;
                        case 'denied':
                            errors.mail.show(300);
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
            numberIsValid = function () {
                var number = $('#number').val().trim();
                $.ajax({
                    url: 'scripts/php/regDataValid.php',
                    async: false,
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        value: number,
                        type: 'number'
                    },
                    success: function(data) {
                        switch (data) {
                            case 'permitted':
                                $.number_permission = true;
                                errors.number.hide(300);
                                break;
                            case 'denied':
                                errors.number.show(300);
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
                            '<p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "' + text + '":<br>' + xhr.status + ' - ' + description +
                            '<br>' + 'Спробуйте <a href="reg.html">Перезавантажити сторінку.</a>' +
                            '<br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>'
                        );
                    }
                });
            },
            addressIsValid = function () {
                var address =
                        $('#zip').val().trim() + ', ' +
                        $('#country').val().trim() + ', ' +
                        $('#region').val().trim() + ' область, ' +
                        $('#district').val().trim() + ' район, ' +
                        $('#city').val().trim() + ', вул. ' +
                        $('#street').val().trim() + ', ' +
                        $('#streetnum').val().trim() + '/' +
                        $('#doornum').val().trim(),
                    jurAddress =
                        $('#j-zip').val().trim() + ', ' +
                        $('#j-country').val().trim() + ', ' +
                        $('#j-region').val().trim() + ' область, ' +
                        $('#j-district').val().trim() + ' район, ' +
                        $('#j-city').val().trim() + ', вул. ' +
                        $('#j-street').val().trim() + ', ' +
                        $('#j-streetnum').val().trim() + '/' +
                        $('#j-doornum').val().trim();
                $.ajax({
                    url: 'scripts/php/regDataValid.php',
                    async: false,
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        value: jurAddress,
                        type: 'address'
                    },
                    success: function (data) {
                        switch (data) {
                            case 'permitted':
                                $.address_permission = true;
                                errors.address.hide(300);
                                break;
                            case 'denied':
                                errors.address.show(300);
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
            passwordConfirmed = function () {
                var password = $('#password').val(),
                    confirmation = $('#password-confirm').val();

                if (confirmation === password) {
                    $.password_permission = true;
                    errors.password.hide(300);
                } else {
                    errors.password.show(300);
                }
            },
            permitted = function () {
                mailIsValid();
                numberIsValid();
                addressIsValid();
                passwordConfirmed();
                return $.mail_permission && $.number_permission && $.address_permission && $.password_permission;
            };

        return permitted();
    });
};

$(document).ready(main);