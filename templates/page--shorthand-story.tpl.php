<?php
/**
 * @filesource page.tpl.php
 *
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */
?>
<div id="page">
  <!-- CONTENT -->
  <div id="main" class="cam-row cam-content cam-recessed-content">
    <div class="clearfix">
      <div id="content" class="<?php print isset($column) ? "{$column} " : ''; ?>cam-main-content" role="main">
        <a id="main-content"></a>
        <?php print $messages; ?>
        <?php print render($tabs); ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div><!-- /#content -->
    </div>
  </div> <!-- CONTENT -->

</div><!-- /#page -->
<?php print render($page['bottom']); ?>
