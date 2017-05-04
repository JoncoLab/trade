var main = function () {
    var currentForm = null,
        statusButtons = $('#jur, #fiz'),
        regForm = $('#register');
    statusButtons.click(function () {
        var target = $('input:checked').attr('id');
        if (currentForm !== target) {
            regForm.slideUp(500, function () {
                regForm.load('assets/' + target + '.html', function () {
                    regForm.slideDown(500);
                    regForm.css('display', 'flex');
                });
            });
            currentForm = target;
        }
    });
    
    regForm.submit(function (event) {
        var form = $(this),
            errors = {
                password: $('.error-pass'),
                post: $('.error-post'),
                name: $('.error-name'),
                address: $('.error-address'),
                mail: $('.error-mail'),
                number: $('.error-number')
            },
            passwordConfirmed = function () {
                var password = $('#password').val(),
                    confirmation = $('#password-confirm').val();

                if (confirmation === password) {
                    errors.password.hide(300);
                    return true;
                } else {
                    window.location.replace('#profile');
                    errors.password.show(300);
                    return false;
                }
            },
            postAddressValid = function () {
                var country = $('#country').val(), 
                    city = $('#city').val(), 
                    region = $('#region').val(), 
                    zip = $('#zip').val(), 
                    street = $('#street').val(), 
                    streetNum = $('#streetnum').val(), 
                    doorNum = $('#doornum').val(),
                    district = $('#district').val();
                if (country === '' || city === '' || zip === '' || street === '' || streetNum === '') {
                    if (country === '' && city === '' && region === '' && zip === '' && street === '' && streetNum === '' && doorNum === '' && district === '') {
                        errors.post.hide(300);
                        return true;
                    } else {
                        window.location.replace('#post');
                        errors.post.show(300);
                        return false;
                    }
                }
            };
        event.preventDefault();
        if (passwordConfirmed() && postAddressValid()) {
            var name = $('#full-name').val(),
                email = $('#email').val(),
                number = $('#number').val(),
                country = $('#j-country').val(),
                city = $('#j-city').val(),
                region = $('#j-region').val(),
                zip = $('#j-zip').val(),
                street = $('#j-street').val(),
                streetNum = $('#j-streetnum').val(),
                doorNum = $('#j-doornum').val(),
                district = $('#j-district').val(),
                address = zip + ', ' + country + ', ' + region + ' область, ';
            if (district.trim() != '') {
                address += district + ' район, ';
            }
            address += city + ', вул. ' + street + ', ' + streetNum;
            if (doorNum !== '') {
                address += '/' + doorNum;
            }
            $.ajax({
                url: 'scripts/php/regDataValid.php',
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    number: number,
                    address: address
                },
                dataType: 'text',
                success: function (data) {
                    switch (data) {
                        case 'name':
                            window.location.replace('#names');
                            errors.name.show(300);
                            break;
                        case 'email':
                            window.location.replace('#profile');
                            errors.name.hide(300);
                            errors.mail.show(300);
                            break;
                        case 'number':
                            window.location.replace('#profile');
                            errors.name.hide(300);
                            errors.mail.hide(300);
                            errors.number.show(300);
                            break;
                        case 'address':
                            window.location.replace('#address');
                            errors.name.hide(300);
                            errors.mail.hide(300);
                            errors.number.hide(300);
                            errors.address.show(300);
                            break;
                        case 'valid':
                            form.unbind('submit');
                            errors.name.hide(300);
                            errors.mail.hide(300);
                            errors.number.hide(300);
                            errors.address.hide(300);
                            form.submit();
                            break;
                        default:
                            alert('Нестабільне підключення до бази даних. Сторінку буде перезавантажено.');
                            window.location.reload();
                    }
                },
                error: function () {
                    alert('Не вдалося підключитися до бази даних! Спробуйте за кілька хвилин, або зверніться у службу підтримки.');
                }
            });
        }
    });
};

$(document).ready(main);