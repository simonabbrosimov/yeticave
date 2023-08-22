<?php if ($pages_count > 1): ?>
<ul class="pagination-list">
	<li class="pagination-item pagination-item-prev"><a href="/?page=<?=($cur_page -1);?>"><Назад</a></li>
	 <?php foreach ($pages as $page): ?>
    <li class="pagination__item <?php if ($page == $cur_page): ?>pagination__item--active<?php endif; ?>">
        <a href="/?page=<?=$page;?>"><?=$page;?></a>
    </li>
    <?php endforeach; ?>
	<li class="pagination-item pagination-item-next"><a href="/?page=<?=($cur_page + 1);?>">Вперед</a></li>
</ul>
<?php endif; ?>

