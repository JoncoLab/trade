'use strict';

var main = function () {
    var addDocsButton = $('button.add-docs'),
        input = $('#files'),
        resetButton = $('#reset'),
        manageButton = $('button.manage');

    addDocsButton.click(function () {
        var docs = $('#load-docs');
        docs.slideToggle(300);
        if (docs.css('display') === 'block') {
            docs.css('display', 'flex');
        }
    });

    input.change(function () {
        var html = '',
            files = this.files;
        for (var i = 0; i < files.length; i++) {
            html += '<figure><img src="SVG/doc.svg"><figcaption>' +
                (files[i].name.length > 18 ? (files[i].name.slice(0, 15) + '...') : files[i].name) +
                '</figcaption></figure>'
        }
        $('.files').html(html);
    });

    resetButton.click(function () {
        $('.files').empty();
    });

    manageButton.click(function () {
        alert('Ця функція тимчасово недоступна.');
    });
};

$(document).ready(main);