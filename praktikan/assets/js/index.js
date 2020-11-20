$(window).scroll(function() {
  if ($(this).scrollTop() <= 450) {
    $('#wrapper').addClass('colorOne')
      .removeClass('colorTwo');
  } else if ($(this).scrollTop() <= 1000) {
    $('#wrapper').addClass('colorTwo')
      .removeClass('colorThree');
  } else {
    $('#wrapper').addClass('colorOne')
  }
});

function fadeIn(){
  var target = document.querySelector('.anim2');
  var targetPosition = target.getBoundingClientRect().top;
  var screenPosition = window.innerHeight /1.3;

    if(targetPosition < screenPosition){
        target.classList.add('fade-in');
    } 
} 


window.addEventListener("scroll", fadeIn);