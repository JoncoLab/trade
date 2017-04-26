var main = function () {
    var currentForm = null;
    $('#jur, #fiz').click(function () {
        var target = $('input:checked').attr('id'),
            form = $('#register');
        if (currentForm !== target) {
            form.slideUp(500, function () {
                form.load('assets/' + target + '.html', function () {
                    form.slideDown(500);
                    form.css('display', 'flex');
                });
            });
            currentForm = target;
        }
    });
    $('#register').submit(function (event) {
        var mailPermission = false,
            numberPermission = false,
            addressPermission = false,
            passwordPermission = false,
            namePermission = false,
            postPermission = false,
            errors = {
                mail: $('.error-mail'),
                password: $('.error-pass'),
                address: $('.error-address'),
                number: $('.error-number'),
                name: $('.error-name'),
                post: $('.error-post')
        },
            mailIsValid = function () {
                var email = $('#email').val();
                $.ajax({
                    async: false,
                    url: 'scripts/php/regDataValid.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        value: email,
                        type: 'email'
                    },
                    success: function(data) {
                        switch (data) {
                            case 'permitted':
                                mailPermission = true;
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
                var number = $('#number').val();
                $.ajax({
                    async: false,
                    url: 'scripts/php/regDataValid.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        value: number,
                        type: 'number'
                    },
                    success: function(data) {
                        switch (data) {
                            case 'permitted':
                                numberPermission = true;
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
                        $('#j-zip').val() + ', ' +
                        $('#j-country').val() + ', ' +
                        $('#j-region').val() + ' область, ';
                if ($('#j-district').val() !== '') {
                    address += $('#j-district').val() + ' район, ';
                }
                address +=
                    $('#j-city').val() + ', вул. ' +
                    $('#j-street').val() + ', ' +
                    $('#j-streetnum').val() + '/' +
                    $('#j-doornum').val();
                $.ajax({
                    async: false,
                    url: 'scripts/php/regDataValid.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        value: address,
                        type: 'address'
                    },
                    success: function (data) {
                        switch (data) {
                            case 'permitted':
                                addressPermission = true;
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
                var name = $('#full-name').val();
                $.ajax({
                    async: false,
                    url: 'scripts/php/regDataValid.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        value: name,
                        type: 'name'
                    },
                    success: function(data) {
                        switch (data) {
                            case 'permitted':
                                namePermission = true;
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
                    passwordPermission = true;
                    errors.password.hide(300);
                } else {
                    errors.password.show(300);
                }
            },
            postAddressValid = function () {
                if ($('#country').val() === '' || $('#city').val() === '' || $('#zip').val() === '' || $('#street').val() === '' || $('#streetnum').val() === '') {
                    if ($('#country').val() === '' && $('#city').val() === '' && $('#region').val() === '' && $('#zip').val() === '' && $('#street').val() === '' && $('#streetnum').val() === '' && $('#doornum').val() === '') {
                        errors.post.hide(300);
                        postPermission = true;
                    } else {
                        errors.post.show(300);
                        postPermission = false;
                    }
                }
            },
            permitted = function () {
                nameIsValid();
                mailIsValid();
                numberIsValid();
                passwordConfirmed();
                addressIsValid();
                postAddressValid();
                return (namePermission && mailPermission && numberPermission && passwordPermission && addressPermission && postPermission);
            };
        if (!permitted()) {
            event.preventDefault();
        }
    });
};

$(document).ready(main);