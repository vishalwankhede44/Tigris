 tinymce.init({
    selector: 'textarea',
    theme: 'modern',
    width: 1000,
    height: 250,
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
  });

$(document).ready(function(){
    
 $('#selectAllBoxes').click(function(Event){
     
     if(this.checked){
         
         $('.checkBoxes').each(function(){
             this.checked = true;
            
             
         });
     }else
         {
              $('.checkBoxes').each(function(){
             this.checked = false; 
             
             });
             
         }
     
 });
    
   
  // var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    
  //   $("body").prepend(div_box);

  //   $('#load-screen').delay(700).fadeOut(600, function(){
  //     $(this).remove();
  //   });
    
});

function loadUsersOnline(){

    $.get("function.php?onlineusers=result",  { name: "CMS" }, function(data){

      $(".onlineusers").text(data);

    });

}

setInterval(function(){

   loadUsersOnline();

},500);

