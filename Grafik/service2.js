 $(document).ready(function(){
//
var today=new Date(),
    yy = today.getFullYear(),
    mm = today.getMonth(),
	sel= yy;

if (parseInt(mm) > 9) { sel = parseInt(yy) + 1;
};

 $.ajax({type:'POST',
          url:'chart.php',
		  data:{'querys':'start','sel':sel},
		  success:function(result){ var evDS = JSON.parse(result); //alert(result);
			 var spisok = '';
			 var sp_dep = '';
			 var dayN = 0;
			 for(var  i = 0; i < evDS.length ; ++i) { 
                if (!(sp_dep==evDS[i].dep)) {
					sp_dep=evDS[i].dep
				    spisok += '<tr><td>'+evDS[i].dep + '</td></tr>' ;  
				};
				dayN = parseInt(evDS[i].bal_c) + parseInt(evDS[i].bal_n);
            spisok += '<tr><td></td><td>' + evDS[i].job + '</td><td>' + evDS[i].fio + '</td><td>' +evDS[i].id + '</td><td>' + dayN +  '</td><td>'  + evDS[i].dat + '</td></tr>' ;  
			
	            }; 
								 
			document.getElementById('bodyTW2').innerHTML =  spisok ;
		      
		  }
		  
	 	  ,
   error: function(){alert('Problem-1');}

	  });	

});