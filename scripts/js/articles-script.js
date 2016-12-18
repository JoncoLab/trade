'use strict'

var main = function () {
    var showAtricle = function (heading) {
        $('.articles article:not([data-heading="' + heading + '"])').slideUp(600, function () {
            setTimeout(function () {
                $('.articles article[data-heading="' + heading + '"]').slideDown(600);
            }, 600);
        });
    };

    $('.article-list li').click(function () {
        var heading = $(this).data('heading');
        showAtricle(heading);
    });

    showAtricle($('.article-list li:last-of-type').data('heading'));
};

$(document).ready(main);