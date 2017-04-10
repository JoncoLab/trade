/**
 * Created by Saladin on 13.02.2017.
 */

var main = function () {
    var fivePercentCount = function () {
            var fivePercent = $('.five-percent .value');
            fivePercent.text(function () {
                var value = 0;
                lots.each(function () {
                    if ($(this).is('.checked')) {
                        value = value + parseInt($(this).children('.price-start').text());
                    }
                });
                return value * 0.05 + ' грн.';
            });
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
        fivePercentCount();
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
        fivePercentCount();
        bankDetails.css({
            'color': '#97a29e'
        });
        bankDetails.text('Банківські реквізити заявника');
    });
};
$(document).ready(main);