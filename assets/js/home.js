import '../css/home.css';
import $ from 'jquery';

let overlay =$('.echantillons .annonce .info');
let height = ((overlay.parent().height())-(overlay.height()))/2;
let width = ((overlay.parent().width())-(overlay.width()))/2;

overlay.css({
    "top": height+"px",
    "right": width+"px"
});
let pH=$("#centre").parent().parent().height();
let h = $("#centre").height();
 let padTop = pH - h;
 console.log("padding top "+padTop/2);
 $("#centre").css('paddingTop',padTop/2);

$(window).resize(function(){
    overlay.css({
        "top":((($(this).parent().height())-($(this).height()))/2)+"px",
        "right":((($(this).parent().width())-($(this).width()))/2)+"px"
    });
    
});
 