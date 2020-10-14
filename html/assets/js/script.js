/*--- Write Javascript Here ---*/
$(document).ready(function(){

  $('.hm-fp-img-wl').on("click", function(e){
    $('.fa-heart').toggleClass('checked');
  });

  $('.c-img-wl').on("click", function(e){
    $('.fa-heart').toggleClass('checked');
  });
  
  $('#accordDescHead').on("click", function(e){
    $('.arrow-desc-accord').toggleClass('active');
  });

  $('#accordReviewHead').on("click", function(e){
    $('.arrow-review-accord').toggleClass('active');
  });
    
});

new WOW().init();

// Hamburger Mobile Menu
var $hamburger = $(".hamburger");
$hamburger.on("click", function(e) {
  $hamburger.toggleClass("is-active");
  $('#header-m').toggle();
});

/*--- Owl Carousel ---*/
$('.hm-b-c').owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  items: 1,
  navText: ["<img src='assets/img/arrow-l.png'>","<img src='assets/img/arrow-r.png'>"]
});

// $('.prd-c').owlCarousel({
//   loop: true,
//   margin: 0,
//   nav: true,
//   dots: false,
//   items: 1,
//   navText: ["<img src='assets/img/arrow-l.png'>","<img src='assets/img/arrow-r.png'>"]
// });

$('.prd-g2').owlCarousel({
  loop: false,
  margin: 5,
  nav: false,
  dots: false,
  items: 4,
  // navText: ["<img src='assets/img/arrow-l.png'>","<img src='assets/img/arrow-r.png'>"]
});

$('.recommended-slider').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  items: 3,
  navText: ["<img src='assets/img/arrow-l.png'>","<img src='assets/img/arrow-r.png'>"],
  autoplay:true,
  autoplayTimeout:2500,
  autoplayHoverPause:true
});

$('.recommended-slider-m').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  items: 2,
  navText: ["<img src='assets/img/arrow-l.png'>","<img src='assets/img/arrow-r.png'>"],
  autoplay:true,
  autoplayTimeout:2500,
  autoplayHoverPause:true,
  responsive:{
    0:{
      items:1
    },
    576:{
      items:2
    }
  }
});

$('.latest-blog-m').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  items: 2,
  navText: ["<img src='assets/img/arrow-l.png'>","<img src='assets/img/arrow-r.png'>"],
  autoplay:true,
  autoplayTimeout:2500,
  autoplayHoverPause:true
});

$('.latest-blog').owlCarousel({
  loop: true,
  margin: 0,
  nav: false,
  dots: false,
  items: 3,
  navText: ["<img src='assets/img/arrow-l.png'>","<img src='assets/img/arrow-r.png'>"],
  autoplay:true,
  autoplayTimeout:2500,
  autoplayHoverPause:true
});
/*--- /Owl Carousel ---*/

/*QTY order detail*/
$('.minus').click(function () {
  var $input = $(this).parent().find('input');
  var count = parseInt($input.val()) - 1;
  count = count < 1 ? 1 : count;
  $input.val(count);
  $input.change();
  return false;
});
$('.plus').click(function () {
  var $input = $(this).parent().find('input');
  $input.val(parseInt($input.val()) + 1);
  $input.change();
  return false;
});

// Order Step
function goStep1(){
  document.getElementById("step1").style.display = "flex";
  document.getElementById("step2").style.display = "none";
  document.getElementById("step3").style.display = "none";
  document.getElementById("step4").style.display = "none";
}
function goStep2(){
  document.getElementById("step1").style.display = "none";
  document.getElementById("step2").style.display = "flex";
  document.getElementById("step3").style.display = "none";
  document.getElementById("step4").style.display = "none";
  changeQtyProduct();
}
function goStep3(){
  document.getElementById("step1").style.display = "none";
  document.getElementById("step2").style.display = "none";
  document.getElementById("step3").style.display = "flex";
  document.getElementById("step4").style.display = "none";
}
function goStep4(){
  document.getElementById("step1").style.display = "none";
  document.getElementById("step2").style.display = "none";
  document.getElementById("step3").style.display = "none";
  document.getElementById("step4").style.display = "flex";
}