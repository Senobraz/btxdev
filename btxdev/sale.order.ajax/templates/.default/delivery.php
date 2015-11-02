 <div class="orderf__row">
    <p class="text-small">служба доставки</p>    
    <? $i=1;foreach( $arResult["DELIVERY"] as $arDelivery) : ?>
    <? //echo "<pre>"; print_r($arDelivery); echo "</pre>"; ?>    
    <div class="">
        <div class="radio">
            <input type="radio" name="delivery" id="delivery-<?=$arDelivery["ID"]?>" checked/>
            <input
                type="radio" 
                id="ID_DELIVERY_<?=$arDelivery["ID"]?>"
                name="DELIVERY_ID"
                data-price="<?=$arDelivery["PRICE"]?>"
                value="<?=$arDelivery["ID"]?>"
                class=""
                <?= $i==1 ? "checked=\"checked\"" : "";?>
                onclick=""
            />
            <label for="ID_DELIVERY_<?=$arDelivery["ID"]?>">
                <?= $arDelivery["NAME"] ?><br>
                <span><?= $arDelivery["DESCRIPTION"]  ?><br> 
                <? $p = intval($arDelivery["PRICE"]); ?>
                <?= $p > 0 ? $arDelivery["PRICE"] ." Р" : ""?> </span>               
            </label>
        </div>
    </div>
    <? $i++; endforeach ?>    
</div>