var main=function(){var t=null;$("#jur, #fiz").click(function(){var e=$("input:checked").attr("id"),a=$("#register");t!==e&&(a.slideUp(500,function(){a.load("assets/"+e+".html",function(){a.slideDown(500),a.css("display","flex")})}),t=e)}),$("#register").submit(function(t){$.mail_permission=!1,$.number_permission=!1,$.address_permission=!1,$.password_permission=!1,$.name_permission=!1,$.post_permission=!1;var e={mail:$(".error-mail"),password:$(".error-pass"),address:$(".error-address"),number:$(".error-number"),name:$(".error-name"),post:$(".error-post")},a=function(){var t=$("#email").val().trim();$.ajax({url:"scripts/php/regDataValid.php",async:!1,type:"POST",dataType:"text",data:{value:t,type:"email"},success:function(t){switch(t){case"permitted":$.mail_permission=!0,e.mail.hide(300);break;case"denied":e.mail.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,e,a){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+e+'":<br>'+t.status+" - "+a+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},r=function(){var t=$("#number").val().trim();$.ajax({url:"scripts/php/regDataValid.php",async:!1,type:"POST",dataType:"text",data:{value:t,type:"number"},success:function(t){switch(t){case"permitted":$.number_permission=!0,e.number.hide(300);break;case"denied":e.number.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,e,a){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+e+'":<br>'+t.status+" - "+a+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},s=function(){var t=$("#j-zip").val().trim()+", "+$("#j-country").val().trim()+", "+$("#j-region").val().trim()+" область, ";""!==$("#j-district").val().trim()&&(t+=$("#j-district").val().trim()+" район, "),t+=$("#j-city").val().trim()+", вул. "+$("#j-street").val().trim()+", "+$("#j-streetnum").val().trim()+"/"+$("#j-doornum").val().trim(),$.ajax({url:"scripts/php/regDataValid.php",async:!1,type:"POST",dataType:"text",data:{value:t,type:"address"},success:function(t){switch(t){case"permitted":$.address_permission=!0,e.address.hide(300);break;case"denied":e.address.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,e,a){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+e+'":<br>'+t.status+" - "+a+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},i=function(){var t=$("#full-name").val().trim();$.ajax({url:"scripts/php/regDataValid.php",async:!1,type:"POST",dataType:"text",data:{value:t,type:"name"},success:function(t){switch(t){case"permitted":$.name_permission=!0,e.name.hide(300);break;case"denied":e.name.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,e,a){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+e+'":<br>'+t.status+" - "+a+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},n=function(){var t=$("#password").val();$("#password-confirm").val()===t?($.password_permission=!0,e.password.hide(300)):e.password.show(300)},m=function(){""!==$("#country").val().trim()&&""!==$("#city").val().trim()&&""!==$("#region").val().trim()&&""!==$("#zip").val().trim()&&""!==$("#street").val().trim()&&""!==$("#streetnum").val().trim()&&""!==$("#doornum").val().trim()||(""===$("#country").val().trim()&&""===$("#city").val().trim()&&""===$("#region").val().trim()&&""===$("#zip").val().trim()&&""===$("#street").val().trim()&&""===$("#streetnum").val().trim()&&""===$("#doornum").val().trim()?(e.post.hide(300),$.post_permission=!0):(e.post.show(300),$.post_permission=!1))};(function(){return a(),r(),s(),i(),n(),m(),$.mail_permission&&$.number_permission&&$.address_permission&&$.name_permission&&$.password_permission&&$.post_permission})()||t.preventDefault()})};$(document).ready(main);