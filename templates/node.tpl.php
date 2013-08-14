<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);

  // See if the first visible item is an image field. If it is, output it outside of the campl-content-container so that
  // it appears as a leading image.
  foreach ($content as $key => $value) {
    if (FALSE === array_key_exists('#printed', $value) || FALSE == $value['#printed']) {
      if (isset($value['#field_type']) && $value['#field_type'] === 'image') {
        print render($content[$key]);
      }
      break;
    }
  }
  ?>

  <div class="content campl-content-container"<?php print $content_attributes; ?>>
    <?php
    print render($content);
    ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
