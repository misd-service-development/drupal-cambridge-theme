<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);

  // See if the first visible item is an image field. If it is, output it outside of the campl-content-container so that
  // it appears as a leading image.
  foreach ($content as $key => $value) {
    if (
      (FALSE === array_key_exists('#printed', $value) || FALSE == $value['#printed'])
      &&
      (FALSE === array_key_exists('#access', $value) || TRUE == $value['#access'])
    ) {
      if (isset($value['#field_type']) && $value['#field_type'] === 'image') {
        print render($content[$key]);
      }
      break;
    }
  }
  ?>

  <?php if (($rendered_content = render($content)) || $display_submitted): ?>
    <div class="content campl-content-container"<?php print $content_attributes; ?>>
      <?php if ($display_submitted): ?>
        <div class="submitted">
          <p><?php print $submitted; ?></p>
          <hr>
        </div>
      <?php endif; ?>

      <?php
      print $rendered_content;
      ?>
    </div>
  <?php endif; ?>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
