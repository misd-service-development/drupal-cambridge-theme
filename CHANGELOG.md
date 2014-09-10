Changelog
=========

Note: the theme contains the University's house style assets (CSS, images, JavaScript). For the sake of completeness, all updates to these are also listed below.

7.x-1.2
-------

10 September 2014.

* Fix horizontal navigation 'overview' items being added if there are only hidden child items.
* Style contextual links.
* Fix problem where modules (such as [Image Class](https://drupal.org/node/2246595#comment-8769415)) use a string where an array is expected.
* Fix bug where responsive tables tried to add a heading where one didn't exists, leading to 'undefined' being used.
* Style the maintenance mode page.
* Place Views exposed forms in a content container.
* Increase the margin between fields.
* Remove vertical navigation 'overview' items.
* Fix bug where the vertical/horizontal navigation blocks wouldn't have the correct settings applied.
* Place links and comments in a content container.
* Fix bug where carousel captions are erroneously truncated.
* Normalised position of the drop-down icon on the horizontal navigation.
* `<em>` elements no long override `font-weight`.
* Fix bug where `<input type="image">` elements would have a width enforced.
* Fix bug where the global navigation would pop down on some smaller screens.

7.x-1.1
-------

27 May 2014.

* Remove bottom padding from local tasks.
* Don't show empty content containers.
* Don't show the page title if it's the same as the site name.
* Style taxonomy term pages.
* Fix PHP 5.2 compatibility.
* Force menu block configuration.
* Position the contextual links menu for the horizontal navigation correctly.
* Fix styling of blocks in the Partnership region.
* Fix bugs with the vertical navigation.
* Prevent inaccessible items from breaking the positioning of leading images.
* Fix the mobile navigation from opening at the level above the current page when on an 'overview' page.
* Stop Internet Explorer from using compatibility mode.
* Allow modules (such as CKEditor) which place JavaScript in `$page_bottom` rather than `$scripts` to work.
* Don't automatically add table classes to tables outside of text fields.
* Add pagination styling.
* Stop text areas from being only 18px high.

7.x-1.0
-------

17 January 2014.

* Initial release.
