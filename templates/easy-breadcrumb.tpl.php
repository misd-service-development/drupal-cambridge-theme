<?php if ($segments_quantity > 0): ?>
  <div itemscope class="easy-breadcrumb campl-breadcrumb" id="breadcrumb" itemtype="<?php print $list_type; ?>">
    <ul class="campl-unstyled-list campl-horizontal-navigation clearfix">
      <?php foreach ($breadcrumb as $i => $item): ?>
        <?php print $item; ?>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>