function XFormatPrice(_number) 
{
    var decimal=0;
    var separator=' ';
    var decpoint = '.';
    var format_string = '#';
 
    var r=parseFloat(_number)
 
    var exp10=Math.pow(10,decimal);// приводим к правильному множителю
    r=Math.round(r*exp10)/exp10;// округляем до необходимого числа знаков после запятой
 
    rr=Number(r).toFixed(decimal).toString().split('.');
 
    b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);
 
    r=(rr[1]?b+ decpoint +rr[1]:b);
    return format_string.replace('#', r);
}

BX.ready(function() {
    $('.in-delivery input').change( function(){        
        var $price = +$(this).attr("data-price");  
        var $total = +$('#ORDER_PRICE').val();       
        $('.order-delivery-price').text($price);        
        $('#PRICE_DELIVERY').val($price);
        $('.order-total-price').text( XFormatPrice($price+$total) );
    })
    
    if ($('#ORDER_PROP_4').length > 0) {
        $('#ORDER_PROP_4').mask('+7(000) 000-00-00');
    }
})