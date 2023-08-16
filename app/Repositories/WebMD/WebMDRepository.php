<?php 

namespace App\Repositories\WebMD;

use Goutte\Client;

class WebMDRepository implements WebMDInterface {
  protected $jsonData;
  protected $blogData;

  public function categories($type) {
    $client = new Client();
    
    $website = $client->request('GET', 'https://blogs.webmd.com/default.htm');
    
    $website->filter('.module.blogs-topic-list')->each(function($node) use ($type) {
      
      $topic = $node->filter('h2.blog-section-title')->text();
      
      if($topic == ('Explore '.$type.' blog posts by topic')) {
        $categoryList = array();
        $node->filter('ul > li')->each(function($item) use (&$categoryList, $type) {
          $topic = $item->filter('a');

          $categoryList[] = array(
            "name" => $topic->text(),
            "url" => $topic->attr('href'),
            "type" => $type,
            "source" => 'WebMD',
          );
        });

        $this->jsonData = $categoryList;
      }
    });
    
    return $this->jsonData;
  }

  public function blogList($category) {
    $client = new Client();
    $website = $client->request('GET', $category['url']);
    $blogList = array();
    $categoryID = $category['id'];

    $website->filter('.latest-post-container > .latest-posts-data')->each(function($node) use (&$blogList, $categoryID) {
      
      $blog = $node->filter('.blog-post-single');

      $blogList[] = array(
        "title" => $blog->filter('.blog-post-content > h2 > a')->text(),
        "url" => $blog->filter('.blog-post-content > h2 > a')->attr('href'),
        "image" => $blog->filter('.blog-post-image > img')->attr('src'),
        "content" => $blog->filter('.blog-post-text > p')->text(),
        "category" => $categoryID,
        "author" => $blog->filter('.author-name > a')->text(),
        "author_title" => $blog->filter('.author-name > a')->attr('href'),
        //"author_image" => ,
        "published_date" => $blog->filter('.author-content > span:nth-child(2)')->text(),
        //"photo_credit" => $blog->filter('.blog-post-image > img')->attr('src'),
      );

    });
    
    $this->blogData = $blogList;

    return $this->blogData;
  }

  public function blog($slug) {

  }
} 