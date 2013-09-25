<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<?php $columnsInRow = 0; ?>

<?php foreach ($rows as $id => $row): ?>
  <?php
  $columns = NULL;
  if ($classes_array[$id]) {
    preg_match('/campl-column([0-9]+)/', $classes_array[$id], $matches);
    if (isset($matches[1])) {
      $columns = (int) $matches[1];
    }
  }

  if ($columns) {
    if (0 === $columnsInRow) {
      // start of a new row
      print '<div class="campl-row">';
    }
    elseif (($columnsInRow + $columns) > 12) {
      // we're going to overflow a row (ie it doesn't add up to 12), so start again
      print '</div><div class="campl-row">';
      $columnsInRow = 0;
    }
  }
  ?>
  <div<?php if ($classes_array[$id]) {
    print ' class="' . $classes_array[$id] . '"';
  } ?>>
    <?php print $row; ?>
  </div>
  <?php

  if ($columns) {
    if (($columnsInRow + $columns) == 12) {
      print '</div>';
      $columnsInRow = 0;
    }
    else {
      $columnsInRow += $columns;
    }
  }

  ?>
<?php endforeach; ?>

<?php
if ($columnsInRow > 0) {
  // the last row is open, so close it
  print '</div>';
}
?>
