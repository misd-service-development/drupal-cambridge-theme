<?php if ($config['in_left_navigation'] === TRUE): ?>

  <div class="<?php print $classes; ?>">
    <div class="campl-tertiary-navigation">
      <div class="campl-tertiary-navigation-structure">
        <ul class="campl-unstyled-list campl-vertical-breadcrumb">
          <?php

          print '<li><a href="' . base_path() .
            '">' . variable_get('site_name') . ' <span class="campl-vertical-breadcrumb-indicator"></span></a></li>';

          $menu_trail_left = menu_get_active_trail('node/' . arg(1));
          if ($menu_trail_left) {
            $parents_item_left = count($menu_trail_left) - 1;
            for ($i = 1; $i < $parents_item_left; $i++) {
              $menu_trail_url = drupal_lookup_path('alias', $menu_trail_left[$i]['link_path']);
              $url_path = base_path() . $menu_trail_url;
              print '<li><a href="' . $url_path . '">' . $menu_trail_left[$i]['title'] . '<span class="campl-vertical-breadcrumb-indicator"></span></a></li>';
            }
          }
          ?>
        </ul>

        <ul class="campl-unstyled-list campl-vertical-breadcrumb-navigation">
          <?php print render($content); ?>
        </ul>

      </div>
    </div>
  </div>

<?php else: ?>
  <div class="<?php print $classes; ?>">
    <?php print render($content); ?>
  </div>
<?php endif; ?>
