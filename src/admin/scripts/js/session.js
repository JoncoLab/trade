/**
 * Created by Saladin on 03.04.2017.
 */

var startTrade = function () {
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

$(document).ready(startTrade);