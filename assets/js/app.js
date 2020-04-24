/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';


require('select2');

$('select').select2({
    placeholder: "Spécifité(s)",
    
});

let contactButton = $("#contactButton");
contactButton.click(e=>{
    e.preventDefault();
    $("#contactForm").slideDown();
    contactButton.slideUp();
});
//mise en forme 
var home = $('.home ');
var header = $('.home .header');
let marg = (($(window).height()-header.height())/2);
// console.log(marg);
header.css('marginTop',marg-140)
home.height($(window).height());
$(window).resize(function(){
    home.height($(window).height());
    header.css('marginTop',(($(window).height()-header.height())/2)-140)

});
