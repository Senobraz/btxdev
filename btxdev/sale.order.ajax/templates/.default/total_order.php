<div class='final'>
	<div class='final-block'>
		<div class='final-top'>
			Сумма заказа:
		</div>
		<div class='fina-mid'>
			<?= $arResult["ORDER_PRICE_FORMATED"] ?> <span>c</span>
		</div>
	</div>
	<div class='final-block'>
		<div class='final-top'>
			Доставка:
		</div>
		<div class='fina-mid'>
			+ <b class="order-delivery-price">0</b> <span>c</span>
		</div>
		<div class='deliv'>
			доставка
		</div>
	</div>
	<div class='final-block end'>
		<div class='final-top'>
			Итого:
		</div>
		<div class='fina-mid'>
			<b class="order-total-price"><?= $arResult["ORDER_PRICE_FORMATED"] ?></b> <span>c</span>
		</div>
	</div>
</div>