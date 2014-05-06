<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>"
      dir="<?php print $language->dir; ?>" <?php print $rdf_namespaces; ?> class="no-js">

<head>

  <?php print $head; ?>

  <title><?php print $head_title; ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <?php print $styles; ?>

  <script type="text/javascript" src="//use.typekit.com/hyb5bko.js"></script>
  <script type="text/javascript">try {
      Typekit.load();
    } catch (e) {
    }</script>
  <script type="text/javascript">document.documentElement.className += " js";</script>

</head>

<body class="<?php print $classes; ?>" <?php print $attributes; ?>>

<!--[if lt IE 7]>
<div class="lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<div class="lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<div class="lt-ie9">
<![endif]-->

<a href="#page-content" class="campl-skipTo"><?php print t('skip to content'); ?></a>

<?php print $page_top; ?>

<?php print $page; ?>

<?php print $scripts; ?>

<?php print $page_bottom; ?>

<!--[if lte IE 8]>
</div>
<![endif]-->

</body>

</html>
