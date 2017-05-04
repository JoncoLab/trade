'use strict';
var main = function () {
    var height = $('.navbar').height(),
        main = $('main'),
        dataTables = $('table.users, table.lots'),
        navigationButtons = $('header .navbar button'),
        usersVerificationCells = $('.users td.ver'),
        usersVerificationForm = usersVerificationCells.children('.verification-form'),
        deleteUserButton = $('.users td.delete .delete-button'),
        cancelVerificationButton = $('.users td.delete .cancel-verification-button'),
        cancelAllVerificationsButton = $('#cancel'),
        userAllowAccessButton = $('.users td.access button.allow-access'),
        userDenyAccessButton = $('.users td.access button.deny-access'),
        deleteLotButton = $('.lots td.delete .delete-button'),
        uploadLotsInput = $('#upload'),
        clearLotsButton = $('#clear-lots'),
        downloadLotsButton = $('#download'),
        totalCell = $('#total'),
        totalVerifiedCell = $('#total-verified'),
        settings = {
            nextSession: $('#set-next-session'),
            adminPass: $('#set-admin-pass'),
            applicationTemplate: $('#application-template'),
            timer: $('#set-timer'),
            to: $('#set-to')
        },
        loading = function (status) {
            var loadingBar = $('#loading');
            switch (status) {
                case true:
                    loadingBar.show(0, function () {
                        loadingBar.css({
                            'display': 'flex'
                        });
                    });
                    break;
                case false:
                    loadingBar.hide();
                    break;
                default:
                    alert('Сталася помилка! Сторінку буде перезавантажено!');
                    window.location.reload();
            }
        },
        set = function (type, input) {
            loading(true);
            $.ajax({
                url: 'scripts/php/admin-settings.php',
                method: 'POST',
                data: {
                    function: type,
                    input: input
                },
                success: function () {
                    alert('Налаштування змінено!');
                },
                error: function () {
                    alert('Щось пішло не так! Налаштування не було змінено!');
                },
                complete: function () {
                    loading(false);
                }
            });
        },
        // newArticleContent = $('form .content'),
        // addParagraphBar = newArticleContent.children('.add-paragr'),
        sessionPreparationForm = $('.trade');
    
    main.css('margin-top', height + 20 + 'px');

    dataTables.DataTable({
        "iDisplayLength": 10
    });

    navigationButtons.click(function () {
        var pages = $('.page-maker'),
            dataTablesBars = $('[id$="_wrapper"]'),
            targetPageId = $(this).attr('id'),
            usersDataTable = $('#DataTables_Table_1_wrapper'),
            lotsDataTable = $('#DataTables_Table_0_wrapper');
        pages.hide();
        dataTablesBars.hide();
        $('.' + targetPageId).toggle();
        switch (targetPageId) {
            case 'users':
                usersDataTable.show();
                break;
            case 'lots':
                lotsDataTable.show();
                break;
        }
    });

    settings.nextSession.submit(function (event) {
        var nextSession = $('#next-session').val();
        event.preventDefault();
        set('nextSession', nextSession);
    });

    settings.adminPass.submit(function (event) {
        var adminPass = $('#admin-pass').val();
        event.preventDefault();
        set('adminPass', adminPass);
    });

    settings.applicationTemplate.change(function () {
        var file = this.files[0];
        if (file.name.length > 0) {
            var data = new FormData();
            data.append('application', file);
            loading(true);
            $.ajax({
                url: 'scripts/php/admin-upload-application.php',
                method: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function () {
                    alert('Шаблон заявки успішно оновлено!');
                },
                error: function () {
                    alert('Проблема з файлом! Таблицю не буде оновлено!');
                },
                complete: function () {
                    loading(false);
                }
            });
            uploadApplicationTemplateInput.val('');
        } else {
            alert('Ви не вибрали файл, шаблон заявки не буле оновлено!');
            loading(false);
        }
    });

    settings.timer.submit(function (event) {
        var timer = $('#timer').val();
        event.preventDefault();
        set('timer', timer);
    });

    settings.to.submit(function (event) {
        var to = $('#to').val();
        event.preventDefault();
        set('to', to);
    });

    uploadLotsInput.change(function () {
        var file = this.files[0];
        if (file.name.length > 0) {
            var data = new FormData();
            data.append('lots', file);
            loading(true);
            $.ajax({
                url: 'scripts/php/admin-upload-lots.php',
                method: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function () {
                    alert('Лоти успішно оновлено!');
                },
                error: function () {
                    alert('Проблема з файлом! Таблицю не буде оновлено!');
                },
                complete: function () {
                    loading(false);
                }
            });
            uploadLotsInput.val('');
        } else {
            alert('Ви не вибрали файл, таблицю не буле оновлено!');
            loading(false);
        }
    });

    clearLotsButton.click(function () {
        loading(true);
        $.ajax({
            url: 'scripts/php/admin-clear-lots.php',
            success: function () {
                alert('Таблицю лотів успішно очищено!');
            },
            error: function () {
                alert('Виникла проблема. Не вдалося очистити лоти.');
            },
            complete: function () {
                loading(false);
            }
        });
    });

    downloadLotsButton.click(function () {
        window.location.replace('scripts/php/admin-download-lots.php');
    });
    
    usersVerificationForm.on('submit', function (event) {
        var verificationCell = $(this).parents('td'),
            id = verificationCell.siblings('.id').text(),
            traderId = $(this).children('.set-trader-id').val(),
            currentCancelVerificationButton = verificationCell.siblings('.delete').children('.cancel-verification-button'),
            allowAccessButton = verificationCell.siblings('.access').children('.allow-access'),
            body = $('body');
        
        loading(true);
        
        $.ajax({
            url: 'scripts/php/admin-verify.php',
            dataType: 'html',
            method: 'POST',
            data: {
                id: id,
                traderId: traderId
            },
            success: function (data) {
                loading(false);
                body.prepend(data);
                currentCancelVerificationButton.removeAttr('disabled');
                allowAccessButton.removeAttr('disabled');
            },
            error: function () {
                loading(false);
                alert('Не вдається з\'єднатися з базою даних! Сторінку буде перезавантажено!');
                window.location.reload();
            }
        });
        return event.preventDefault();
    });

    deleteUserButton.click(function () {
        var userId = $(this).parent().siblings('.id').text(),
            userRow = $(this).parentsUntil('tbody'),
            ver = userRow.siblings('.ver').text();

        loading(true);

        $.ajax({
            url: 'scripts/php/admin-delete-user.php',
            data: {
                userId: userId
            },
            method: 'post',
            error: function () {
                loading(false);
                alert('Не вдається з\'єднатися з базою даних! Сторінку буде перезавантажено!');
                window.location.reload();
            },
            success: function () {
                loading(false);
                userRow.remove();
                totalCell.text(parseInt(totalCell.text() - 1));
                if (ver == 'Верифікований') {
                    totalVerifiedCell.text(parseInt(totalVerifiedCell.text()) - 1);
                }
            }
        });
    });

    cancelVerificationButton.click(function () {
        var currentButton = $(this);
        if (!currentButton.is(':disabled')) {
            var user = currentButton.parentsUntil('tbody'),
                id = user.children('.id').text(),
                traderIdCell = user.children('.trader-id'),
                traderId = traderIdCell.text(),
                verificationCell = user.children('.ver'),
                accessCell = user.children('.access'),
                appliedForLotsCell = user.children('.applied-for-lots'),
                customersAppliedCells = $('.lots td.customers-applied'),
                form = '<form class="verification-form" onsubmit="verify($(this));">' +
                    '<input type="text" name="set-trader-id" class="set-trader-id" maxlength="4" pattern="[0-9]{3}" placeholder="Реєстр. №">' +
                    '<label class="verify">Верифікувати<input style="display: none;" type="submit" name="submit" value="verify"></label>' +
                    '</form>',
                button = '<button disabled onclick="allowAccess($(this));" class="allow-access">Допустити</button>';

            loading(true);

            $.ajax({
                url: 'scripts/php/admin-cancel-verification.php',
                method: 'POST',
                data: {
                    id: id,
                    traderId: traderId
                },
                success: function () {
                    traderIdCell.empty();
                    appliedForLotsCell.empty();
                    verificationCell.html(form);
                    accessCell.html(button);
                    totalVerifiedCell.text(parseInt(totalVerifiedCell.text()) - 1);
                    currentButton.attr('disabled', 'disabled');
                    customersAppliedCells.each(function () {
                        var cell = $(this),
                            customersApplied = cell.text(),
                            excludesUser = function (customer) {
                                return customer != traderId;
                            };
                        customersApplied = customersApplied.split(', ');
                        customersApplied = customersApplied.filter(excludesUser);
                        customersApplied = customersApplied.join(', ');
                        cell.text(customersApplied);
                    });
                },
                error: function () {
                    alert('Не вдається з\'єднатися з базою даних! Сторінку буде перезавантажено!');
                    window.location.reload();
                },
                complete: function () {
                    loading(false);
                }
            });
        }
    });

    cancelAllVerificationsButton.click(function () {
        var traderIdCells = $('.users td.trader-id'),
            verificationCells = $('.users td.ver'),
            cancelVerificationButtons = $('.users td.delete .cancel-verification-button'),
            appliedForLotsCells = $('.users td.applied-for-lots'),
            accessCells = $('.users td.access'),
            customersAppliedCells = $('.lots td.customers-applied'),
            form = '<form class="verification-form" onsubmit="verify($(this));">' +
                '<input type="text" name="set-trader-id" class="set-trader-id" maxlength="4" pattern="[0-9]{3}" placeholder="Реєстр. №">' +
                '<label class="verify">Верифікувати<input style="display: none;" type="submit" name="submit" value="verify"></label>' +
                '</form>',
            button = '<button disabled onclick="allowAccess($(this));" class="allow-access">Допустити</button>';

        loading(true);

        $.ajax({
            url: 'scripts/php/admin-cancel-all-verifications.php',
            success: function () {
                traderIdCells.empty();
                appliedForLotsCells.empty();
                customersAppliedCells.empty();
                verificationCells.html(form);
                accessCells.html(button);
                totalVerifiedCell.text('0');
                cancelVerificationButtons.attr('disabled', 'disabled');
            },
            error: function () {
                alert('Не вдається з\'єднатися з базою даних! Сторінку буде перезавантажено!');
                window.location.reload();
            },
            complete: function () {
                loading(false);
            }
        });
    });

    userAllowAccessButton.on('click', function () {
        if (!$(this).is(':disabled')) {
            var userRow = $(this).parentsUntil('tbody'),
                userId = userRow.children('.id').text(),
                userAccessCell = userRow.children('.access');
            loading(true);
            $.ajax({
                url: 'scripts/php/admin-allow-access.php',
                method: 'POST',
                data: {
                    id: userId
                },
                dataType: 'html',
                success: function (data) {
                    userAccessCell.html(data);
                    alert('Користувача успішно допущено до торгів.');
                },
                error: function () {
                    alert('Не вдалося з\'єднатися з базою даних!');
                },
                complete: function () {
                    loading(false);
                }
            });
        }
    });

    userDenyAccessButton.on('click', function () {
        var userRow = $(this).parentsUntil('tbody'),
            userId = userRow.children('.id').text(),
            userAccessCell = userRow.children('.access');
        loading(true);
        $.ajax({
            url: 'scripts/php/admin-deny-access.php',
            method: 'POST',
            data: {
                id: userId
            },
            dataType: 'html',
            success: function (data) {
                userAccessCell.html(data);
                alert('Користувачу заборонено доступ до торгів.');
            },
            error: function () {
                alert('Не вдалося з\'єднатися з базою даних!');
            },
            complete: function () {
                loading(false);
            }
        });
    });

    deleteLotButton.click(function () {
        var lotId = $(this).parent().siblings('.id').text(),
            lotRow = $(this).parentsUntil('tbody');

        loading(true);

        $.ajax({
            url: 'scripts/php/admin-delete-lot.php',
            data: {
                lotId: lotId
            },
            method: 'post',
            error: function () {
                loading(false);
                alert('Не вдається з\'єднатися з базою даних! Сторінку буде перезавантажено!');
                window.location.reload();
            },
            success: function () {
                loading(false);
                lotRow.remove();
            }
        });
    });

    // addParagraphBar.click(function () {
    //     var paragraph = $('.content textarea').val(),
    //         textArea = newArticleContent.children('textarea'),
    //         clearButton = $('.clear'),
    //         reviewButton = $('.watch');
    //
    //     if (paragraph !== '') {
    //         newArticleContent.append(
    //             '<div class="new-paragr">' +
    //             '<button class="remove-paragr" type="button">Стерти</button>' +
    //             '<button class="edit-paragr" type="button">Редаг</button>' +
    //             '<button type="button" class="edited">OK</button>' +
    //             '<p class="paragraph">' + paragraph + '</p>' +
    //             '</div>');
    //         textArea.val('');
    //     }
    //
    //     var newParagraph = $('.content .new-paragr'),
    //         editParagraphButton = newParagraph.children('.edit-paragr'),
    //         editedButton = newParagraph.children('.edited'),
    //         removeButton = newParagraph.children('.remove-paragr');
    //
    //     clearButton.click(function () {
    //         textArea.val('');
    //     });
    //
    //     editParagraphButton.unbind().on('click', function () {
    //         var currentParagraph = $(this),
    //             textToEdit = currentParagraph.siblings('p').html(),
    //             excessiveElements = currentParagraph.siblings('textarea, p'),
    //             editedButton = currentParagraph.siblings('.edited');
    //         excessiveElements.remove();
    //         currentParagraph.parent().prepend('<textarea autofocus rows="12" tabindex="1">' + textToEdit + '</textarea>');
    //         currentParagraph.hide();
    //         editedButton.show();
    //         currentParagraph.siblings('textarea').focus();
    //     });
    //
    //     editedButton.click(function () {
    //         var currentParagraph = $(this),
    //             editedParagr = currentParagraph.siblings('textarea').text();
    //         if (editedParagr !== '') {
    //             currentParagraph.siblings('p').remove();
    //             currentParagraph.parent().append('<p>' + editedParagr + '</p>');
    //             currentParagraph.hide();
    //             currentParagraph.siblings('textarea').remove();
    //             currentParagraph.siblings('.edit-paragr').show();
    //         }
    //     });
    //
    //     removeButton.click(function () {
    //         $(this).parent().remove();
    //     });
    //
    //     reviewButton.on("click", function () {
    //         var headingInput = $('#header'),
    //             heading = headingInput.val(),
    //             header = "<h2>" + heading + "</h2>",
    //             p = "";
    //
    //         newParagraph.each(function () {
    //             p = p + "<p>" + $(this).children('p').html() + "</p>";
    //         });
    //
    //         if (newParagraph.length !== 0 && heading !== '') {
    //             var articleHTML =
    //                 "<article class='preview'>" +
    //                 "<span class='back' style='color: grey; float: right;'>Повернутись - подвійний клік по статті</span>" + header + p +
    //                 "</article>",
    //                 previewArticle = $('article.preview'),
    //                 fieldSets = $('fieldset');
    //
    //             fieldSets.hide();
    //             previewArticle.remove();
    //             $('form.write-article').append(articleHTML);
    //
    //         } else if (heading == '') {
    //             headingInput.toggleClass('error');
    //             return false;
    //         }
    //
    //         $('article').focus();
    //
    //         previewArticle.dblclick(function () {
    //             $(this).remove();
    //             fieldSets.show();
    //         });
    //     });
    // });

    sessionPreparationForm.submit(function (event) {
        var sellers = $(this).find('.form-item'),
            selectedSellers = sellers.has('input:checked'),
            input = $('#sellers'),
            amount = selectedSellers.length;
        if (amount == 0) {
            alert('Жодного продавця не вибрано!');
            event.preventDefault();
        } else {
            var sellerNames = '';
            selectedSellers.each(function (iterator) {
                sellerNames += $(this).children('.seller').text();
                if (iterator != amount - 1) {
                    sellerNames += ',';
                }
            });
            input.val(sellerNames);
        }
    });
},
    loading = function (status) {
        var loadingBar = $('#loading');
        switch (status) {
            case true:
                loadingBar.show(0, function () {
                    loadingBar.css({
                        'display': 'flex'
                    });
                });
                break;
            case false:
                loadingBar.hide();
                break;
            default:
                alert('Сталася помилка! Сторінку буде перезавантажено!');
                window.location.reload();
        }
    },
    verify = function (form, event) {
        var verificationCell = form.parents('td'),
            id = verificationCell.siblings('.id').text(),
            traderId = form.children('.set-trader-id').val(),
            currentCancelVerificationButton = verificationCell.siblings('.delete').children('.cancel-verification-button'),
            allowAccessButton = verificationCell.siblings('.access').children('.allow-access'),
            body = $('body');

        loading(true);

        $.ajax({
            url: 'scripts/php/admin-verify.php',
            dataType: 'html',
            method: 'POST',
            data: {
                id: id,
                traderId: traderId
            },
            success: function (data) {
                loading(false);
                body.prepend(data);
                currentCancelVerificationButton.removeAttr('disabled');
                allowAccessButton.removeAttr('disabled');
            },
            error: function () {
                loading(false);
                alert('Не вдається з\'єднатися з базою даних! Сторінку буде перезавантажено!');
                window.location.reload();
            }
        });
        event.preventDefault();
    },
    denyAccess = function (button) {
        var userRow = button.parentsUntil('tbody'),
            userId = userRow.children('.id').text(),
            userAccessCell = userRow.children('.access');
        loading(true);
        $.ajax({
            url: 'scripts/php/admin-deny-access.php',
            method: 'POST',
            data: {
                id: userId
            },
            dataType: 'html',
            success: function (data) {
                userAccessCell.html(data);
                alert('Користувачу заборонено доступ до торгів.');
            },
            error: function () {
                alert('Не вдалося з\'єднатися з базою даних!');
            },
            complete: function () {
                loading(false);
            }
        });
    },
    allowAccess = function (button) {
        if (!button.is(':disabled')) {
            var userRow = button.parentsUntil('tbody'),
                userId = userRow.children('.id').text(),
                userAccessCell = userRow.children('.access');
            loading(true);
            $.ajax({
                url: 'scripts/php/admin-allow-access.php',
                method: 'POST',
                data: {
                    id: userId
                },
                dataType: 'html',
                success: function (data) {
                    userAccessCell.html(data);
                    alert('Користувача успішно допущено до торгів.');
                },
                error: function () {
                    alert('Не вдалося з\'єднатися з базою даних!');
                },
                complete: function () {
                    loading(false);
                }
            });
        }
    };

$(document).ready(main);