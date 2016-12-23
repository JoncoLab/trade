'use strict';

var main = function () {
    $('button.add-docs').click(function () {
        var docs = $('.load-docs');
        docs.slideToggle(300);
        if (docs.css('display') === 'block') {
            docs.css('display', 'flex');
        }
    });

    var input = document.getElementById('files');
    input.addEventListener('change', function () {
        var html = '<ul>';
        for (var i = 0; i < this.files.length; i++) {
            html += '<li>' + this.files[i].name + ' - ' + this.files[i].size + '</li>'
        }
        html += '</ul>';
        $('.files').html(html);
    });
};

$(document).ready(main);