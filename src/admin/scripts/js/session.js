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
            endSession: $('button.end-session'),
            setWinner: $('button.set-winner-button'),
            write: $('button.write-button')
        },
        chat = $('.chat .messages'),
        usersOnline = $('ul.users'),
        timer = $('.timer'),
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
                    function: functionType,
                    who: 'Ліцетатор'
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
                    who: 'Ліцетатор'
                },
                method: 'post'
            });
        },
        load = function () {
            auctionTable.load('../../../assets/auction-table.php');
            chat.load('../../../assets/auction-chat.html');
            usersOnline.load('../../../assets/users-online.php');
            changeData('timer');
            timer.load('../../../assets/timer.php');
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
    buttons.endSession.click(function () {
        changeData('end');
        window.location.replace('admin.php');
    });
    buttons.setWinner.click(function () {
        var winner = $('#set-winner').val();
        insertData('setWinner', winner);
    });
    buttons.write.click(function () {
        var message = $('#write').val();
        insertData('write', message);
    });

    load();

    setInterval(load, 1000);
};

$(document).ready(main);