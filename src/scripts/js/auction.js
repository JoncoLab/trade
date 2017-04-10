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
        chat = $('.info .messages'),
        traderId = $('.info .trader-id').text(),
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
        insertData('raiseToPrice', $('#raise-to-amount').val());
    });
    buttons.raiseToSteps.click(function () {
        insertData('raiseToSteps', $('#raise-to-steps').val());
    });

    setInterval(function () {
        auctionTable.load('assets/auction-table.php');
        chat.load('assets/auction-chat.html');
    }, 500);
});