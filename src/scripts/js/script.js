'use strict';

var main = function () {
    var changeBg = function (num) {
        var bg1 = 'images/bg1.png',
            bg2 = 'images/bg2.png',
            bg3 = 'images/bg3.png',
            bg4 = 'images/bg4.png',
            targetBg, opacity;

        alert(num);

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
    },
        setTime = function () {
            $('time').each(function () {
               $(this).html($(this).attr('datetime'));
            });
        },
        logo = $('header .logo'),
        mainMenu = $('.main-menu'),
        clickableMenuElements = $('.main-menu .menu-icon, .main-menu > span'),
        menuIcon = mainMenu.children('.menu-icon'),
        dropdownMenu = mainMenu.children('ul');

    clickableMenuElements.hover(function () {
        menuIcon.css('transform', 'scale(1.15)');
    }, function () {
        menuIcon.css('transform', 'scale(1)');
    });

    clickableMenuElements.click(function () {
        dropdownMenu.fadeToggle(300);
    });

    $(document).mouseup(function (e) {
        var toCloseWindows = dropdownMenu;
        if (toCloseWindows.has(e.target).length === 0) {
            toCloseWindows.fadeOut(300);
        }
    });

    logo.click(function () {
        window.location.href = 'index.html';
    });

    changeBg(parseInt(Math.random() * 5));

    setTime();
};

$(document).ready(main);