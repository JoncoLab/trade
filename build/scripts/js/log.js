var main=function(){$("#login-form").submit(function(){$.permission=!1;var t=$(".error-data"),a=function(){var a=$("#login").val().trim(),e=$("#password").val().trim();$.ajax({url:"scripts/php/logDataValid.php",async:!1,type:"POST",dataType:"text",data:{login:a,password:e},success:function(a){switch(a){case"permitted":$.permission=!0,t.hide(300);break;case"denied":t.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="../../log.php">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,a,e){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+a+'":<br>'+t.status+" - "+e+'<br>Спробуйте <a href="../../log.php">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})};return function(){return a(),$.permission}()})};$(document).ready(main);