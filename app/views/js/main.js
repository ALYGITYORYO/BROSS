jQuery(document).on('submit','#formlog',function(event){
    event.preventDefault();
    jQuery.ajax({
        url:'assets/controllers/login.php',
        type:'POST',
        dataType:'json',
        data:$(this).serialize(),
        beforeSend:function(){
            $('.btnlog').text('Validando....');
        }  
    }).done(function(respuesta){

        if(respuesta.token){
         
				$(".login-block").fadeOut(3000);
				setTimeout(function(){                  
					location.href='Control/';
               },3600);
				
                
            
           
        }
           else{               
               $('.error').slideDown('slow');
               setTimeout(function(){
                   $('.error').slideUp('slow');
               },3000);
               
               $('.btnlog').text('Intenta de nuevo');
               $('#usuario').text('');
               $('#password').text('');
           }
    }).fail(function(){
        console.log("Fail");
        $('.btnlog').text('Intenta de nuevo');
        $('#usuario').text('');
        $('#password').text('');
    }).always(function(){
        console.log("Complet");
    });
    
});