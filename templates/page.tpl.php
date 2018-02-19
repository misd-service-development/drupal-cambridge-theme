<?php

global $base_url;

$base_theme_path = base_path() . drupal_get_path('theme', 'cambridge_theme');

$site_title = !empty($section_title) ? $section_title : $site_name;

$has_carousel = isset($page['carousel']) && count($page['carousel']);
$has_left_navigation = isset($page['left_navigation']) && count($page['left_navigation']);
$has_page_title = !$is_front && !$has_carousel && $title && $title != '' && ($has_left_navigation || $title !== $site_title);
$has_sub_content = isset($page['sub_content']) && count($page['sub_content']);
$has_sidebar = (isset($page['sidebar']) && count($page['sidebar'])) || $has_carousel;
$has_partnerships = isset($page['partnerships']) && count($page['partnerships']);

?>

<div class="campl-row campl-global-header">
  <div class="campl-wrap clearfix">
    <div class="campl-header-container campl-column8" id="global-header-controls">
      <a href="http://www.cam.ac.uk" class="campl-main-logo">
        <img alt="University of Cambridge" src="<?php print $base_theme_path; ?>/images/interface/main-logo-small.png"/>
      </a>

      <ul class="campl-unstyled-list campl-horizontal-navigation campl-global-navigation clearfix">
        <li>
          <a href="#study-with-us">Study at Cambridge</a>
        </li>
        <li>
          <a href="#about-the-university">About the University</a>
        </li>
        <li>
          <a href="http://www.cam.ac.uk/research" class="campl-no-drawer">Research at Cambridge</a>
        </li>
      </ul>
    </div>

    <div class="campl-column2">
      <div class="campl-quicklinks">
      </div>
    </div>

    <div class="campl-column2">

      <div class="campl-site-search" id="site-search-btn">

        <label for="header-search" class="hidden">Search site</label>

        <div class="campl-search-input">
          <form action="https://search.cam.ac.uk/web" method="get">
            <input id="header-search" type="text" name="query" value="" placeholder="Search"/>

            <?php
            switch (theme_get_setting('search_box')):
              case 1:
                print '<input type="hidden" name="filterTitle" value="' . $site_name . '"/>';
                print '<input type="hidden" name="include" value="' . $base_url . '"/>';
                break;
              case 2:
                print '<input type="hidden" name="inst" value="' .
                  htmlspecialchars(theme_get_setting('search_box_filter_inst')) . '"/>';
                if (theme_get_setting('search_box_filter_tag')):
                  print '<input type="hidden" name="tag" value="' .
                    htmlspecialchars(theme_get_setting('search_box_filter_tag')) . '"/>';
                endif;
                break;
            endswitch;
            ?>

            <input type="image" class="campl-search-submit"
                   src="<?php print $base_theme_path; ?>/images/interface/btn-search-header.png"/>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="campl-row campl-global-header campl-search-drawer">
  <div class="campl-wrap clearfix">
    <form class="campl-site-search-form" id="site-search-container" action="https://search.cam.ac.uk/web" method="get">
      <div class="campl-search-form-wrapper clearfix">
        <input type="text" class="text" name="query" value="" placeholder="Search"/>

        <?php
        switch (theme_get_setting('search_box')):
          case 1:
            print '<input type="hidden" name="filterTitle" value="' . $site_name . '"/>';
            print '<input type="hidden" name="include" value="' . $base_url . '"/>';
            break;
          case 2:
            print '<input type="hidden" name="inst" value="' .
              htmlspecialchars(theme_get_setting('search_box_filter_inst')) . '"/>';
            if (theme_get_setting('search_box_filter_tag')):
              print '<input type="hidden" name="tag" value="' .
                htmlspecialchars(theme_get_setting('search_box_filter_tag')) . '"/>';
            endif;
            break;
        endswitch;
        ?>

        <input type="image" class="campl-search-submit"
               src="<?php print $base_theme_path; ?>/images/interface/btn-search.png"/>
      </div>
    </form>
  </div>
</div>

