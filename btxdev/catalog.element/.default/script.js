BX.ready(function() { 

    $('.add-item-to-basket').click( function(e){
        var $num = $(this).attr('data-num');
        var $q = 1;
        $.post("/ajax/basket.php", { q: $q,  p: $num, action: "add_to_basket"}, function(res){
            $('.ajax-basket-line').html(res.basket_line);
        }, 'json')
        e.preventDefault();
    })   
   
});
