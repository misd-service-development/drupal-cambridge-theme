<?php if ($config['in_left_navigation'] === TRUE): ?>

  <div class="<?php print $classes; ?>">
    <div class="campl-tertiary-navigation-structure">
      <ul class="campl-unstyled-list campl-vertical-breadcrumb">
        <?php

        $link_text = variable_get('site_name') . '<span class="campl-vertical-breadcrumb-indicator"></span>';
        print '<li>' . l($link_text, '<front>', array('html' => TRUE)) . '</li>';

        $menu_trail_left = menu_get_active_trail('node/' . arg(1));

        if (count($menu_trail_left) > 2) {
          $this_item = end($menu_trail_left);
          $parent_item = prev($menu_trail_left);
          reset($menu_trail_left);

          $parents_item_left = count($menu_trail_left) - 1;

          if ($this_item['has_children'] == FALSE) {
            $parents_item_left--;
          }

          for ($i = 1; $i < $parents_item_left; $i++) {
            if ('<firstchild>' === $menu_trail_left[$i]['link_path']) {
              $menu_trail_left[$i]['link_path'] = _menu_firstchild_get_firstchild_href($menu_trail_left[$i]['mlid']);
            }

            $menu_trail_url = drupal_lookup_path('alias', $menu_trail_left[$i]['link_path']);
            if (FALSE === $menu_trail_url) {
              $menu_trail_url = $menu_trail_left[$i]['link_path'];
            }
            $link_text = $menu_trail_left[$i]['title'] . '<span class="campl-vertical-breadcrumb-indicator"></span>';
            print '<li>' . l($link_text, $menu_trail_url, array('html' => TRUE)) . '</li>';
          }
        }
        ?>
      </ul>

      <ul class="campl-unstyled-list campl-vertical-breadcrumb-navigation">
        <?php if (count($menu_trail_left) > 2 && $this_item['has_children'] == FALSE): ?>
          <li class="campl-selected">
            <?php

            if ('<firstchild>' === $parent_item['link_path']) {
              $parent_item['link_path'] = _menu_firstchild_get_firstchild_href($parent_item['mlid']);
            }

            $parent_item_url = drupal_lookup_path('alias', $parent_item['link_path']);
            if (FALSE === $parent_item_url) {
              $parent_item_url = $parent_item['link_path'];
            }
            print l($parent_item['link_title'], $parent_item_url);
            ?>
            <ul class="campl-unstyled-list campl-vertical-breadcrumb-children">
              <?php print render($content); ?>
            </ul>
          </li>
          <?php
          $uncles = cambridge_theme_get_menu_siblings($parent_item);

          foreach ($uncles as $uncle) {
            if ($uncle->mlid == $parent_item['mlid'] || $uncle->link_title == t('Home')) {
              continue;
            }

            if ('<firstchild>' === $uncle->link_path) {
              $uncle->link_path = _menu_firstchild_get_firstchild_href($uncle->mlid);
            }

            $uncle_url = drupal_lookup_path('alias', $uncle->link_path);
            if (FALSE === $uncle_url) {
              $uncle_url = $uncle->link_path;
            }
            print '<li>' . l($uncle->link_title, $uncle_url) . '</li>';
          }
          ?>
        <?php else: ?>
          <?php print render($content); ?>
        <?php endif; ?>
      </ul>

    </div>
  </div>

<?php else: ?>
  <div class="<?php print $classes; ?>">
    <?php print render($content); ?>
  </div>
<?php endif; ?>
