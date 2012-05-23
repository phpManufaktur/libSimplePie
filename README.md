### libSimplePie

A library for the Content Management Systems [WebsiteBaker] [1] and [LEPTON CMS] [2] for access to RSS/ATOM feeds using the library [SimplePie] [3]

#### Requirements

* minimum PHP 5.2.x
* using [WebsiteBaker] [1]
* /or/ using [LEPTON CMS] [2]

#### Installation

* download the actual [libSimplePie_x.xx.zip] [4] installation archive
* in CMS backend select the file from "Add-ons" -> "Modules" -> "Install module"

#### First Steps

You can access *libSimplePie* from your own addons:

    require_once WB_PATH.'/modules/lib_simplepie/SimplePie/SimplePie.compiled.php';
    
    $feed = new SimplePie();
    $feed->set_feed_url('any_rss_or_atom_url');
    $feed->set_cache_location(WB_PATH.'/temp');
    $feed->init();
    $feed->handle_content_type();
     
A very easy way to access the libSimplePie and to get the contents of a RSS or ATOM feed to your website is using a /Droplet/.

You will find some sample Droplet Code in `/modules/lib_simplepie/droplets/`.

* in the CMS backend select "Admin-Tools" -> "Droplets" -> "Add Droplet"
* name the Droplet "rss_feed"
* insert the following code:

    if (!file_exists(WB_PATH.'/modules/lib_simplepie//SimplePie/SimplePie.compiled.php')) {
      return "The library SimplePie is not installed!";
    }
    require_once WB_PATH.'/modules/rss/SimplePie.compiled.php';

    if (!isset($url)) {
      return "Please use the parameter 'url' to specify the RSS feed to read.";
    }

    $feed = new SimplePie();
    $feed->set_feed_url($url);
    $feed->set_cache_location(WB_PATH.'/temp');
    $feed->init();
    $feed->handle_content_type();

    $result = '';
    if ($feed->data) {
      $items = $feed->get_items();
      foreach ($items as $item) {
        $result .= '<div class="feed_item">';
        $result .= sprintf('<h4><a href="%s" target="_blank">%s</a></h4>', $item->get_permalink(), $item->get_title());
        $result .= sprintf('<div class="feed_item_date">%s</div>', $item->get_date('d.m.Y - H:i'));
        $result .= sprintf('<div class="feed_item_content">%s</div>', $item->get_content());
        $result .= '</div>';
      }
      if (empty($result)) $result = "This feed is empty!";
      $result = sprintf('<div class="feed">%s</div>', $result);
    }
    else {
      $result = 'No items in the feed!';
    }
    return $result;

and save the Droplet.

Now you can use this Droplet in any WYSIWYG section. Place it where you want and use the parameter `url` to specify the RSS/ATOM feed you want to read from:

    [[rss_feed?url=https://groups.google.com/group/phpmanufaktur-support/feed/rss_v2_0_msgs.xml]]
    
The Droplet will prompt the last 15 entries from the [phpManufaktur - General Addons Support] [5] Google Group.  
  

[1]: http://websitebaker2.org "WebsiteBaker Content Management System"
[2]: http://lepton-cms.org "LEPTON CMS"
[3]: https://github.com/simplepie/simplepie "GitHub: SimplePie"
[4]: https://github.com/phpManufaktur/libSimplePie/downloads
[5]: https://groups.google.com/group/phpmanufaktur-support?hl=de