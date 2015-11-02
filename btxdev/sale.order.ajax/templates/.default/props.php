<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php foreach( $arResult["ORDER_PROP"]["USER_PROPS_N"] as $arProperties ) : ?>
<? if ($arProperties["CODE"] == "TYPE") : ?>
<div class="orderf__row">
    <p class="text-small"><?=$arProperties["NAME"]?></p>
    <? $i = 1; foreach( $arProperties["VARIANTS"] as $arPropertiesVariant ) : ?>
    <? //var_dump($arPropertiesVariant); ?>
    <div class="radio">
        <input <?= $i == 1 ? "checked" : "" ?> name="<?=$arProperties["FIELD_NAME"]?>" value="<?= $arPropertiesVariant["ID"] ?>" type="radio" name="type" id="type-<?= $arPropertiesVariant["ID"] ?>" />
    <label for="type-<?= $arPropertiesVariant["ID"] ?>"><?= $arPropertiesVariant["NAME"] ?></label></div>
    <? $i++; endforeach ?>
</div>   
<? endif?>
<?php endforeach ?>
<div class="orderf__row"> 
<?php $col= false; $i=1; foreach( $arResult["ORDER_PROP"]["USER_PROPS_N"] as $arProperties ) : ?>
<? if(($i==3) || ($i==5)) : $col = true;?>
<div class="form__row cf">
<? endif ?>
<? if ($arProperties["TYPE"] == "TEXT") : ?>
<div class="<?= $col==true ? "form__col" : "form__row form__row_full cf" ?><?= $i==4 ? "form__col_last" : ""?>">
    <label for="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["NAME"]?><?= $arProperties["REQUIED"] == "Y" ? "*" : "" ?></label><br>   
    <input  placeholder="<?= $arProperties["DESCRIPTION"] ?>"  name="<?=$arProperties["FIELD_NAME"]?>"  id="<?=$arProperties["FIELD_NAME"]?>" value="<?=$arProperties["VALUE"]?>" type='text'>
</div>    
<? endif ?>
<? if(($i==4) || ($i==5))  : $col = false;?>
</div>
<? endif ?>
<? if ($arProperties["TYPE"] == "TEXTAREA") : ?>
<div class="form__row form__row_full cf">
    <label for="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["NAME"]?><?= $arProperties["REQUIED"] == "Y" ? "*" : "" ?></label><br>  
    <textarea name="<?=$arProperties["FIELD_NAME"]?>"  id="address" cols="30" rows="10" placeholder="<?= $arProperties["DESCRIPTION"] ?>"><?=$arProperties["VALUE"]?></textarea>
</div>    
<? endif ?>
<?php $i++; endforeach ?>
</div>
