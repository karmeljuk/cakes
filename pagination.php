<?php
/**
 * Pagination template part.
 * @package cakes
 */

?>

<nav class="page-navigation" role="navigation">
  <?php if($wp_query->max_num_pages>1) : ?>
    <?php ($paged == 0) ? $paged = 1:"" ?>
    <?php if ($paged > 1) : ?>
      <a href="<?php echo '?paged=' . ($paged -1); ?>" class="previous-page">previous page</a>
      <?php else: ?>
        <a href="#" class="previous-page not-visible">previous page</a>
      <?php endif; ?>
      <ul class="pages">
      <?php for($i=1;$i<=$wp_query->max_num_pages;$i++) : ?>
        <li <?php echo ($paged==$i)? 'class="active"':'';?>>
          <a href="<?php echo '?paged=' . $i; ?>"><?php echo $i;?></a>
        </li>
      <?php endfor; ?>
      </ul>

    <?php if($paged < $wp_query->max_num_pages) : ?>
      <a href="<?php echo '?paged=' . ($paged + 1); ?>" class="next-page">next page</a>
    <?php else: ?>
      <a href="#" class="next-page not-visible">next page</a>
    <?php endif; ?>

  <?php endif; ?>
</nav>
