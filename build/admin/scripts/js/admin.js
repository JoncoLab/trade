"use strict";var main=function(){var e=$(".navbar").height(),a=$("main"),t=$("table.users, table.lots"),r=$("header .navbar button"),i=$(".users td.ver"),n=i.children(".verification-form"),s=function(e){var a=$("#loading");switch(e){case!0:a.show(0,function(){a.css({display:"flex"})});break;case!1:a.hide();break;default:alert("Сталася помилка! Сторінку буде перезавантажено!"),window.location.reload()}},c=$("form .content"),l=c.children(".add-paragr");a.css("margin-top",e+20+"px"),t.DataTable({iDisplayLength:10}),r.click(function(){var e=$(".page-maker"),a=$('[id$="_wrapper"]'),t=$(this).attr("id"),r=$("#DataTables_Table_1_wrapper"),i=$("#DataTables_Table_0_wrapper");switch(e.hide(),a.hide(),$("."+t).toggle(),t){case"users":r.show();break;case"lots":i.show()}}),n.on("submit",function(){var e=$(this).parents("td"),a=e.siblings(".id").text(),t=$(this).children(".set-trader-id").val(),r=$("body");return s(!0),$.ajax({url:"scripts/php/admin-verify.php",dataType:"html",method:"POST",data:{id:a,traderId:t},success:function(e){s(!1),r.prepend(e)},error:function(){s(!1),alert("Не вдається з'єднатися з базою даних! Сторінку буде перезавантажено!"),window.location.reload()}}),!1}),l.click(function(){var e=$(".content textarea").val(),a=c.children("textarea"),t=$(".clear"),r=$(".watch");""!==e&&(c.append('<div class="new-paragr"><button class="remove-paragr" type="button">Стерти</button><button class="edit-paragr" type="button">Редаг</button><button type="button" class="edited">OK</button><p class="paragraph">'+e+"</p></div>"),a.val(""));var i=$(".content .new-paragr"),n=i.children(".edit-paragr"),s=i.children(".edited"),l=i.children(".remove-paragr");t.click(function(){a.val("")}),n.unbind().on("click",function(){var e=$(this),a=e.siblings("p").html(),t=e.siblings("textarea, p"),r=e.siblings(".edited");t.remove(),e.parent().prepend('<textarea autofocus rows="12" tabindex="1">'+a+"</textarea>"),e.hide(),r.show(),e.siblings("textarea").focus()}),s.click(function(){var e=$(this),a=e.siblings("textarea").text();""!==a&&(e.siblings("p").remove(),e.parent().append("<p>"+a+"</p>"),e.hide(),e.siblings("textarea").remove(),e.siblings(".edit-paragr").show())}),l.click(function(){$(this).parent().remove()}),r.on("click",function(){var e=$("#header"),a=e.val(),t="<h2>"+a+"</h2>",r="";if(i.each(function(){r=r+"<p>"+$(this).children("p").html()+"</p>"}),0!==i.length&&""!==a){var n="<article class='preview'><span class='back' style='color: grey; float: right;'>Повернутись - подвійний клік по статті</span>"+t+r+"</article>",s=$("article.preview"),c=$("fieldset");c.hide(),s.remove(),$("form.write-article").append(n)}else if(""==a)return e.toggleClass("error"),!1;$("article").focus(),s.dblclick(function(){$(this).remove(),c.show()})})})};$(document).ready(main);