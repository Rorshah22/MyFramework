<?php /**
 * @var $pagesCount ;
 * @var $currentPage ;
 * @var $link ;
 */ ?>
<div class="pagination">
    <a class="page-btn" href="<?= $link ?>=1">Нач</a>
    <?php for ($pageNum = 1; $pageNum <= $pagesCount; $pageNum++): ?>
        <?php if ($currentPage === $pagesCount && $pageNum === $pagesCount - 1): ?>
            <a class="page-btn" href="<?= $link ?>=<?= $pageNum - 1 ?>"><?= $pageNum - 1 ?></a>
        <?php endif; ?>
        <?php if ($currentPage - 1 !== $pageNum
            && $currentPage !== $pageNum
            && $currentPage !== $pageNum - 1) {
            continue;
        } ?>

        <?php if ($currentPage === $pageNum): ?>
            <span class="page-btn page-btn-active"><?= $pageNum ?></span>
        <?php else: ?>
            <a class="page-btn" href="<?= $link ?>=<?= $pageNum === 1 ? '1' : $pageNum ?>"><?= $pageNum ?></a>
        <?php endif; ?>
        <?php if ($currentPage === 1 && $pageNum === 2): ?>
            <a class="page-btn" href="<?= $link ?>=<?= $pageNum + 1 ?>"><?= $pageNum + 1 ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <a class="page-btn" href="<?= $link ?>=<?= $pageNum - 1 ?>">Кон</a>
</div>