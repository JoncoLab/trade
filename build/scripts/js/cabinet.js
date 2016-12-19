'use strict';

var main = function () {
    $('button.add-docs').click(function () {
        var docs = $('.load-docs');
        docs.slideToggle(300);
        if (docs.css('display') === 'block') {
            docs.css('display', 'flex');
        }
    });

    var $dropZone = $('#drop-files'),
        bg = $dropZone.css('background-color'),
        border = $dropZone.css('border-style');

    $dropZone.droppable();

    $dropZone.on({
        dragenter: function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).css({
                'background-color': 'white',
                'border-style': 'solid'
            });
        },
        dragover: function (event) {
            event.preventDefault();
            event.stopPropagation();
        },
        dragleave: function () {
            $(this).css({
                'background-color': bg,
                'border-style': border
            });
        },
        mouseleave: function () {
            $(this).css({
                'background-color': bg,
                'border-style': border
            });
        }
    });
},
    doDrop = function (event) {
        var dt = DataTransfer;
        alert(dt);
    };

$(document).ready(main);