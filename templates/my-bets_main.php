<nav class="nav">
		<ul class="nav__list container">
			<?php foreach ($categories as $key => $value): ?>
			<li class="nav__item">
				<a href="../index.php"><?= htmlspecialchars($value['title'], ENT_QUOTES); ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
	</nav>
		<section class="rates container">
			 <?php if($user_bets): ?>
			<h2>Мои ставки</h2>
				<table class="rates__list">
				<?php foreach ($user_bets as $bet): ?>
					<?php $res=get_remaining_time($bet['expire_date']);?>
					<tr class="rates__item <?php if ($res[0] <= 0 && $res[1] <= 0):?> timer--finishing<?php endif; ?>">
						<td class="rates__info">
							<div class="rates__img">
								<img src="<?=$bet['image'];?>" width="54" height="40" alt="<?=$bet['symbol_code'];?>">
							</div>
							<h3 class="rates__title"><a href="../lot.php?id=<?=$bet['id'];?>"><?= htmlspecialchars($bet['title']) ;?></a></h3>
						</td>
						<td class="rates__category">
							<?=$bet['category'];?> 
						</td>
						<td class="rates__timer">
							
							<div class="timer<?php if ($res[0] <= 0 && $res[1] <= 0):?> timer--end<?php endif; ?>">
							<?php if  ($res[0] <= 0 && $res[1] <= 0):?>
								Торги окончены
							<?php else:?>  
							<?= "$res[0]:$res[1]";?>
							<?php endif;?>   
						</td>
						<td class="rates__price">
							<?=format_number($bet['price']);?>
						</td>
						<td class="rates__time">
							<?=$bet['dat'];?>
						</td>
					</tr>
			<?php endforeach; ?>
			</table>
		<?php else:?>
		 <h2>Ставки отсуствуют</h2> 
	 <?php endif;?>
		</section>
				<!-- <tr class="rates__item">
					<td class="rates__info">
						<div class="rates__img">
							<img src="../img/rate2.jpg" width="54" height="40" alt="Сноуборд">
						</div>
						<h3 class="rates__title"><a href="lot.html">DC Ply Mens 2016/2017 Snowboard</a></h3>
					</td>
					<td class="rates__category">
						Доски и лыжи
					</td>
					<td class="rates__timer">
						<div class="timer timer--finishing">07:13:34</div>
					</td>
					<td class="rates__price">
						10 999 р
					</td>
					<td class="rates__time">
						20 минут назад
					</td>
				</tr>
				<tr class="rates__item rates__item--win">
					<td class="rates__info">
						<div class="rates__img">
							<img src="../img/rate3.jpg" width="54" height="40" alt="Крепления">
						</div>
						<div>
							<h3 class="rates__title"><a href="lot.html">Крепления Union Contact Pro 2015 года размер L/XL</a></h3>
							<p>Телефон +7 900 667-84-48, Скайп: Vlas92. Звонить с 14 до 20</p>
						</div>
					</td>
					<td class="rates__category">
						Крепления
					</td>
					<td class="rates__timer">
						<div class="timer timer--win">Ставка выиграла</div>
					</td>
					<td class="rates__price">
						10 999 р
					</td>
					<td class="rates__time">
						Час назад
					</td>
				</tr>
				<tr class="rates__item">
					<td class="rates__info">
						<div class="rates__img">
							<img src="../img/rate4.jpg" width="54" height="40" alt="Ботинки">
						</div>
						<h3 class="rates__title"><a href="lot.html">Ботинки для сноуборда DC Mutiny Charocal</a></h3>
					</td>
					<td class="rates__category">
						Ботинки
					</td>
					<td class="rates__timer">
						<div class="timer">07:13:34</div>
					</td>
					<td class="rates__price">
						10 999 р
					</td>
					<td class="rates__time">
						Вчера, в 21:30
					</td>
				</tr>
				<tr class="rates__item rates__item--end">
					<td class="rates__info">
						<div class="rates__img">
							<img src="../img/rate5.jpg" width="54" height="40" alt="Куртка">
						</div>
						<h3 class="rates__title"><a href="lot.html">Куртка для сноуборда DC Mutiny Charocal</a></h3>
					</td>
					<td class="rates__category">
						Одежда
					</td>
					<td class="rates__timer">
						<div class="timer timer--end">Торги окончены</div>
					</td>
					<td class="rates__price">
						10 999 р
					</td>
					<td class="rates__time">
						Вчера, в 21:30
					</td>
				</tr>
				<tr class="rates__item rates__item--end">
					<td class="rates__info">
						<div class="rates__img">
							<img src="../img/rate6.jpg" width="54" height="40" alt="Маска">
						</div>
						<h3 class="rates__title"><a href="lot.html">Маска Oakley Canopy</a></h3>
					</td>
					<td class="rates__category">
						Разное
					</td>
					<td class="rates__timer">
						<div class="timer timer--end">Торги окончены</div>
					</td>
					<td class="rates__price">
						10 999 р
					</td>
					<td class="rates__time">
						19.03.17 в 08:21
					</td>
				</tr>
				<tr class="rates__item rates__item--end">
					<td class="rates__info">
						<div class="rates__img">
							<img src="../img/rate7.jpg" width="54" height="40" alt="Сноуборд">
						</div>
						<h3 class="rates__title"><a href="lot.html">DC Ply Mens 2016/2017 Snowboard</a></h3>
					</td>
					<td class="rates__category">
						Доски и лыжи
					</td>
					<td class="rates__timer">
						<div class="timer timer--end">Торги окончены</div>
					</td>
					<td class="rates__price">
						10 999 р
					</td>
					<td class="rates__time">
						19.03.17 в 08:21
					</td>
				</tr> -->
			