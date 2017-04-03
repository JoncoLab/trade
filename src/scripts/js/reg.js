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
        $.name_permission = false;
        $.post_permission = false;

        var errors = {
            mail: $('.error-mail'),
            password: $('.error-pass'),
            address: $('.error-address'),
            number: $('.error-number'),
            name: $('.error-name'),
            post: $('.error-post')
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
                        $('#j-zip').val().trim() + ', ' +
                        $('#j-country').val().trim() + ', ' +
                        $('#j-region').val().trim() + ' область, ';
                if ($('#j-district').val().trim() !== '') {
                    address += $('#j-district').val().trim() + ' район, ';
                }
                address +=
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
                        value: address,
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
            nameIsValid = function () {
                var name = $('#full-name').val().trim();
                $.ajax({
                    url: 'scripts/php/regDataValid.php',
                    async: false,
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        value: name,
                        type: 'name'
                    },
                    success: function(data) {
                        switch (data) {
                            case 'permitted':
                                $.name_permission = true;
                                errors.name.hide(300);
                                break;
                            case 'denied':
                                errors.name.show(300);
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
            postAddressValid = function () {
                if ($('#country').val().trim() === '' || $('#city').val().trim() === '' || $('#region').val().trim() === '' || $('#zip').val().trim() === '' || $('#street').val().trim() === '' || $('#streetnum').val().trim() === '' || $('#doornum').val().trim() === '') {
                    if ($('#country').val().trim() === '' && $('#city').val().trim() === '' && $('#region').val().trim() === '' && $('#zip').val().trim() === '' && $('#street').val().trim() === '' && $('#streetnum').val().trim() === '' && $('#doornum').val().trim() === '') {
                        errors.post.hide(300);
                        $.post_permission = true;
                    } else {
                        errors.post.show(300);
                        $.post_permission = false;
                    }
                }
            },
            permitted = function () {
                mailIsValid();
                numberIsValid();
                addressIsValid();
                nameIsValid();
                passwordConfirmed();
                postAddressValid();
                return $.mail_permission && $.number_permission && $.address_permission && $.name_permission && $.password_permission && $.post_permission;
            };

        return permitted();
    });
};

$(document).ready(main);