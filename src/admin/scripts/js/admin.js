'use strict';
var main = function () {
    var height = $('.navbar').height(),
        main = $('main'),
        dataTables = $('table.users, table.lots'),
        navigationButtons = $('header .navbar button'),
        usersVerificationCells = $('.users td.ver'),
        usersVerificationForm = usersVerificationCells.children('.verification-form'),
        deleteUserButton = $('.users td.delete .delete-button'),
        deleteLotButton = $('.lots td.delete .delete-button'),
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
        newArticleContent = $('form .content'),
        addParagraphBar = newArticleContent.children('.add-paragr'),
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
    
    usersVerificationForm.on('submit', function (event) {
        var verificationCell = $(this).parents('td'),
            id = verificationCell.siblings('.id').text(),
            traderId = $(this).children('.set-trader-id').val(),
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
            userRow = $(this).parentsUntil('tbody');

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

    addParagraphBar.click(function () {
        var paragraph = $('.content textarea').val(),
            textArea = newArticleContent.children('textarea'),
            clearButton = $('.clear'),
            reviewButton = $('.watch');
        
        if (paragraph !== '') {
            newArticleContent.append(
                '<div class="new-paragr">' +
                '<button class="remove-paragr" type="button">Стерти</button>' +
                '<button class="edit-paragr" type="button">Редаг</button>' +
                '<button type="button" class="edited">OK</button>' +
                '<p class="paragraph">' + paragraph + '</p>' +
                '</div>');
            textArea.val('');
        }

        var newParagraph = $('.content .new-paragr'),
            editParagraphButton = newParagraph.children('.edit-paragr'),
            editedButton = newParagraph.children('.edited'),
            removeButton = newParagraph.children('.remove-paragr');
        
        clearButton.click(function () {
            textArea.val('');
        });
        
        editParagraphButton.unbind().on('click', function () {
            var currentParagraph = $(this),
                textToEdit = currentParagraph.siblings('p').html(),
                excessiveElements = currentParagraph.siblings('textarea, p'),
                editedButton = currentParagraph.siblings('.edited');
            excessiveElements.remove();
            currentParagraph.parent().prepend('<textarea autofocus rows="12" tabindex="1">' + textToEdit + '</textarea>');
            currentParagraph.hide();
            editedButton.show();
            currentParagraph.siblings('textarea').focus();
        });
        
        editedButton.click(function () {
            var currentParagraph = $(this),
                editedParagr = currentParagraph.siblings('textarea').text();
            if (editedParagr !== '') {
                currentParagraph.siblings('p').remove();
                currentParagraph.parent().append('<p>' + editedParagr + '</p>');
                currentParagraph.hide();
                currentParagraph.siblings('textarea').remove();
                currentParagraph.siblings('.edit-paragr').show();
            }
        });
        
        removeButton.click(function () {
            $(this).parent().remove();
        });
        
        reviewButton.on("click", function () {
            var headingInput = $('#header'),
                heading = headingInput.val(),
                header = "<h2>" + heading + "</h2>",
                p = "";
            
            newParagraph.each(function () {
                p = p + "<p>" + $(this).children('p').html() + "</p>";
            });
            
            if (newParagraph.length !== 0 && heading !== '') {
                var articleHTML = 
                    "<article class='preview'>" +
                    "<span class='back' style='color: grey; float: right;'>Повернутись - подвійний клік по статті</span>" + header + p + 
                    "</article>",
                    previewArticle = $('article.preview'),
                    fieldSets = $('fieldset');
                
                fieldSets.hide();
                previewArticle.remove();
                $('form.write-article').append(articleHTML);
                
            } else if (heading == '') {
                headingInput.toggleClass('error');
                return false;
            }
            
            $('article').focus();

            previewArticle.dblclick(function () {
                $(this).remove();
                fieldSets.show();
            });
        });
    });

    sessionPreparationForm.submit(function () {
        var sellers = $(this).find('.form-item'),
            selectedSellers = sellers.has('input:checked'),
            input = $('#sellers'),
            amount = selectedSellers.length;
        if (amount == 0) {
            alert('Жодного продавця не вибрано!');
            return false;
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
};

$(document).ready(main);