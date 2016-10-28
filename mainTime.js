var mm2RU=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
     wdRU=["воскресенье","понедельник","вторник","среда","четверг","пятница","суббота"],
	  mmRU=["января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"],
	  oldSeconds = 0,
	  delta = 0;
 $.ajax({type:'POST',
          url:'backend.php',
		 data:{'meth':'sync'},
	  success:function(result){ var evDS = JSON.parse(result, function(key, value) { return value;}); delta = (Date.now()-evDS.time);}
	  }); 	  

function now_date_clock () {
	
					    Data = new Date();
						Data.setTime(Data.getTime() - window.delta);
					    H_serv = Data.getHours();
                        Min_serv = Data.getMinutes();
                        Sec_serv = Data.getSeconds();
						if (H_serv<10) H_serv = '0' +H_serv;
						if (Min_serv<10) Min_serv = '0'+Min_serv;
						if (Sec_serv<10) Sec_serv = '0'+Sec_serv;
						dd = Data.getDate();
						if (dd<10) dd =' '+dd;
						mm = Data.getMonth();
						yy = Data.getFullYear();
						wd = Data.getDay();
						Data_str = dd + ' ' + window.mmRU[mm] + ' ' + yy + ' г.';
						document.getElementById('datastr').innerHTML =  Data_str ;
						timeserv = H_serv+':'+Min_serv+':'+Sec_serv;
						weekday = window.wdRU[wd];
						monthi = window.mm2RU[mm];
						Data_in = {dat:Data,ts:timeserv,week:weekday,mon:monthi,yynow:yy};
						Data_in = JSON.stringify(Data_in);
						return Data_in;
};
function new_calendar (d) {
	var D1 = new Date(d),
        D1last = new Date(D1.getFullYear(),D1.getMonth()+1,0).getDate(), // последний день месяца
        D1Nlast = new Date(D1.getFullYear(),D1.getMonth(),D1last).getDay() , // день недели последнего дня месяца
        D1Nfirst = new Date(D1.getFullYear(),D1.getMonth(),1).getDay(), // день недели первого дня месяца
		D0last = new Date(D1.getFullYear(),D1.getMonth(),0).getDate(), // последний день прошлого месяца
        calendar1 = '<tr>',
	    j = 1; // первый день следующего месяца
 
        //  клетки до первого дня текущего месяца
        if (D1Nfirst == 0) { D1Nfirst = 7;};
    	D0last -= D1Nfirst - 2;
        for(var  i = D1Nfirst; i > 1 ; i--) { calendar1 +=  '<td class="an_mon">' + D0last++ +'</td>'; };
        // дни месяца
        for(var  i = 1; i <= D1last; i++) {
           if (i != D1.getDate()) {calendar1 += '<td>' + i + '</td>';}
		   else {calendar1 += '<td id="today">' + i + '</td>';  // сегодняшней дате можно задать стиль CSS
	            }
           if (new Date(D1.getFullYear(),D1.getMonth(),i).getDay() == 0) {  // если день выпадает на воскресенье, то перевод строки
               calendar1 += '</tr><tr>';}
}
        //  клетки после последнего дня месяца
        if (D1Nlast != 0) { for(var  i = D1Nlast; i < 7; i++) {calendar1 += '<td class="an_mon">' + j++ + '</td>'; }; }
        else { for(var  i = 1; i <= 7; i++) {calendar1 += '<td class="an_mon">' + i + '</td>'; }; };
        calendar1 += '</tr>';
        document.getElementById('dayweek1').innerHTML =  calendar1 ;
};
/* clock*/
function updateClock() {
    var t = new Date();
	t.setTime(t.getTime() - window.delta);
	H_serv = t.getHours();
	Min_serv = t.getMinutes();
	Sec_serv = t.getSeconds();
    var clockArms = [H_serv, Min_serv, Sec_serv];
    if (clockArms[2] == window.oldSeconds) return; //секунды не менялись? выйти
            window.oldSeconds = clockArms[2];
            if (H_serv<10) H_serv = '0' +H_serv;
			if (Min_serv<10) Min_serv = '0'+Min_serv;
			if (Sec_serv<10) Sec_serv = '0'+Sec_serv;
            var c = document.getElementById('myCanvas');
            var ctx = c.getContext('2d');
            var x = 62;   //Math.round(c.width/2);
            var y = 62;   //Math.round(c.height/2);
            var r = 62;   //Math.round(Math.min(x,y));
            ctx.beginPath(); 
            ctx.arc(x,y,r,0,2*Math.PI,true);
            ctx.fillStyle = 'rgb(255,255,255)';
            ctx.fill();
            ctx.lineWidth = 1;
            ctx.strokeStyle = 'rgb(51,51,51)';
            ctx.stroke();
            ctx.closePath();
            ctx.restore();
            // стрелки:
            clockArms[1] += clockArms[2] / 60;
            clockArms[0] += clockArms[1] / 60;
            drawClockArm(ctx, x, y, clockArms[0] * 30, 36, 5); //часовая
            drawClockArm(ctx, x, y, clockArms[1] * 6,  56, 3); //минутная
            drawClockArm(ctx, x, y, clockArms[2] * 6,  46,  1); //секундная
			document.getElementById('timeserv').innerHTML = H_serv + ':' + Min_serv + ':' + Sec_serv;
}
 