<div class="campl-row campl-global-navigation-drawer">

  <div class="campl-wrap clearfix">
    <div class="campl-column12 campl-home-link-container">
      <a href="">Home</a>
    </div>
  </div>
  <div class="campl-wrap clearfix">
    <div class="campl-column12 campl-global-navigation-mobile-list campl-global-navigation-list">
      <div class="campl-global-navigation-outer clearfix" id="study-with-us">
        <ul class="campl-unstyled-list campl-global-navigation-header-container ">
          <li><a href="http://www.cam.ac.uk/study-at-cambridge">Study at Cambridge</a></li>
        </ul>
        <div class="campl-column4">
          <ul
            class="campl-global-navigation-container campl-unstyled-list campl-global-navigation-secondary-with-children">
            <li>
              <a href="http://www.study.cam.ac.uk/undergraduate/">Undergraduate</a>
              <ul class="campl-global-navigation-tertiary campl-unstyled-list">
                <li>
                  <a href="http://www.study.cam.ac.uk/undergraduate/courses/">Courses</a>
                </li>
                <li>
                  <a href="http://www.study.cam.ac.uk/undergraduate/apply/">Applying</a>
                </li>
                <li>
                  <a href="http://www.study.cam.ac.uk/undergraduate/events/">Events and open days</a>
                </li>
                <li>
                  <a href="http://www.study.cam.ac.uk/undergraduate/finance/">Fees and finance</a>
                </li>
                <li>
                  <a href="http://www.becambridge.com/">Student blogs and videos</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="campl-column4">
          <ul
            class="campl-global-navigation-container campl-unstyled-list campl-global-navigation-secondary-with-children">
            <li>
              <a href="http://www.admin.cam.ac.uk/students/gradadmissions/prospec/">Graduate</a>
              <ul class="campl-global-navigation-tertiary campl-unstyled-list">
                <li>
                  <a href="http://www.admin.cam.ac.uk/students/gradadmissions/prospec/whycam/">Why Cambridge</a>
                </li>
                <li>
                  <a href="http://www.admin.cam.ac.uk/students/gradadmissions/prospec/studying/qualifdir/">Qualifications
                    directory</a>
                </li>
                <li>
                  <a href="http://www.admin.cam.ac.uk/students/gradadmissions/prospec/apply/">How to apply</a></li>
                <li><a href="http://www.admin.cam.ac.uk/students/studentregistry/fees/">Fees and funding</a></li>
                <li><a href="http://www.admin.cam.ac.uk/students/gradadmissions/prospec/faq/index.html">Frequently asked
                    questions</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="campl-column4">
          <ul class="campl-global-navigation-container campl-unstyled-list last">
            <li>
              <a href="http://www.cam.ac.uk/about-the-university/international-cambridge/studying-at-cambridge">International
                students</a>
            </li>
            <li>
              <a href="http://www.ice.cam.ac.uk">Continuing education</a>
            </li>
            <li>
              <a href="http://www.admin.cam.ac.uk/offices/education/epe/">Executive and professional education</a>
            </li>
            <li>
              <a href="http://www.educ.cam.ac.uk">Courses in education</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="campl-global-navigation-outer clearfix" id="about-the-university">
        <ul class="campl-global-navigation-header-container campl-unstyled-list">
          <li><a href="http://www.cam.ac.uk/about-the-university">About the University</a></li>
        </ul>
        <div class="campl-column4">
          <ul class="campl-global-navigation-container campl-unstyled-list">
            <li>
              <a href="http://www.cam.ac.uk/about-the-university/how-the-university-and-colleges-work">How the
                University and Colleges work</a>
            </li>
            <li>
              <a href="http://www.cam.ac.uk/about-the-university/history">History</a>
            </li>
            <li>
              <a href="http://www.cam.ac.uk/about-the-university/visiting-the-university">Visiting the University</a>
            </li>
            <li>
              <a href="http://www.cam.ac.uk/about-the-university/term-dates-and-calendars">Term dates and calendars</a>
            </li>
            <li class="last">
              <a href="http://map.cam.ac.uk">Map</a>
            </li>
          </ul>
        </div>
        <div class="campl-column4">
          <ul class="campl-global-navigation-container campl-unstyled-list">
            <li>
              <a href="http://www.cam.ac.uk/for-media">For media</a>
            </li>
            <li>
              <a href="http://www.cam.ac.uk/video-and-audio">Video and audio</a>
            </li>
            <li>
              <a href="http://webservices.admin.cam.ac.uk/faesearch/map.cgi">Find an expert</a>
            </li>
            <li>
              <a href="http://www.cam.ac.uk/about-the-university/publications">Publications</a>
            </li>
            <li class="last">
              <a href="http://www.cam.ac.uk/about-the-university/international-cambridge">International Cambridge</a>
            </li>
          </ul>
        </div>
        <div class="campl-column4">
          <ul class="campl-global-navigation-container campl-unstyled-list">
            <li>
              <a href="http://www.cam.ac.uk/news">News</a>
            </li>
            <li>
              <a href="http://www.admin.cam.ac.uk/whatson">Events</a>
            </li>
            <li>
              <a href="http://www.cam.ac.uk/public-engagement">Public engagement</a>
            </li>
            <li>
              <a href="http://www.jobs.cam.ac.uk">Jobs</a>
            </li>
            <li class="last">
              <a href="http://www.philanthropy.cam.ac.uk">Giving to Cambridge</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="campl-global-navigation-outer clearfix" id="our-research">
        <ul class="campl-global-navigation-header-container campl-unstyled-list">
          <li><a href="">Research at Cambridge</a></li>
        </ul>
      </div>
    </div>

    <ul class="campl-unstyled-list campl-quicklinks-list campl-global-navigation-container ">
      <li>
        <a href="http://www.cam.ac.uk/for-staff">For staff</a>
      </li>
      <li>
        <a href="http://www.admin.cam.ac.uk/students/gateway">For current students</a>
      </li>
      <li>
        <a href="http://www.alumni.cam.ac.uk">For alumni</a>
      </li>
      <li>
        <a href="http://www.cam.ac.uk/for-business">For business</a>
      </li>
      <li>
        <a href="http://www.cam.ac.uk/colleges-and-departments">Colleges &amp; departments</a>
      </li>
      <li>
        <a href="http://www.cam.ac.uk/libraries-and-facilities">Libraries &amp; facilities</a>
      </li>
      <li>
        <a href="http://www.cam.ac.uk/museums-and-collections">Museums &amp; collections</a>
      </li>
      <li class="last">
        <a href="http://www.cam.ac.uk/email-and-phone-search">Email &amp; phone search</a>
      </li>
    </ul>
  </div>
