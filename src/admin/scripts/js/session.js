/**
 * Created by Saladin on 03.04.2017.
 */

var main = function () {
    var auctionTable = $('main .auction-table'),
        lots = $('.all .id'),
        tradeSession = '../../../scripts/php/trade-session.php',
        buttons = {
            addStep: $('button.add-step'),
            removeStep: $('button.remove-step'),
            raiseToPrice: $('button.raise-to-price'),
            nextLot: $('button.next-lot'),
            previousLot: $('button.previous-lot'),
            endSession: $('button.end-session')
        },
        chat = $('.chat'),
        switchLot = function (id) {
            var targetLot = $(".all .id:contains(\'" + id + "\')");
            $.ajax({
                url: tradeSession,
                data: {
                    function: 'switch',
                    id: id
                },
                method: 'post',
                success: function () {
                    lots.removeClass('selected');
                    targetLot.addClass('selected');
                }
            });
        },
        changeData = function (functionType) {
            $.ajax({
                url: tradeSession,
                data: {
                    function: functionType
                },
                method: 'post'
            });
        },
        insertData = function (functionType, value) {
            $.ajax({
                url: tradeSession,
                data: {
                    function: functionType,
                    value: value,
                    who: 'Адміністратор'
                },
                method: 'post'
            });
        };

    lots.click(function () {
        var id = $(this).text();
        switchLot(id);
    });

    buttons.addStep.click(function () {
        changeData('addStep');
    });

    buttons.removeStep.click(function () {
        changeData('removeStep');
    });

    buttons.raiseToPrice.click(function () {
        insertData('raiseToPrice', $('#set-final-cost').val());
    });

    buttons.nextLot.click(function () {
        var currentLot = $('.selected'),
            newId = (currentLot.is('.id:last-child')) ? (currentLot.text()) : (currentLot.next('.id').text());
        switchLot(newId);
    });

    buttons.previousLot.click(function () {
        var currentLot = $('.selected'),
            newId = (currentLot.is('.id:first-child')) ? (currentLot.text()) : (currentLot.prev('.id').text());
        switchLot(newId);
    });

    switchLot(lots.first().text());
    setInterval(function () {
        auctionTable.load('../../../assets/auction-table.php');
        chat.load('../../../assets/auction-chat.html');
    }, 500);
};

$(document).ready(main);