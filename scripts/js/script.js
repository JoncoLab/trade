'use strict';

var main = function () {
    var bgID = 2,
        changeBg = function (num) {
        var bg1 = 'images/bg1.png',
            bg2 = 'images/bg2.png',
            bg3 = 'images/bg3.png',
            bg4 = 'images/bg4.png',
            targetBg, opacity;

        if (bgID < 1 || bgID > 4) {
            bgID = 0;
            num = 1
        }

        switch (num) {
            case 1:
                targetBg = bg1;
                opacity = 0.6;
                break;
            case 2:
                targetBg = bg2;
                opacity = 0.8;
                break;
            case 3:
                targetBg = bg3;
                opacity = 0.7;
                break;
            case 4:
                targetBg = bg4;
                opacity = 0.8;
                break;
            default:
                targetBg = bg3;
                opacity = 0.7;
        }

        $('body').css({
            'background-color': 'rgba(247, 236, 243, ' + opacity + ')',
            'background-image': 'url("' + targetBg + '")'
        });
        bgID++;
    },
        setTime = function () {
            $('time').each(function () {
               $(this).html($(this).attr('datetime'));
            });
        };

    $('header .logo').click(function () {
        window.location.href = 'index.html';
    });

    setInterval(function () {
        changeBg(bgID);
    }, 10000);
    setTime();

    $('label').has('.checkbox').click(function () {
        $(this).children('.checkbox').toggleClass('checked');
    });
};

$(document).ready(main);