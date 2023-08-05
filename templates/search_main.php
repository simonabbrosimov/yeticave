 <section class="lots">
		<h2>Результаты поиска по запросу «<span><?=$search;?></span>»</h2>
		<ul class="lots__list">
		<?php foreach ($goods as $key => $value): ?>
			<li class="lots__item lot">
				<div class="lot__image">
					<img src="<?=htmlspecialchars($value["image"], ENT_QUOTES);?>" width="350" height="260" alt="">
				</div>
				<div class="lot__info">
					<span class="lot__category"><?=htmlspecialchars($value["category"], ENT_QUOTES);?></span>
					<h3 class="lot__title"><a class="text-link" href="../lot.php?id=<?=$value["id"];?>"><?=htmlspecialchars($value["title"], ENT_QUOTES);?></a></h3>
					<div class="lot__state">
						<div class="lot__rate">
							<span class="lot__amount">Стартовая цена</span>
							<span class="lot__cost"><?=format_number(htmlspecialchars($value["price"], ENT_QUOTES));?></span>
						</div>
						<?php $res = get_remaining_time(htmlspecialchars(htmlspecialchars($value["expire_date"],ENT_QUOTES)))?>
						<div class="lot__timer timer<?php if ($res[0] < 1):?> timer--finishing<?php endif; ?>">
							<?= "$res[0]:$res[1]";?>
							 
						</div>
					</div>
				</div>
			</li>
		 <?php endforeach; ?>
	</ul>
			</section>
			<ul class="pagination-list">
				<li class="pagination-item pagination-item-prev"><a>Назад</a></li>
				<li class="pagination-item pagination-item-active"><a>1</a></li>
				<li class="pagination-item"><a href="#">2</a></li>
				<li class="pagination-item"><a href="#">3</a></li>
				<li class="pagination-item"><a href="#">4</a></li>
				<li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
			</ul>