
    <style type="text/css">
    .pagination li {
        font-size:12px;
        padding-left: 0;
    }
    </style>
    <ul class="pagination" style="margin:0 auto;">
        <?php $mid_range = 7; ?>

        <?php if ($paginator->total_pages > 1) { ?>
            <?php if ($paginator->current != 1) { ?>
                <?php $pageString = '<li>' . $this->tag->linkto('' . $paginateUrl . '&page=' . $paginator->before, '&laquo') . '</li>'; ?>
            <?php } else { ?>
                <?php $pageString = '<li style="display:none">' . $this->tag->linkto('#', '&laquo') . '</li>'; ?>
            <?php } ?>

            <?php $start_range = $paginator->current - floor(($mid_range / 2)); ?>
            <?php $end_range = $paginator->current + floor(($mid_range / 2)); ?>

            <?php if ($start_range <= 0) { ?>
                <?php $end_range = $end_range + abs(($start_range)) + 1; ?>
                <?php $start_range = 1; ?>
            <?php } ?>

            <?php if ($end_range > $paginator->total_pages) { ?>
                <?php $start_range = $start_range - ($end_range - $paginator->total_pages); ?>
                <?php $end_range = $paginator->total_pages; ?>
            <?php } ?>

            <?php $range = range($start_range, $end_range); ?>

            <?php foreach (range(1, $paginator->total_pages) as $i) { ?>
                <?php if ($this->isIncluded($i == 1 || $i == $paginator->total_pages || $i, $range)) { ?>
                    <?php if ($i == $paginator->current) { ?>
                        <?php $pageString = $pageString . '<li class="active">' . $this->tag->linkto('' . $paginateUrl . '&page=' . $i, '' . $i) . '</li>'; ?>
                    <?php } else { ?>
                        <?php $pageString = $pageString . '<li>' . $this->tag->linkto('' . $paginateUrl . '&page=' . $i, '' . $i) . '</li>'; ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

            <?php if ($paginator->current != $paginator->total_pages) { ?>
                <?php $pageString = $pageString . '<li>' . $this->tag->linkto('' . $paginateUrl . '&page=' . $paginator->next, '&raquo') . '</li>'; ?>
            <?php } else { ?>
                <?php $pageString = $pageString . '<li style="display:none">' . $this->tag->linkto('#', '&raquo') . '</li>'; ?>
            <?php } ?>

            <?php echo $pageString; ?>
        <?php } ?>
    </ul>
