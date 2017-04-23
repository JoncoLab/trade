/**
 * Created by Saladin on 13.02.2017.
 */

var main = function () {
    var applicationNumbersCount = function () {
            var fivePercent = $('.five-percent'),
                fivePercentInput = $('#five-percent'),
                fivePercentValue = 0,
                applicationSize = $('.application-numbers .application-size'),
                applicationSizeInput = $('#application-size'),
                applicationSizeValue = 0,
                applicationSum = $('.application-numbers .application-sum'),
                applicationSumInput = $('#application-sum'),
                applicationSumValue = 0;
            lots.each(function () {
                if ($(this).is('.checked')) {
                    fivePercentValue = (fivePercentValue + parseInt($(this).children('.price-start').text()) * 0.05);
                    applicationSizeValue = applicationSizeValue + parseInt($(this).children('.size').text());
                    applicationSumValue = applicationSumValue + parseInt($(this).children('.price-start').text());
                }
            });
        fivePercent.text(fivePercentValue + ' грн.');
        fivePercentInput.val(fivePercentValue);
        applicationSize.text(applicationSizeValue);
        applicationSizeInput.val(applicationSizeValue);
        applicationSum.text(applicationSumValue + ' грн.');
        applicationSumInput.val(applicationSumValue);
        },
        lots = $('.lots tbody tr'),
        bankDetails = $('#bank-details'),
        sender = $('#application');

    lots.click(function () {
        var checkCell = $(this).children('.check'),
            checkBox = checkCell.children('input');
        $(this).toggleClass('checked');
        if ($(this).is('.checked')) {
            checkBox.attr('checked', 'checked');
            checkBox.val('selected');
        } else {
            checkBox.removeAttr('checked');
            checkBox.val('');
        }
        applicationNumbersCount();
    });

    bankDetails.change(function () {
        var value = $(this).val(),
            fieldsToFill = $('.bank-details');
        fieldsToFill.text(value);
        if (value.trim() !== '') {
            fieldsToFill.css({
                'color': 'deepskyblue'
            });
        } else {
            fieldsToFill.css({
                'color': '#97a29e'
            });
        }
    });

    sender.children('#reset').click(function () {
        var bankDetails = $('.bank-details'),
            checkboxes = $('.lots td.check input');
        lots.removeClass('checked');
        checkboxes.removeAttr('checked');
        applicationNumbersCount();
        bankDetails.css({
            'color': '#97a29e'
        });
        bankDetails.text('Банківські реквізити заявника');
    });

    sender.submit(function (event) {
        var selectedLots = lots.has('input:checked');
        if (selectedLots.length == 0) {
            event.preventDefault();
        }
    });
};
$(document).ready(main);