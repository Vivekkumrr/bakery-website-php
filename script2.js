document.addEventListener('DOMContentLoaded', function() {
$(document).ready(function() {
$('.hero-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 1000
});

// Testimonial Slider
$('.testimonial-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    autoplay: true,
    autoplaySpeed: 6000,
    speed: 1000
});

// Navigation Controls
$('.prev').click(function() {
    $('.hero-slider').slick('slickPrev');
});
$('.next').click(function() {
    $('.hero-slider').slick('slickNext');
});
$('.prev1').click(function() {
    $('.testimonial-slider').slick('slickPrev');
});
$('.next1').click(function() {
    $('.testimonial-slider').slick('slickNext');
});
});


const header = document.querySelector('header'); // Given header HTML Element instead of class
function fixedNavbar() {    
    header.classList.toggle('scrolled', window.pageYOffset > 0);
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
const userbtn = document.querySelector('#user-btn');
const userBox = document.querySelector('.user-box');

menu.addEventListener('click', function (){
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');

});

userbtn.addEventListener('click', function () {
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
});


const closeBtn = document.querySelector('#close-form');
closeBtn.addEventListener('click', () =>{
    document.querySelector('.update-container').style.display = 'none';
});
})