<?php print $wrapper_prefix; ?>
<div class="section-carousel campl-carousel clearfix campl-banner" id="carousel">
  <div class="campl-carousel-container">
    <?php print $list_type_prefix; ?>
    <?php foreach ($rows as $id => $row): ?>
      <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
    <?php print $list_type_suffix; ?>
  </div>
</div>
<?php print $wrapper_suffix; ?>
