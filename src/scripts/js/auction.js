/**
 * Created by Saladin on 14.02.2017.
 */
$(document).ready(function () {
    $('.fullscreen').click(function () {
        var page = document.documentElement;
        if (page.webkitRequestFullscreen) {
            page.webkitRequestFullscreen();
        } else if (page.mozRequestFullscreen) {
            page.mozRequestFullscreen();
        } else {
            page.requestFullscreen();
        }
        $('#fullscreen').fadeOut(500);
    });

    $('video').attr('autoplay', 'autoplay');
});