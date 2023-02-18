<?php

class HTMLIterator {
  private $dom;

  public function __construct($html) {
    $this->dom = new DOMDocument();
    $this->dom->loadHTML($html, LIBXML_NOERROR);
  }

  public function getTagContent($tag, $attribute, $value) {
    $nodeList = $this->dom->getElementsByTagName($tag);
    $result = array();
    foreach ($nodeList as $node) {
      if ($node->hasAttribute($attribute) && $node->getAttribute($attribute) == $value) {
        $result[] = $node->getAttribute('content');
        $node->parentNode->removeChild($node);
      }
    }
    return $result;
  }

  public function removeTag($tag, $attribute, $value) {
    $nodeList = $this->dom->getElementsByTagName($tag);
    foreach ($nodeList as $node) {
      if ($node->hasAttribute($attribute) && $node->getAttribute($attribute) == $value) {
        $node->parentNode->removeChild($node);
      }
    }
  }
  
   public function removeCurrentTag($tag) {
    $nodeList = $this->dom->getElementsByTagName($tag);
    $result = array();
    foreach ($nodeList as $node) {
      $result[] = $node->nodeValue;
      $node->parentNode->removeChild($node);
    }
  }

  public function getHTML() {
    return $this->dom->saveHTML();
  }
}


$html = file_get_contents('./html.txt', true);
$iterator = new HTMLIterator($html);
$iterator->removeTag('meta', 'name', 'description');
$iterator->removeTag('meta', 'name', 'keywords');
$iterator->removeCurrentTag('title');

$clean_html = $iterator->getHTML();

$file_path = './new.txt';
file_put_contents($file_path, $clean_html);

echo "Откройте папку с кодом, там новый файл!";

?>
<a href="./new.txt" target="_blank"><button>Открыть файл</button></a>
<?php


?>