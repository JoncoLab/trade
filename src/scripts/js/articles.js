'use strict'

var main = function () {
    var showAtricle = function (heading) {
        var articles = $('.articles article'),
            targetArticle = $('.articles article[data-heading="' + heading + '"]');
        articles.each(function () {
            var currentArticleInLoop = $(this);
            if(currentArticleInLoop.is(targetArticle) && currentArticleInLoop.css('display') === 'none') {
                articles.slideUp(300);
                currentArticleInLoop.slideDown(300);
            }
        });
    },
        articlesList = $('.list'),
        articlesHeadings = articlesList.find('li'),
        articlesBox = $('.articles'),
        articlesListTargetPosition = {
            top: articlesBox.offset().top,
            right: articlesBox.offset().left + articlesList.width
        };

    articlesList.css({
        'top': articlesListTargetPosition.top,
        'right': articlesListTargetPosition.right
    });

    articlesList.slideDown(300);

    articlesHeadings.click(function () {
        var heading = $(this).data('heading');
        showAtricle(heading);
    });

    showAtricle($('.article-list li:last-of-type').data('heading'));
};

$(document).ready(main);