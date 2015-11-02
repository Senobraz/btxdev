BX.ready(function() {

    $('.basket-edit-count').change(function(){
        var $balance = +$(this).attr('data-balance');
        var $product = +$(this).attr('data-product');
        var $val = +$(this).val();

        if ( $balance >=  $val)
        {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ajax/basket.php',
                data: {
                    action: "update_to_basket",
                    p: $product,
                    q: $val,                
                },
                success: function(res){	                   
                    for ( var key in res.items )
                    {
                        $('.ajax-item-sum-' + key).text( res.items[key].SUMF );                       
                    } 
                    $('.ajax-total-sum').text( res.basket['TOTAL_PRICE'] );
                    $('.ajax-basket-line').html( res.basket_line ); 
                }
             }); 
        }
        else
        {
             $(this).val($balance);
        }
    })
    
    $('.basket-edit-count').keyup(function(){
        var $balance = +$(this).attr('data-balance');
        var $product = +$(this).attr('data-product');
        var $val = +$(this).val();

        if ( $balance >=  $val)
        {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/ajax/basket.php',
                data: {
                    action: "update_to_basket",
                    p: $product,
                    q: $val,                
                },
                success: function(res){	                   
                    for ( var key in res.items )
                    {
                        $('.ajax-item-sum-' + key).text( res.items[key].SUMF );                       
                    } 
                    $('.ajax-total-sum').text( res.basket['TOTAL_PRICE'] );
                    $('.ajax-basket-line').html( res.basket_line ); 
                }
             }); 
        }
        else
        {
             $(this).val($balance);
        }
    })

    $('.basket-edit-count').change(function(){

        var $val = +$(this).val();
        if ( $val < 1 )
            $(this).val(1);
    })
    
    $('.delete-item-basket').click( function(e){       
        var $product = +$(this).attr('data-product');           
         
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/ajax/basket.php',
            data: {
                action: "delete_to_basket",
                p: $product,                                  
            },
            success: function(res){	                   
                $('.item-' + $product).remove();
                $('.ajax-total-sum').text( res.basket['TOTAL_PRICE'] );
                $('.ajax-basket-line').html( res.basket_line ); 
                
                show_message(res.msg);

                if ( res.render )                       
                    setTimeout(function(){  window.location.href =  res.render; }, 2000);                        
            }
         });
         
         e.preventDefault();
    })
    
    $('.quantity__up').click( function(e){
        var $num = +$(this).attr('data-num');
        var $count = +$(".text-quantity-" + $num).val();
        var $balance = +$(".text-quantity-" + $num).attr('data-balance');
        $count = $count + 1;    
        $(".text-quantity-" + $num).val($count);
        $(".text-quantity-" + $num).change();
        e.preventDefault();
    })
    
     $('.quantity__down').click( function(e){
        var $num = +$(this).attr('data-num');
        var $count = +$(".text-quantity-" + $num).val();
        var $balance = +$(".text-quantity-" + $num).attr('data-balance');
        $count = $count - 1;    
        $(".text-quantity-" + $num).val($count);
        $(".text-quantity-" + $num).change();
        e.preventDefault();
    })
});