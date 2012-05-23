<?php

//:show the specified RSS feed
//:[[rss_feed?url=https://groups.google.com/group/phpmanufaktur-support/feed/rss_v2_0_msgs.xml]]

if (!file_exists(WB_PATH.'/modules/lib_simplepie/SimplePie/SimplePie.compiled.php')) {
  return "The library SimplePie is not installed!";
}
require_once WB_PATH.'/modules/lib_simplepie/SimplePie/SimplePie.compiled.php';

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
  if (!empty($result)) $result = "This feed is empty!";
  $result = sprintf('<div class="feed">%s</div>', $result);
}
else {
  $result = 'No items in the feed!';
}
return $result;
