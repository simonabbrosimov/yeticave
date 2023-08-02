 <h2><?=htmlspecialchars($lot['lots_title'], ENT_QUOTES);?></h2>
			<div class="lot-item__content">
				<div class="lot-item__left">
					<div class="lot-item__image">
						<img src="<?=htmlspecialchars($lot['image'], ENT_QUOTES);?>" width="730" height="548" alt="Сноуборд">
					</div>
					<p class="lot-item__category">Категория: <span><?=htmlspecialchars($lot['category_title'], ENT_QUOTES);?></span></p>
					<p class="lot-item__description"><?=htmlspecialchars($lot['description'], ENT_QUOTES);?></p>
				</div>
				<?php if(isset($_SESSION['name'])) :?>
				<div class="lot-item__right">
					<div class="lot-item__state">
					 <?php $res = get_remaining_time(htmlspecialchars($lot["expire_date"]), ENT_QUOTES);?>
						<div class="lot__timer timer<?php if ($res[0] < 1):?> timer--finishing<?php endif; ?>">
						<?= "$res[0]:$res[1]";?>           
						</div>
						<div class="lot-item__cost-state">
							<div class="lot-item__rate">
								<span class="lot-item__amount">Текущая цена</span>
								<span class="lot-item__cost"><?=format_number(htmlspecialchars($lot['price'], ENT_QUOTES));?></span>
							</div>
							<div class="lot-item__min-cost">
								Мин. ставка <span>12 000 р</span>
							</div>
						</div>
					<?php endif;?>
						<!--
						<form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
							<p class="lot-item__form-item form__item form__item--invalid">
								<label for="cost">Ваша ставка</label>
								<input id="cost" type="text" name="cost" placeholder="12 000">
								<span class="form__error">Введите наименование лота</span>
							</p>
							<button type="submit" class="button">Сделать ставку</button>
						</form>
					</div>
					<div class="history">
						<h3>История ставок (<span>10</span>)</h3>
						<table class="history__list">
							<tr class="history__item">
								<td class="history__name">Иван</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">5 минут назад</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Константин</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">20 минут назад</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Евгений</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">Час назад</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Игорь</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">19.03.17 в 08:21</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Енакентий</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">19.03.17 в 13:20</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Семён</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">19.03.17 в 12:20</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Илья</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">19.03.17 в 10:20</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Енакентий</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">19.03.17 в 13:20</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Семён</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">19.03.17 в 12:20</td>
							</tr>
							<tr class="history__item">
								<td class="history__name">Илья</td>
								<td class="history__price">10 999 р</td>
								<td class="history__time">19.03.17 в 10:20</td>
							</tr>
						</table>
					</div>
				-->
				</div>
			</div>