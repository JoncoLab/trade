'use strict';

var main = function () {
    $('button.add-docs').click(function () {
        var docs = $('#load-docs');
        docs.slideToggle(300);
        if (docs.css('display') === 'block') {
            docs.css('display', 'flex');
        }
    });

    var input = document.getElementById('files');
    input.addEventListener('change', function () {
        var html = '';
        for (var i = 0; i < this.files.length; i++) {
            html += '<figure><img src="SVG/doc.svg"><figcaption>' + this.files[i].name + '</figcaption></figure>'
        }
        $('.files').html(html);
    });

    $('#reset').click(function () {
        $('.files').empty();
    });
};

$(document).ready(main);