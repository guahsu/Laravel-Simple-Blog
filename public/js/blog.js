$(".menu-btn").click(function(){
  if($(".nav").hasClass("menu-open")){
    $(".nav").removeClass("menu-open")
  }else{    
    $(".nav").addClass("menu-open")
  }
});