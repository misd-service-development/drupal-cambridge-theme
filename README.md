University of Cambridge Drupal 7 theme
======================================

This theme adds the University of Cambridge's house style to your Drupal 7 site.

Requirements
------------

- Drupal 7
- [Menu block module](https://drupal.org/project/menu_block)

Using the theme
---------------

### Adding navigation

#### Horizontal navigation

- Go to admin/structure/block and click 'Add menu block'.
- Set the 'Administrative title' to something descriptive (eg 'Horizontal menu').
- Set 'Menu' to the menu.
- Set the region to 'Horizontal Navigation' for the University of Cambridge theme.
- Click 'Save block'.

#### Vertical navigation

- Go to admin/structure/block and click 'Add menu block'.
- Click the 'Advanced options' tab.
- Set the 'Administrative title' to something descriptive (eg 'Vertical menu').
- Set 'Menu' to the menu.
- Check the 'Make the starting level follow the active menu item' option.
- Uncheck the 'Expand all children of this tree' option.
- Check the 'Sort menu tree by the active menu item's trail' option.
- Set the region to 'Left Navigation' for the University of Cambridge theme.
- Add '&lt;front&gt;', 'user' and 'user/*' to the 'Show block on specific pages' settings (making sure that the 'All pages except those listed' option is selected).
- Click 'Save block'.

### Adding the page title

- Enable the 'PHP filter' module.
- Go to admin/structure/block and click 'Add block'.
- Set 'Block Title' to '&lt;none&gt;'.
- Set the 'Block description' to something descriptive (eg 'Page title').
- Set the text format to 'PHP Code'.
- Set the region to 'Page Title' for the University of Cambridge theme.
- Add '&lt;front&gt;' to the 'Show block on specific pages' settings (making sure that the 'All pages except those listed' option is selected).
- Click 'Save block'.

Optional module integration
---------------------------

### Context

By default the section title on the page is the site's name, to change this for a section you can set it through the [Context](https://drupal.org/project/context) module. To change the theme settings (eg the colour scheme) for a section you can use the [Delta](https://drupal.org/project/delta) module.

### Easy breadcrumb

You can replace Drupal's native breadcrumbs with the [Easy breadcrumb](https://drupal.org/project/easy_breadcrumb) module. Once enabled, place the 'Easy Breadcrumb' block in the 'Breadcrumb' region.

### Touch Icons

Drupal allows you to change the University's favicon natively, but to change the Web Clip icon for iOS devices install the [Touch Icons](https://drupal.org/project/touch_icons) module.

### Views

A carousel can be created using the Views module.

The requirements are:

- The view is called 'Carousel' and has one or more block displays.
- The blocks are placed in the 'Carousel' region.
- The format is an unordered 'HTML list', the row class is 'campl-slide campl-column12' and the list class is 'campl-unstyled-list campl-slides'.
- There are 2 fields:
    1. An image (886x432), which has the field class 'image-container' and is linked to the relevant URL.
    2. A caption, which has the field class 'campl-slide-caption', is rewritten to '&lt;span class="campl-slide-caption-txt"&gt;[CAPTION_FIELD_PATTERN]</span>' and is linked to the relevant URL.
- All default views classes are turned off.
