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
            raiseToPrice: $('.action button.raise-to-price')
        },
        chat = $('.info .messages .wrapper'),
        users = $('ul.users'),
        traderId = $('.info .trader-id').text(),
        section = $('main section'),
        height = section.height,
        raiseToPrice = $('#raise-to-amount'),
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
            raiseToPrice.attr('min', auctionTable.find('.cost-final').text());
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

    section.css({
        'max-height': height
    });

    load();

    setInterval(load, 1000);
});