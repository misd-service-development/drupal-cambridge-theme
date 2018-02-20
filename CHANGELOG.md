Changelog
=========

Note: the theme contains the University's house style assets (CSS, images, JavaScript). For the sake of completeness, all updates to these are also listed below.

7.x-1.9

* The primary purpose of this release is to add new CSS to support the import of Falcon / Plone CMS websites into the University's standard Drupal setup (e.g. adding the two Project Light colour schemes that were not previously available in Drupal). This release has also resolved a number of support issues, detailed below:

* [103 - Textarea form elements do not display correctly on mobile] (https://github.com/misd-service-development/drupal-cambridge-theme/issues/103)
* [101 - Empty Footer Blocks Throw Warning Message] (https://github.com/misd-service-development/drupal-cambridge-theme/issues/101)
* [100 - Added css and Icons to support migrated falcon sites] (https://github.com/misd-service-development/drupal-cambridge-theme/pull/100)
* [99 - Update search.cam.ac.uk URL to be https:// instead of http://] (https://github.com/misd-service-development/drupal-cambridge-theme/pull/99)

7.x-1.8

* Updated the theme to take into account the changes in the latest version of Easy Breadcrumb module 7.x-2.13. Their theme layer has changed completely and we have had to match the changes to allow us to continue to use easy breadcrumb in some Cambridge sites. If you are using easy breadcrumb prior to 7.x-2.13 you will need to upgrade to this version of the module if you wish to continue using easy breadcrumb and the Cambridge theme. 

7.x-1.7

* Updated code comments.

7.x-1.6

* Updated code comments.

7.x-1.5

* Fixed a bug that stopped menu items being clickable if they had child pages
  and were more than 2 levels deep in the navigation on the mobile view.

7.x-1.4
-------

14 May 2015.

* Add RSS feed icons to pages.
* Allow 'home' menu items to not be labelled 'Home'.
* Add compatibility with Views ajax and/or mini pagers.
* Improve Drupal-level navigation performance.
* Revert forcing all menu blocks in the horizontal and vertical navigation to be expanded.
* Use Drupal Behaviors, so JavaScript is applied to Ajax-loaded content.
* Fix IE8 font issues.
* If an active trail in the navigation doesn't have an active item, make the lowest item appear as such.
* Fix styling of alert messages.

7.x-1.3
-------

5 January 2015.

* Fix PHP warning when a node page has no fields with content.
* Add options to configure the global header search box.
* Fix typo (Grey rather than Gray).
* Remove broken Context-based renaming of menu items.
* Make sure that all menu blocks in the horizontal and vertical navigation regions are expanded.
* Fix configuration override for menu blocks placed by Context.

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
