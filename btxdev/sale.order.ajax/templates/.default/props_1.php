<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php foreach( $arResult["ORDER_PROP"]["USER_PROPS_N"] as $arProperties ) : ?>
<? if ($arProperties["TYPE"] == "TEXT") : ?>
<div class='form-div'>
	<label><?=$arProperties["NAME"]?><?= $arProperties["REQUIED"] == "Y" ? "*" : "" ?></label>
	<input  name="<?=$arProperties["FIELD_NAME"]?>"  id="<?=$arProperties["FIELD_NAME"]?>" value="<?=$arProperties["VALUE"]?>" type='text'>
</div>
<? endif ?>
<? if ($arProperties["TYPE"] == "HIDDEN") : ?>
<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"  class="shipping required" value="<?=$arProperties["VALUE"]?>">
<? endif ?>
<?php endforeach ?>
