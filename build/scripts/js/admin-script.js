'use strict';
var main;
main = function () {
    $('.page-maker').hide();
    $('.write-article.page-maker').show();
    $('table').DataTable({
        "iDisplayLength": 25
    });
    $('header .navbar button').click(function () {
        $('.page-maker').hide();
        var classId = $(this).attr('id');
        $('.' + classId).toggle();
        if (classId === 'users') {
            $('#DataTables_Table_0_wrapper').show(0);
        }
        else {
            $('#DataTables_Table_0_wrapper').hide(0);
        }
    });
    $('form .content .add-paragr').click(function () {
        var paragraph = $('.content textarea').val();
        if (paragraph !== '') {
            $('.content').append('<div class="new-paragr"><button class="remove-paragr" type="button">Стерти</button><button class="edit-paragr" type="button">Редаг</button><button type="button" class="edited">OK</button><p class="paragraph">' + paragraph + '</p></div>');
            $('.content > textarea').val('');
        }
        $('.clear').click(function () {
            $('.content >textarea').val('');
        });
        $('.edit-paragr').unbind().on('click', function () {
            var editStuff = $(this).siblings('p').html();
            $(this).siblings('textarea').remove();
            $(this).parent().prepend('<textarea autofocus rows="12" tabindex="1">' + editStuff + '</textarea>');
            $(this).siblings('p').remove();
            $(this).hide();
            $(this).siblings('.edited').show();
            $(this).siblings('textarea').focus();
        });
        $('.content .new-paragr .edited').click(function () {
            var editedParagr = $(this).siblings('textarea').text();
            if (editedParagr !== '') {
                $(this).siblings('p').remove();
                $(this).parent().append('<p>' + editedParagr + '</p>');
                $(this).hide();
                $(this).siblings('textarea').remove();
                $(this).siblings('.edit-paragr').show();
            }
        });
        $('.content .new-paragr .remove-paragr').click(function () {
            $(this).parent().remove();
        });
        $('.watch').on("click", function () {
            var header = "<h2>" + $('#header').val() + "</h2>";
            var p = "";
            $('.new-paragr').each(function () {
                p = p + "<p>" + $(this).children('p').html() + "</p>";
            });
            if ($('.new-paragr').length !== 0 && $('#header').val() !== '') {
                var article = "<article class='preview'> <span class='back' style='color: grey; float: right;'>повернутись - подвійний клік по статті</span>" + header + p + "</article>";
                $('fieldset').hide();
                $('article.preview').remove();
                $('form.write-article').append(article);
            }
            else if ($('#header').val() == '') {
                $('#header').toggleClass('error');
                return false;
            }
            $('article').focus();
            $('article.preview').dblclick(function () {
                $(this).remove();
                $('fieldset').show();
            })
        });
    });
};
$(document).ready(main);