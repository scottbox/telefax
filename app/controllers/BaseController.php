<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	public function __construct()
	{
		$content = file_get_contents('http://www.bbc.co.uk/sport/0/football/29371753');
		$content = str_replace('</head>','<link rel="stylesheet" href="stylesheets/styles.css" /></head>', $content);
		
		libxml_use_internal_errors(true);
		/*$dom = new DOMDocument();
		$dom->loadHTML($content);
		$head = $dom->getElementsByTagName('head');

		$remove = [];
		foreach($head as $item)
		{
		  $remove[] = $item;
		}

		foreach ($remove as $item)
		{
		  $item->parentNode->removeChild($item); 
		}

		$content = $dom->saveHTML();*/
		
		@$doc = new DOMDocument();
		@$doc->loadHTML($content);
		$xml = simplexml_import_dom($doc);
		$result = $xml->xpath('//*[contains(concat(" ", normalize-space(@class), " "), " article ")]');
		
		foreach($result as $article){
			$article = $article;
		}
		
		foreach($article as $a) {
			$a = trim($a);
			if(!strpos($a, '[')){
				if(!strpos($a, ');')){
					$article .= '<p>' . $a . '</p>';
				}
			}
		}
		
		View::share('article', $article);
	}

}