function drawClockArm(ctx, x,y, degrees, len, lineWidth) {
        ctx.save();
        ctx.lineWidth = lineWidth;
        ctx.lineCap = 'butt';
        ctx.translate(x, y);
        ctx.rotate((degrees - 90) * Math.PI / 180);
        ctx.strokeStyle = 'rgb(51,51,51)';
        ctx.beginPath();
		if (ctx.lineWidth==1) { ctx.moveTo(- 16, 0);}
        else {ctx.moveTo(0, 0);};
        ctx.lineTo(len, 0);
        ctx.stroke();
        ctx.restore();
}
 
function initClock() { window.setInterval(updateClock, 1000); }
/* change month */
function change_month_back (d1,d2,napr) {
	var j=12;
	var monYY = {};
	
	for (i=0;i<12;i++) {
		if (d1==window.mm2RU[i]) 
		    { if (napr==0) { 
		                    if (i==0) {j=12; d2-=1;} else {j=i};
		                    j-=1;
			               }
			   else { if (i==11) {j=-1; d2+=1;} else {j=i};
		                    j+=1;
			        };			   
				d1=window.mm2RU[j];
				break;
			};
	};
	var nD = new Date (d2,j,1);
	var nDW = new Date(nD.getFullYear(),nD.getMonth(),1).getDay();
	 monYY = {m:d1,y:d2,dn:nD,nw:nDW};
	 document.getElementById('mon').innerHTML = monYY.m;
	 document.getElementById('yearmon').innerHTML = monYY.y;
	 document.getElementById('weekday').innerHTML = window.wdRU[monYY.nw]; 
	 new_calendar(nD);	  
return monYY;
}

function change_now (d1) {
		
	var D = new Date (d1);
	dd = D.getDate();
	if (dd<10) dd =' '+dd;
	mm = D.getMonth();
	yy = D.getFullYear();
	wd = D.getDay();
	weekday = window.wdRU[wd];
	monthi = window.mm2RU[mm];
	monYY = {m:monthi,y:yy,dn:d1,nw:weekday};
	  document.getElementById('mon').innerHTML = monYY.m; 
	  document.getElementById('yearmon').innerHTML = monYY.y; 
	  document.getElementById('weekday').innerHTML = monYY.nw;	  
	  new_calendar(D);	  
	return monYY;
}
/**/
 $(document).ready(function(){
    // определение дня, что пользователь выбрал на календаре
    $('#dayweek1').on('click','td',function(){
		$('#dayweek1 td').attr('id',null);
		$('#dayweek1 td').css('background-color', 'white');
        $(this).attr('id','choice');
		$('td#choice').css('background-color', 'blue');
     
    });
    
	// отправить запрос
	$('.footer').on('click','a',function(){ 
	    $year_send = $('#yearmon').text();
		
		for ($i=0;$i<window.mm2RU.length;$i++ ) 
		       {if (window.mm2RU[$i]===$('#mon').text() ) {$month_send =$i + 1 ; break;} 	};
		$day_send = $('#choice').text();
	
	    if (!$day_send) {$day_send = $('#today').text();};
		$.ajax({type:'POST',
		        url:'backend.php',
				data:{'meth':'calc','year':$year_send,'month':$month_send ,'day':$day_send},
		        success:function(result){
		                                  var eventAS = JSON.parse(result, function(key, value) { return value;});
		                                  alert (eventAS.message);
		                                }
				});
     
    }
	);
	
});
