/**
 * Created by Saladin on 14.02.2017.
 */
$(document).ready(function () {
    var fullScreenRequest = $('.fullscreen'),
        auctionTable = $('.auction-table'),
        tradeSession = 'scripts/php/trade-session.php',
        buttons = {
            leave: $('.action button.leave'),
            raiseToSteps: $('.action button.raise-to-steps'),
            raiseToPrice: $('.action button.raise-to-price'),
            takePart: $('.action button.take-part')
        },
        chat = $('.info .messages .wrapper'),
        users = $('ul.users'),
        traderId = $('header .additional .trader-id').text(),
        raiseToPrice = $('#raise-to-amount'),
        selfOnlineStatus = $('header .additional .self-online-status'),
        finalPrice = 0,
        insertData = function (functionType, value) {
            $.ajax({
                url: tradeSession,
                data: {
                    function: functionType,
                    value: value,
                    who: traderId
                },
                method: 'post'
            });
        },
        changeData = function (functionType) {
            $.ajax({
                url: tradeSession,
                data: {
                    function: functionType,
                    who: traderId
                },
                method: 'post'
            });
        },
        load = function () {
            auctionTable.load('assets/auction-table.php');
            chat.load('assets/auction-chat.html');
            users.load('assets/users-online.php');
            $.ajax({
                url: 'assets/self-online-status.php',
                method: 'POST',
                data: {
                    trader_id: traderId
                },
                dataType: 'text',
                success: function (text) {
                    selfOnlineStatus.text(text);
                },
                error: function () {
                    selfOnlineStatus.text('ERROR');
                },
                complete: function () {
                    if (selfOnlineStatus.text() == 'Торгується' && !selfOnlineStatus.is('.online')) {
                        selfOnlineStatus.addClass('online');
                    } else if (selfOnlineStatus.text() !== 'Торгується') {
                        selfOnlineStatus.removeClass('online');
                    }
                }
            });
            raiseToPrice.attr('min', auctionTable.find('.cost-final').text());
            var finalPriceCell = auctionTable.find('.price-final'),
                newPrice = parseInt(finalPriceCell.text());
            if (finalPrice != newPrice) {
                finalPriceCell.addClass('blink');
                finalPrice = newPrice;
            }
        };

    fullScreenRequest.click(function () {
        var page = document.documentElement,
            fullScreenWindow = $('#fullscreen');
        if (page.webkitRequestFullscreen) {
            page.webkitRequestFullscreen();
        } else if (page.mozRequestFullscreen) {
            page.mozRequestFullscreen();
        } else {
            page.requestFullscreen();
        }
        fullScreenWindow.fadeOut(500);
    });

    buttons.leave.click(function () {
        changeData('leave');
    });
    buttons.raiseToPrice.click(function () {
        if (raiseToPrice.val() <= raiseToPrice.attr('min')) {
            raiseToPrice.val(raiseToPrice.attr('min'));
            raiseToPrice.focus();
        } else {
            insertData('raiseToPrice', raiseToPrice.val());
        }
    });
    buttons.raiseToSteps.click(function () {
        insertData('raiseToSteps', $('#raise-to-steps').val());
    });
    buttons.takePart.click(function () {
        changeData('takePart');
    });

    $(window).on('beforeunload', function () {
        changeData('leave');
        return 'Намагайтеся не виходити зі сторінки аукціону під час сесії.';
    });

    load();

    setInterval(load, 1000);
});