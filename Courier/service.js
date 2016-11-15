$(document).ready(function(){
 var today=new Date(),
    yy = today.getFullYear(),
    mm = today.getMonth() + 1,
	sel= yy;
 var arr_k =[];
 var arr_kD =[];
sel= today.getDate().toString().replace( /^([0-9])$/, '0$1' ) +'.'+ mm.toString().replace( /^([0-9])$/, '0$1' )+'.'+yy; 

document.getElementById('dataT').innerHTML = sel ;
;
//
 var myMap,
        myPlacemark;
 if (arr_k.length==0) {      
 ymaps.ready(function(){
        myMap = new ymaps.Map("first_map", {
            center: [55.76, 37.64],
            zoom: 15
			});
			myMap.controls.add('routeEditor');
			myMap.controls.add('rulerControl');
	// Обработка события, возникающего при щелчке левой кнопкой мыши в любой точке карты.
  
	var i=1;
	
    myMap.events.add('click', function (e) {
      
            var coords = e.get('coords');
			
			arr_k.push({"x":coords[0].toPrecision(6), "y":coords[1].toPrecision(6)});
			arr_kD.push([coords[0].toPrecision(6),coords[1].toPrecision(6)]);
					
            i++;
			myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
			getAddress(coords);
            
	});
	
	// Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            preset: 'islands#violetDotIconWithCaption',
            draggable: false
        });
    }
	//
	// Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);

            myPlacemark.properties
                .set({
                    iconCaption: firstGeoObject.properties.get('name'),
                    balloonContent: firstGeoObject.properties.get('text')
                });
        });
    }
 
$('#start').on('click','#expr',function (){		
	    
		if (!arr_k.length==0) {
		
		var listD=[];
		listD=getDist(arr_k);
		//f_routDM([[55.7607,37.6179],[55.7634,37.6220],[55.7623,37.6237]]);
		arr_kD.length=0;
		
		for (i=0;i<listD.length;i++)  {
		   arr_kD.push([listD[i][0][0],listD[i][0][1]]);
		   
		};
		f_routDM(arr_kD);
		
        }
		else {alert ("!Необходимо выбрать места для маршрута !");};
		
		return false;
	});	
///
// собрать матрицу расстояний
 function getDist(arrD) {//alert("u   =");
    j=0; 
	var newDistAll=[];
	var ijArr=[];
	var aDist = new Array();
	
	while (j<arrD.length)
	{
     aDist[j] = new Array();
		for (i=0;i<arrD.length;i++) {
			
			if (!(i==j)) { 
				aDist[j][i]=f_dist(arrD[j]["x"],arrD[j]["y"],arrD[i]["x"],arrD[i]["y"]);
				
			}
			else
			{  
				aDist[j][i]="1000.00";
				
				};
		    
		};
        ++j;		
	};
	//alert(arrD[0]["x"]+"  "+arrD[0]["y"]);
	var len=aDist.length ;
	
	while (newDistAll.length<len) {
	  ijArr.length=0;
	  ijArr.push(f_minDist(aDist));
	//alert(ijArr[0][0]+"..."+ijArr[0][1]);
    newDistAll.push([[arrD[ijArr[0][0]]["x"],arrD[ijArr[0][0]]["y"]],[arrD[ijArr[0][1]]["x"],arrD[ijArr[0][1]]["y"]]]);
	 
	for (i=0;i<len;i++) {
	     aDist[i].splice(ijArr[0][1],1,1000.00); 
		 aDist[ijArr[0][0]].splice(i,1,1000.00);
	};
	
	};
	return newDistAll;
    }
function f_dist(s1,d1,s2,d2){
                              return (111.2 *Math.sqrt(Math.pow((s1-s2),2)+Math.pow((d1-d2)*Math.cos(Math.PI*s1/180),2))).toFixed(2);
							}
//
function f_minDist(arrD) {
  var newDist = new Array();
 	j=0; 
	
	var aDist2 = new Array();
	var jDist = new Array();
	var iDist = new Array();
	var minD=0;
	var minD2=1000.00;
	var otmI =0;
	var otmJ =0;
	var otmIJ =-1;
	var n = 0;
	var n2 = 0;
	var m = 0;
	var m2 = 0;
	var arrOtm = new Array();
	
	while (j<arrD.length)
	{		
     aDist2[j] = new Array();
	 minD=Math.min.apply(null, arrD[j]);
	
	 jDist.push(minD);
	 
		for (i=0;i<arrD.length;i++) {
			
			if (!(arrD[j][i]==1000.00)) { 
				aDist2[j][i]=arrD[j][i]- minD;
				}
			else 
			    {aDist2[j][i]=arrD[j][i];};
			if (j==0) {
				minD2=aDist2[j][i];
				iDist.push(minD2);
			}
			else { minD2 = iDist[i];
			      if (minD2>aDist2[j][i]) { minD2=aDist2[j][i]; iDist[i]=minD2;};
		         }
		};
        ++j;		
	};
	// редукция столбцов
	while (i<arrD.length)
	{
		for (j=0;j<arrD.length;j++) {
			
			if (!(i==j)) { 
				aDist2[j][i]=arrD[j][i]- iDist[i];
				};
		    
		};
        ++i;		
	};
	//Вычисление оценок нулевых клеток
	
	for (j=0;j<arrD.length;j++) {
		
		for (i=0;i<arrD.length;i++) {
			if (aDist2[j][i]==0){
				arrOtm = aDist2[j];
				arrOtm.splice(i,1);

				otmI=Math.min.apply(null,arrOtm);
				
				n=i;
				otmJ =1000.00;
		for (jn=0;jn<arrD.length;jn++) {
			if ((otmJ>aDist2[jn][n])&&(!(jn==j))){
				otmJ=aDist2[jn][n];
				n2=jn;
				
			};
		};
		if (otmIJ<(otmI+otmJ)) {otmIJ=otmI+otmJ; m=n; m2=n2;
		                        };
			};
		};
		
		
		
	};
	
	newDist.push(m2);
	newDist.push(m);
return	newDist;
	
}
///	
function f_routDM (arrDM) { 
 ymaps.route(arrDM).then(function (route) {
        myMap.geoObjects.add(route);
        // Зададим содержание иконок начальной и конечной точкам маршрута.
        // С помощью метода getWayPoints() получаем массив точек маршрута.
        var points = route.getWayPoints(),
            lastPoint = points.getLength() - 1;
        points.options.set('preset', 'islands#redStretchyIcon');
        // Задаем контент меток в начальной и конечной точках.
        points.get(0).properties.set('iconContent', 'Старт');
        points.get(lastPoint).properties.set('iconContent', 'Финиш');
        //distance = Math.round(route.getLength() / 1000);
     
    }, function (error) {
        alert('Возникла ошибка: ' + error.message);
    });
 }	
      }); 


 };	
});
