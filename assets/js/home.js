import '../css/home.css';
import $ from 'jquery';

let overlay =$('.echantillons .annonce .info');
let height = ((overlay.parent().height())-(overlay.height()))/2;
let width = ((overlay.parent().width())-(overlay.width()))/2;

overlay.css({
    "top": height+"px",
    "right": width+"px"
});
// let mrgTop = (($("#centre").parent().height())-($("#centre").height()))/2;
// console.log($("#centre"));
// $("#centre").css('marginTop',mrgTop);

$(window).resize(function(){
    overlay.css({
        "top":((($(this).parent().height())-($(this).height()))/2)+"px",
        "right":((($(this).parent().width())-($(this).width()))/2)+"px"
    });
    
});
 