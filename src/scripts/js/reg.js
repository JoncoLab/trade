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
        var errors = {
                password: $('.error-pass'),
                post: $('.error-post')
        },
            passwordConfirmed = function () {
                var password = $('#password').val(),
                    confirmation = $('#password-confirm').val();

                if (confirmation === password) {
                    errors.password.hide(300);
                } else {
                    event.preventDefault();
                }
            },
            postAddressValid = function () {
                if ($('#country').val() === '' || $('#city').val() === '' || $('#zip').val() === '' || $('#street').val() === '' || $('#streetnum').val() === '') {
                    if ($('#country').val() === '' && $('#city').val() === '' && $('#region').val() === '' && $('#zip').val() === '' && $('#street').val() === '' && $('#streetnum').val() === '' && $('#doornum').val() === '') {
                        errors.post.hide(300);
                    } else {
                        errors.post.show(300);
                        event.preventDefault();
                    }
                }
            };
        passwordConfirmed();
        postAddressValid();
    });
};

$(document).ready(main);