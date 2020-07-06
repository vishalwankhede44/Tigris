$(document).ready(function(){
    $('.slider-one')
    .not(".slick-initalized")
    .slick({
        autoplay:true,
        autoplaySpeed:3000,
        dots:true,
        prevArrow:".site-slider .slider-btn .prev",
        nextArrow:".site-slider .slider-btn .next"
    });

    $('.slider-two')
    .not(".slick-initalized")
    .slick({
        autoplay:true,
        autoplaySpeed:3000,
        dots:true,
        prevArrow:".site-slider .slider-btn .prev",
        nextArrow:".site-slider .slider-btn .next"
    });

    $('.card').hover(function(){
      $(".text").attr('disabled',false);
    });

    
    $(".text").attr('disabled',true);;
    

  });

  function add_to_cart(obj){
         var wnd = window.open("http://localhost/Aqua/cart.php?pid="+obj.value);
        disp();
  }

  function loginAlert(obj){
    alert("Please log in first");
  }

  function disp(){
    alert("Added to Cart");
  }
  function qtyClick(btn,id){
      console.log("qty"+id);
      var q = document.getElementById("qty"+id).value;
      if(q == "")
        q = 0;
      else
        q = parseInt(q);
      if(btn.value=="+")
      {
          q = q+1;
        document.getElementById("qty"+id).value = q;
      }
      else{
        q = q-1;
        if(q<=0)
            q=0;
        document.getElementById("qty"+id).value = q;
      }
  }

  $(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
  });
  
  
  $(':radio').change(function() {
    console.log('New star rating: ' + this.value);
  });