var startTrade=function(){var t=0,e=$(".trade button.add-step"),r=$(".trade button.remove-step"),a=$(".trade button.next-lot"),s=$(".trade button.previous-lot"),d=$(".trade button.end-trade"),c=$(".trade .set-final-cost button"),n=$("#set-final-cost"),i=$(".trade td.current-step"),o=parseInt($(".trade td.step").text()),l=parseInt($(".trade td.size").text()),x=parseInt($(".trade td.cost-start").text()),p=$(".trade td.cost-final"),u=$(".trade td.price-final"),h=$(".trade td.id").text(),f=$(".trade td.type").text(),m=$(".trade td.breed").text(),b=$(".trade .admin-info"),v=$(".trade td.customers-applied"),k=$(".trade td.customer-number"),I=function(){var t=parseInt(i.text()),e=x+t*o,r=e*l;p.text(e),u.text(r)},g=function(t){$(".trade td.seller-name").text(lots[t].sellerName),$(".trade td.id").text(lots[t].id),$(".trade td.type").text(lots[t].type),$(".trade td.characteristics-diametr").text(lots[t].characteristicsDiametr),$(".trade td.characteristics-sort").text(lots[t].characteristicsSort),$(".trade td.breed").text(lots[t].breed),$(".trade td.characteristics-length").text(lots[t].characteristicsLength),$(".trade td.characteristics-storage").text(lots[t].characteristicsStorage),$(".trade td.gost").text(lots[t].gost),$(".trade td.size").text(lots[t].size),$(".trade td.customers-applied").text(lots[t].customersApplied),$(".trade td.cost-start").text(lots[t].costStart),$(".trade td.step").text(lots[t].step),i.text(0),h=$(".trade td.id").text(),f=$(".trade td.type").text(),m=$(".trade td.breed").text(),l=parseInt($(".trade td.size").text()),x=parseInt($(".trade td.cost-start").text())},y=function(){if(""!==v.text().trim()){var t=v.text().split(", "),e="";t.forEach(function(r,a){e+='<span class="customer">'+r+"</span>",a===t.length-1?e+=";":e+=", "}),v.html(e);v.children(".customer").click(function(){var t=$(this).text();k.text(t)})}n.attr({min:x,value:x,step:o}),b.text("№"+h+", "+f+", "+m+", "+l+" куб., "+x+" грн.")},w=function(){var t=parseInt(i.text()),e=t+1;i.text(e),I()},z=function(){var t=parseInt(i.text()),e=0===t?0:t-1;i.text(e),I()},S=function(){var t=parseInt(n.val())>=parseInt(n.attr("min"))?parseInt(n.val()):parseInt(n.attr("min")),e=Math.ceil((t-x)/o),r=t*l;p.text(t),i.text(e),u.text(r)},T=function(){t>=lots.length-1?t=lots.length-1:t++,g(t),I(),y()},A=function(){t<=0?t=0:t--,g(t),I(),y()},D=function(){$(".trade *").hide(),$(".trade .start-trade").show()};I(),y(),e.click(w),r.click(z),a.click(T),s.click(A),d.click(D),c.click(S),$(document).keydown(function(t){switch(t.which){case 107:w();break;case 109:z();break;case 13:D();break;case 111:A();break;case 106:T()}}),$(".trade *:not(.start-trade):not(script)").show()};$(document).ready(startTrade);