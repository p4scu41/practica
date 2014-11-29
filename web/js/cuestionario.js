$(document).ready(function(){
    //borrowed from jQuery easing plugin
    //http://gsgd.co.uk/sandbox/jquery.easing.php
    $.easing.elasout = function(x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
    };

    seccionesCuestionario = '#seccionesCuestionario';

    $("#btnAnterior").click(function(){
        elemento = $('li.active').prev();

        if (elemento && elemento.prop("tagName") == 'LI') {
            $(seccionesCuestionario).scrollTo( elemento, 500 );
            elemento.find('a').tab('show');
        }
    });

    $("#btnSiguiente").click(function(){
        elemento = $(seccionesCuestionario+' li.active + li a');

        if (elemento) {
            $(seccionesCuestionario).scrollTo( elemento, 500 );
            elemento.tab('show');
        }
    });

});