</div>

<div class="campl-row campl-page-header campl-section-page">
  <div class="campl-wrap clearfix">
    <div class="campl-column12">
      <div class="campl-content-container <?php if ($logo): ?>campl-co-branding-container<?php endif; ?>">

        <?php print $breadcrumb; ?>

        <?php if (isset($page['breadcrumb'])) : ?>
          <?php print render($page['breadcrumb']); ?>
        <?php endif; ?>

        <?php if ($logo): ?>
          <img src="<?php print $logo; ?>" class="campl-co-branding-logo" alt=""/>
        <?php endif; ?>

        <h1 class="campl-page-title">
          <?php print $site_title; ?>
          <?php if (!$has_page_title): print $feed_icons; endif; ?>
        </h1>

        <?php if ($site_slogan): ?>
          <div id="site-slogan" class="campl-page-subtitle">
            <?php print $site_slogan; ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<?php if (isset($page['horizontal_navigation'])) : ?>
  <div class="campl-row campl-page-header">
    <div class="campl-wrap">
      <?php print render($page['horizontal_navigation']); ?>
    </div>
  </div>
<?php endif; ?>

<?php if ($has_carousel) : ?>
  <div class="campl-row campl-page-header">
    <div class="campl-wrap clearfix">
      <div class="campl-column9 campl-recessed-carousel">
        <?php print render($page['carousel']); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if ($has_page_title): ?>
  <div class="campl-row campl-page-header">
    <div class="campl-wrap clearfix campl-page-sub-title campl-recessed-sub-title">
      <?php if ($has_left_navigation): ?>
        <div class="campl-column3 campl-spacing-column">
          &nbsp;
        </div>
      <?php endif; ?>

      <div class="<?php print $has_left_navigation ? 'campl-column9' : 'campl-column12'; ?>">
        <div class="campl-content-container clearfix contextual-links-region">
          <?php print render($title_prefix); ?>
          <h1 class="campl-sub-title"><?php print $title; ?> <?php print $feed_icons; ?></h1>
          <?php print render($title_suffix); ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if ($has_left_navigation || isset($page['content']) || $messages || $has_sidebar) : ?>
  <div class="campl-row campl-content
    <?php if ($has_page_title || $has_carousel): print 'campl-recessed-content'; endif; ?>">
    <div class="campl-wrap clearfix">
      <?php if ($has_left_navigation) : ?>
        <div class="campl-column3">
          <div class="campl-tertiary-navigation">
            <?php print render($page['left_navigation']); ?>
          </div>
        </div>
      <?php endif; ?>
      <?php if (isset($page['content'])) : ?>
        <?php
        $columns = 12;
        if ($has_left_navigation) {
          $columns = $columns - 3;
        }
        if ($has_sub_content) {
          $columns = $columns - 3;
        }
        if ($has_sidebar) {
          $columns = $columns - 3;
        }
        ?>
        <div class="campl-column<?php print $columns; ?> campl-main-content" id="page-content">

          <div class="<?php if ($has_sub_content): ?>campl-sub-column-right-border<?php endif; ?>">

            <?php if ($messages): ?>
              <?php print $messages; ?>
            <?php endif; ?>

            <?php if ($tabs): ?>
              <?php print render($tabs); ?>
            <?php endif; ?>

            <?php print render($page['content']); ?>

          </div>

        </div>
      <?php endif; ?>

      <?php if ($has_sub_content) : ?>
        <div class="campl-column3 campl-sub-column-left-border campl-main-content-sub-column">
          <?php print render($page['sub_content']); ?>
        </div>
      <?php endif; ?>

      <?php if ($has_sidebar) : ?>
        <div class="campl-column3 campl-secondary-content <?php if ($has_carousel):
          print 'campl-recessed-secondary-content'; endif; ?>">
          <?php print render($page['sidebar']); ?>
        </div>
      <?php endif; ?>

      <?php if ($has_partnerships) : ?>
        <div class="campl-column12 campl-partnership-branding">
          <div class="campl-content-container campl-side-padding">
            <?php print render($page['partnerships']); ?>
          </div>
        </div>
      <?php endif; ?>

    </div>

  </div>
