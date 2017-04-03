'use strict';
var main = function () {
    var height = $('.navbar').css('height');
    $('main').css({
        'margin-top': height,
        'padding-top': height
    });

    $('table.users, table.lots').DataTable({
        "iDisplayLength": 10
    });

    $('header .navbar button').click(function () {
        $('.page-maker').hide();
        $('[id$="_wrapper"]').hide();
        var classId = $(this).attr('id');
        $('.' + classId).toggle();
        switch (classId) {
            case 'users':
                $('#DataTables_Table_1_wrapper').show();
                break;
            case 'lots':
                $('#DataTables_Table_0_wrapper').show();
                break;
        }
    });

    var setVerificationButton = function () {
        return $(this).text() === 'Верифікований' ? null : (
            '<form class="verification-form">' +
                '<input type="text" name="set-trader-id" class="set-trader-id" maxlength="4" pattern="[0-9]{3}" placeholder="Реєстр. №">' +
                '<label class="verify">Верифікувати<input style="display: none;" type="submit" name="submit" value="verify"></label>' +
            '</form>'
        );
    };

    $('.users td.ver').append(setVerificationButton);
    $('.users .verification-form').on('submit', function () {
        var verCell = $(this).parents('td'),
            id = verCell.siblings('.id').text(),
            traderId = $(this).children('.set-trader-id').val(),
            loading = function(status) {
                var loading = $('#loading');
                switch (status) {
                    case true:
                        loading.show();
                        loading.css({
                            'display': 'flex'
                        });
                        break;
                    case false:
                        loading.hide();
                        break;
                    default:
                        alert('Сталася помилка! Сторінку буде перезавантажено!');
                        window.location.reload();
                }
            };
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
                $('body').prepend(data);
            },
            error: function () {
                loading(false);
                alert('Не вдається з\'єднатися з базою даних! Сторінку буде перезавантажено!');
                window.location.reload();
            }
        });
        return false;
    });

    $('form .content .add-paragr').click(function () {
        var paragraph = $('.content textarea').val();
        if (paragraph !== '') {
            $('.content').append('<div class="new-paragr"><button class="remove-paragr" type="button">Стерти</button><button class="edit-paragr" type="button">Редаг</button><button type="button" class="edited">OK</button><p class="paragraph">' + paragraph + '</p></div>');
            $('.content > textarea').val('');
        }
        $('.clear').click(function () {
            $('.content >textarea').val('');
        });
        $('.edit-paragr').unbind().on('click', function () {
            var editStuff = $(this).siblings('p').html();
            $(this).siblings('textarea').remove();
            $(this).parent().prepend('<textarea autofocus rows="12" tabindex="1">' + editStuff + '</textarea>');
            $(this).siblings('p').remove();
            $(this).hide();
            $(this).siblings('.edited').show();
            $(this).siblings('textarea').focus();
        });
        $('.content .new-paragr .edited').click(function () {
            var editedParagr = $(this).siblings('textarea').text();
            if (editedParagr !== '') {
                $(this).siblings('p').remove();
                $(this).parent().append('<p>' + editedParagr + '</p>');
                $(this).hide();
                $(this).siblings('textarea').remove();
                $(this).siblings('.edit-paragr').show();
            }
        });
        $('.content .new-paragr .remove-paragr').click(function () {
            $(this).parent().remove();
        });
        $('.watch').on("click", function () {
            var header = "<h2>" + $('#header').val() + "</h2>";
            var p = "";
            $('.new-paragr').each(function () {
                p = p + "<p>" + $(this).children('p').html() + "</p>";
            });
            if ($('.new-paragr').length !== 0 && $('#header').val() !== '') {
                var article = "<article class='preview'> <span class='back' style='color: grey; float: right;'>повернутись - подвійний клік по статті</span>" + header + p + "</article>";
                $('fieldset').hide();
                $('article.preview').remove();
                $('form.write-article').append(article);
            }
            else if ($('#header').val() == '') {
                $('#header').toggleClass('error');
                return false;
            }
            $('article').focus();
            $('article.preview').dblclick(function () {
                $(this).remove();
                $('fieldset').show();
            });
        });
    });
},
    startTrade = function () {
        var iterator = 0,
            addStepButton = $('.trade button.add-step'),
            removeStepButton = $('.trade button.remove-step'),
            nextLotButton = $('.trade button.next-lot'),
            previousLotButton = $('.trade button.previous-lot'),
            endTradeButton = $('.trade button.end-trade'),
            setFinalCostButton = $('.trade .set-final-cost button'),
            setFinalCostInput = $('#set-final-cost'),
            currentStep = $('.trade td.current-step'),
            stepSize = parseInt($('.trade td.step').text()),
            size = parseInt($('.trade td.size').text()),
            costStart = parseInt($('.trade td.cost-start').text()),
            costFinal = $('.trade td.cost-final'),
            priceFinal = $('.trade td.price-final'),
            id = $('.trade td.id').text(),
            type = $('.trade td.type').text(),
            breed = $('.trade td.breed').text(),
            adminInfo = $('.trade .admin-info'),
            customersApplied = $('.trade td.customers-applied'),
            customerNumber = $('.trade td.customer-number'),
            setValues = function () {
                var step = parseInt(currentStep.text()),
                    finalCost = costStart + (step * stepSize),
                    finalPrice = finalCost * size;
                costFinal.text(finalCost);
                priceFinal.text(finalPrice);
            },
            setTable = function (iterator) {
                $('.trade td.seller-name').text(lots[iterator].sellerName);
                $('.trade td.id').text(lots[iterator].id);
                $('.trade td.type').text(lots[iterator].type);
                $('.trade td.characteristics-diametr').text(lots[iterator].characteristicsDiametr);
                $('.trade td.characteristics-sort').text(lots[iterator].characteristicsSort);
                $('.trade td.breed').text(lots[iterator].breed);
                $('.trade td.characteristics-length').text(lots[iterator].characteristicsLength);
                $('.trade td.characteristics-storage').text(lots[iterator].characteristicsStorage);
                $('.trade td.gost').text(lots[iterator].gost);
                $('.trade td.size').text(lots[iterator].size);
                $('.trade td.customers-applied').text(lots[iterator].customersApplied);
                $('.trade td.cost-start').text(lots[iterator].costStart);
                $('.trade td.step').text(lots[iterator].step);
                currentStep.text(0);
                id = $('.trade td.id').text();
                type = $('.trade td.type').text();
                breed = $('.trade td.breed').text();
                size = parseInt($('.trade td.size').text());
                costStart = parseInt($('.trade td.cost-start').text());
            },
            setTools = function () {
                if (customersApplied.text().trim() !== '') {
                    var customers = customersApplied.text().split(', '),
                        customersHTML = '';
                    customers.forEach(function (customer, i) {
                        customersHTML += '<span class="customer">' + customer + '</span>';
                        if (i === customers.length - 1) {
                            customersHTML += ';';
                        } else {
                            customersHTML += ', ';
                        }
                    });
                    customersApplied.html(customersHTML);
                    var customer = customersApplied.children('.customer');
                    customer.click(function () {
                        var text = $(this).text();
                        customerNumber.text(text);
                    });
                }
                setFinalCostInput.attr({
                    'min': costStart,
                    'value': costStart,
                    'step': stepSize
                });
                adminInfo.text('№' + id + ', ' + type + ', ' + breed + ', ' + size + ' куб., ' + costStart + ' грн.');
            },
            addStep = function () {
                var currentValue = parseInt(currentStep.text()),
                    newValue = currentValue + 1;
                currentStep.text(newValue);
                setValues();
            },
            removeStep = function () {
                var currentValue = parseInt(currentStep.text()),
                    newValue = currentValue === 0 ? 0 : (currentValue - 1);
                currentStep.text(newValue);
                setValues();
            },
            setFinalCost = function () {
                var finalCost = (parseInt(setFinalCostInput.val()) >= parseInt(setFinalCostInput.attr('min'))) ? parseInt(setFinalCostInput.val()) : parseInt(setFinalCostInput.attr('min')),
                    step = Math.ceil((finalCost - costStart) / stepSize),
                    price = finalCost * size;
                costFinal.text(finalCost);
                currentStep.text(step);
                priceFinal.text(price);
            },
            nextLot = function () {
                if (iterator >= lots.length - 1) {
                    iterator = lots.length - 1;
                } else {
                    iterator++;
                }
                setTable(iterator);
                setValues();
                setTools();
            },
            previousLot = function () {
                if (iterator <= 0) {
                    iterator = 0;
                } else {
                    iterator--;
                }
                setTable(iterator);
                setValues();
                setTools();
            },
            endTrade = function () {
                $('.trade *').hide();
                $('.trade .start-trade').show();
            };
        setValues();
        setTools();
        addStepButton.click(addStep);
        removeStepButton.click(removeStep);
        nextLotButton.click(nextLot);
        previousLotButton.click(previousLot);
        endTradeButton.click(endTrade);
        setFinalCostButton.click(setFinalCost);
        $(document).keydown(function (event) {
            switch (event.which) {
                case 107:
                    addStep();
                    break;
                case 109:
                    removeStep();
                    break;
                case 13:
                    endTrade();
                    break;
                case 111:
                    previousLot();
                    break;
                case 106:
                    nextLot();
                    break;
            }
        });
        $('.trade *:not(.start-trade):not(script)').show();
    };

$(document).ready(main);