'use strict';

var main = function () {
    $('button.add-docs').click(function () {
        var docs = $('.load-docs');
        docs.slideToggle(300);
        if (docs.css('display') === 'block') {
            docs.css('display', 'flex');
        }
    });

    var dropZone = $('#drop-files'),
        tmpDragObject = $('.lot-num strong'),
        bg = dropZone.css('background-color'),
        border = dropZone.css('border-style');

    tmpDragObject.on('dragstart', {text: ''}, function (event) {
        event.data.text = event.target.id;
    });

    dropZone.on('drop', function (event) {
        event.preventDefault();
        var data = event.data.text;
        alert(data);
        $(this).css({
            'background-color': 'red',
            'border-style': 'solid'
        });
    });
    dropZone.on('dragenter', function () {
        $(this).css({
            'background-color': 'green',
            'border-style': 'solid'
        });
    });
    dropZone.on('dragover', function (event) {
        event.preventDefault();
    });
    dropZone.on('dragleave', function () {
        $(this).css({
            'background-color': bg,
            'border-style': border
        });
    });
};

$(document).ready(main);