<?php endif; ?>

<?php if (
  (isset($page['footer_1']) && count($page['footer_1'])) ||
  (isset($page['footer_2']) && count($page['footer_2'])) ||
  (isset($page['footer_3']) && count($page['footer_3'])) ||
  (isset($page['footer_4']) && count($page['footer_4']))
) : ?>
  <div class="campl-row campl-local-footer">
    <div class="campl-wrap clearfix">
      <div class="campl-column3 campl-footer-navigation">
        <?php if (isset($page['footer_1'])) : ?>
          <?php print render($page['footer_1']); ?>
        <?php endif; ?>
      </div>
      <div class="campl-column3 campl-footer-navigation">
        <?php if (isset($page['footer_2'])) : ?>
          <?php print render($page['footer_2']); ?>
        <?php endif; ?>
      </div>
      <div class="campl-column3 campl-footer-navigation">
        <?php if (isset($page['footer_3'])) : ?>
          <?php print render($page['footer_3']); ?>
        <?php endif; ?>
      </div>
      <div class="campl-column3 campl-footer-navigation last">
        <?php if (isset($page['footer_4'])) : ?>
          <?php print render($page['footer_4']); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="campl-row campl-global-footer">
  <div class="campl-wrap clearfix">
    <div class="campl-column3 campl-footer-navigation">
      <div class="campl-content-container campl-footer-logo">
        <img alt="University of Cambridge" src="<?php print $base_theme_path; ?>/images/interface/main-logo-small.png"
             class="campl-scale-with-grid"/>

        <p>&#169; <?php print date('Y'); ?> University of Cambridge</p>
        <ul class="campl-unstyled-list campl-global-footer-links">
          <li>
            <a href="http://www.cam.ac.uk/university-a-z">University A-Z</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/contact-the-university">Contact the University</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/about-this-site/accessibility">Accessibility</a>
          </li>
          <li>
            <a href="http://www.admin.cam.ac.uk/univ/information/foi/">Freedom of information</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/about-this-site/terms-and-conditions">Terms and conditions</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="campl-column3 campl-footer-navigation">
      <div class="campl-content-container campl-navigation-list">

        <div class="link-list">
          <h3><a href="http://www.cam.ac.uk/study-at-cambridge">Study at Cambridge</a></h3>
          <ul class="campl-unstyled-list">
            <li>
              <a href="http://www.study.cam.ac.uk/undergraduate/">Undergraduate</a>
            </li>
            <li>
              <a href="http://www.admin.cam.ac.uk/students/gradadmissions/prospec/">Graduate</a>
            </li>
            <li>
              <a href="http://www.cam.ac.uk/about-the-university/international-cambridge/studying-at-cambridge">International
                students</a>
            </li>
            <li>
              <a href="http://www.ice.cam.ac.uk">Continuing education</a>
            </li>
            <li>
              <a href="http://www.admin.cam.ac.uk/offices/education/epe/">Executive and professional education</a>
            </li>
            <li>
              <a href="http://www.educ.cam.ac.uk">Courses in education</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="campl-column3 campl-footer-navigation">
      <div class="campl-content-container campl-navigation-list">
        <h3><a href="http://www.cam.ac.uk/about-the-university">About the University</a></h3>
        <ul class="campl-unstyled-list campl-page-children">
          <li>
            <a href="http://www.cam.ac.uk/about-the-university/how-the-university-and-colleges-work">How the University
              and Colleges work</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/about-the-university/visiting-the-university">Visiting the University</a>
          </li>
          <li>
            <a href="http://map.cam.ac.uk">Map</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/news">News</a>
          </li>
          <li>
            <a href="http://www.admin.cam.ac.uk/whatson">Events</a>
          </li>
          <li>
            <a href="http://www.jobs.cam.ac.uk">Jobs</a>
          </li>
          <li>
            <a href="http://www.philanthropy.cam.ac.uk">Giving to Cambridge</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="campl-column3 campl-footer-navigation last">
      <div class="campl-content-container campl-navigation-list">
        <h3><a href="http://www.cam.ac.uk/research">Research at Cambridge</a></h3>
        <ul class="campl-unstyled-list">
          <li>
            <a href="http://www.cam.ac.uk/research/news">News</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/research/features">Features</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/research/discussion">Discussion</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/research/spotlight-on">Spotlight on...</a>
          </li>
          <li>
            <a href="http://www.cam.ac.uk/research/research-at-cambridge">About research at Cambridge</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
