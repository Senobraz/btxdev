<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?
	if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
	{
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
		{
			if(strlen($arResult["REDIRECT_URL"]) > 0)
			{
				$APPLICATION->RestartBuffer();
				?>
				<script type="text/javascript">
					window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
				</script>
				<?
				die();
			}
		}
	}
?>    
    
    <? if (!empty($arResult["ORDER"])) : ?>
    <? include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php"); ?>
    <? else : ?>
    <form id="ORDER_FORM" action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
        <?
        if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
        {
            //for IE 8, problems with input hidden after ajax
        ?>
        <span style="display:none;">
        <input type="text" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
        <input type="text" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
        </span>
            <?
        }
        else
        {
            foreach($arResult["PERSON_TYPE"] as $v)
            {
                ?>
                <input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>" />
                <input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>" />
                <?
            }
        }
    ?>   
    <div class="order-form">
        <?	
            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
        ?>
        <?	
            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
        ?>
        <?	
            include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
        ?>
    </div>
    <div class="order__submit">
        <button class="button" >Подтвердить заказ</button>
    </div>   
    
    <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
    <input type="hidden" name="profile_change" id="profile_change" value="N">
    <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
    </form>
    <? endif ?>  


 
<script type="text/javascript">		
   
    var FORM_ORDER = $('#ORDER_FORM');

    $(FORM_ORDER).ajaxForm({
        dataType: 'json',
        beforeSend: function() {
           
        },
        success: function(res) {
            if (res.error === false)
            {						
                $(FORM_ORDER).trigger('reset');
                window.top.location.href=res.redirect;
            }
            else
            {               
                alert(res.msg);
            }        
        }
    });
</script>