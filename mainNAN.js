 $(document).ready(function(){
 // Создаем список
var myList = $('.myList'),  
    numOff = 0;
    myListItems = '',
	idImg = '',
	idImgLighter = 0;
  
for (i = 1; i < 10; i++) {  
    idImg = 'ball' + i ;
    myListItems += '<img id="' + idImg + '"'+' src="ball.jpg"/>';  
	$('#'+idImg).addClass('on'); 
	
}  
myList.html(myListItems);  
 idImgLighter = Math.floor(Math.random() * 9 + 1);
 numOff = idImgLighter;
 //alert(idImgLighter);
 console.log("Искомый шар окажется ... № "+idImgLighter);
 idImg = 'ball' + idImgLighter ;
 $('#'+idImg).removeClass('on').addClass('off');

	function compareF(i1,i2,side1,side2,screen){
		for (i = i1; i < i2; i++) {  
			$($('#start')
		                .find('#ball' + i)).clone().appendTo('#weighed .'+side1).attr( "id", "Clone"+i);
		    $('#ball' + i).css('visibility', 'hidden');
			$('#Clone' + i).css('visibility', 'visible');
			if ($('#ball' + i).hasClass("off")) { 
				$('#libra .libraImg').attr("src",screen);
				$('#weighed .'+side2).css('margin-top', '25px');
				$('#weighed .'+side1).css('margin-top', '10px');
			}
			;
		}; 

	}; 
    // нажатие на кнопку "Сравнить"
	
    $('#compare').on('click','button',function (){
		
	    compareF(1,4,'leftW','rightW',"libra3.jpg");
		compareF(4,7,'rightW','leftW',"libra2.jpg");
		//$("#buttonId").text("Продолжить сравнение");
        $('#timew').css('visibility', 'visible');	
        // результат первого взвешивания		
		setTimeout(function() {$('#timew').css('visibility', 'hidden');
		                       $('#weighed .leftW').empty();
							   $('#weighed .rightW').empty();
							   $("#buttonId").css('display', 'none');
							   if ($('#libra .libraImg').attr("src")=="libra3.jpg") { 
							                      console.log("Искомый шар на левой чаше среди 1,2,3... №2 отбрасываем, №1-на левую чашу, №3-на правую...");
												  $('#libra .libraImg').attr("src","libra1.jpg");
			                                      compareF(1,2,'leftW','rightW',"libra3.jpg");
			                                      compareF(3,4,'rightW','leftW',"libra2.jpg");
		                                          }
		                       else if ($('#libra .libraImg').attr("src")=="libra2.jpg") {
                                                  console.log("Искомый шар на правой чаше среди 4,5,6...№5 отбрасываем, №4-на левую чашу, №6-на правую...");	
                                                  $('#libra .libraImg').attr("src","libra1.jpg");												  
			                                      compareF(4,5,'leftW','rightW',"libra3.jpg");
			                                      compareF(6,7,'rightW','leftW',"libra2.jpg");
		                                          }
		                       else               { 
							                      console.log("Искомый шар не на чашах весов среди 7,8,9...№8 отбрасываем, №7-на левую чашу, №9-на правую...");
                                                  $('#libra .libraImg').attr("src","libra1.jpg");												  
			                                      compareF(7,8,'leftW','rightW',"libra3.jpg");
			                                      compareF(9,10,'rightW','leftW',"libra2.jpg");
		                                          };
								setTimeout(function() {$('#timew').css('visibility', 'visible');
								                // результат второго взвешивания
		                                		setTimeout(function() { console.log("Определяется во втором взвешивании...");	
													                   $('#timew').css('visibility', 'hidden');
		                                                               $($('#start').find('img')).css('visibility', 'visible'); 
		                                 		                       $('.off').css('border', '2px solid #ff0033'); 
							                                           $("p").text("Искомым шаром оказался ... № "+numOff); 
	                                                                  },3000);
		                                              },500);
		                      },3000);
        
         
    });
    
 });
