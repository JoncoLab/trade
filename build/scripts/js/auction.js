$(document).ready(function(){var e=$(".fullscreen"),t=$(".auction-table"),a={leave:$(".action button.leave"),raiseToSteps:$(".action button.raise-to-steps"),raiseToPrice:$(".action button.raise-to-price")},s=$(".info .messages .wrapper"),n=$(".info .trader-id").text(),i=$("main section"),o=i.height,c=$("#raise-to-amount"),r=function(e,t){$.ajax({url:"scripts/php/trade-session.php",data:{function:e,value:t,who:n},method:"post"})},l=function(e){$.ajax({url:"scripts/php/trade-session.php",data:{function:e,who:n},method:"post"})};e.click(function(){var e=document.documentElement,t=$("#fullscreen");e.webkitRequestFullscreen?e.webkitRequestFullscreen():e.mozRequestFullscreen?e.mozRequestFullscreen():e.requestFullscreen(),t.fadeOut(500)}),a.leave.click(function(){l("leave")}),a.raiseToPrice.click(function(){c.val()<=c.attr("min")?(c.val(c.attr("min")),c.focus()):r("raiseToPrice",c.val())}),a.raiseToSteps.click(function(){r("raiseToSteps",$("#raise-to-steps").val())}),i.css({"max-height":o}),setInterval(function(){t.load("assets/auction-table.php"),s.load("assets/auction-chat.html"),c.attr("min",t.find(".cost-final").text())},1e3)});