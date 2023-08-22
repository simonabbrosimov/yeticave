 <h2><?=htmlspecialchars($lot['lots_title'], ENT_QUOTES);?></h2>
			<div class="lot-item__content">
				<div class="lot-item__left">
					<div class="lot-item__image">
						<img src="<?=htmlspecialchars($lot['image'], ENT_QUOTES);?>" width="730" height="548" alt="Сноуборд">
					</div>
					<p class="lot-item__category">Категория: <span><?=htmlspecialchars($lot['category_title'], ENT_QUOTES);?></span></p>
					<p class="lot-item__description"><?=htmlspecialchars($lot['description'], ENT_QUOTES);?></p>
				</div>
				<?php if ($lot['expire_date'] > date('Y-m-d') && $lot["user_id"] !== $_SESSION["id"] && $history[0]["user_name"] !== $_SESSION["name"]): ?>
				<div class="lot-item__right">
					<div class="lot-item__state">
					 <?php $res = get_remaining_time(htmlspecialchars($lot["expire_date"]), ENT_QUOTES);?>
						<div class="lot__timer timer<?php if ($res[0] < 1):?> timer--finishing<?php endif; ?>">
						<?= "$res[0]:$res[1]";?>           
						</div>
						<div class="lot-item__cost-state">
							<div class="lot-item__rate">
								<span class="lot-item__amount">Текущая цена</span>
								
								<span class="lot-item__cost"><?=format_number($current_price);?></span>
							   
								
							</div>
							<div class="lot-item__min-cost">
								Мин. ставка <span><?=format_number($min_bet);?></span>
							</div>
						</div>
					
						
						<form class="lot-item__form" action="../lot.php?id=<?=$id;?>" method="post" autocomplete="off">
							<?php $classname = isset($error) ? "form__item--invalid" : "" ;?>
							<p class="lot-item__form-item form__item <?=$classname;?>">
								<label for="cost">Ваша ставка</label>
								<input id="cost" type="text" name="cost"  value="<?= htmlspecialchars($new_bet['cost'], ENT_QUOTES);?>"placeholder="0">
								<?php if(isset($error)):?>
								<span class="form__error"><?=$error;?></span>
							<?php endif;?>
							</p>
							<button type="submit" class="button">Сделать ставку</button>
						</form>
					</div>
					<?php endif;?>
					 <?php if (!empty($history)): ?>
          <div class="history">
            <h3>История ставок (<span>10</span>)</h3>
            <table class="history__list">
              <?php foreach($history as $bet): ?>
              <tr class="history__item">
                <td class="history__name"><?= $bet["user_name"]; ?></td>
                <td class="history__price"><?= format_number($bet["price"]); ?></td>
                <td class="history__time"><?= $bet["bet_date"]; ?></td>
              </tr>
            <?php endforeach; ?>
            </table>
            <?php endif; ?>
            
					</div>
				
				</div>
			</div>