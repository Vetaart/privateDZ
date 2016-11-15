 $(document).ready(function(){
//
 var today=new Date(),
    yy = today.getFullYear(),
    mm = today.getMonth(),
	sel= yy;

if (parseInt(mm) > 9) { sel = parseInt(yy) + 1;
};
document.getElementById('yearG').innerHTML = sel ;
 $.ajax({type:'POST',
          url:'chart.php',
		  data:{'querys':'read','sel':sel},
		  success:function(result){ var evDS = JSON.parse(result);
		    //  alert(result);
			 var spisok = '';
			
			 var i_n=0;
			 for(var  i = 0; i < evDS.length ; ++i) { 
			 
                spisok += '<tr><td>' + ++i_n + '. ' + evDS[i].fio + '</td><td>' + evDS[i].data_s + '</td><td>' + evDS[i].dep +  '</td><td>' + evDS[i].job + '</td></tr>' ;  
						
	            };
			 

        document.getElementById('bodyTW').innerHTML =  spisok ;
		     
		  }
		  
	 	  ,
   error: function(){alert('Problem-1');}

	  });	
	
});
