<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function index()
	{
		// football stories
		$feed = FeedReader::read('http://newsrss.bbc.co.uk/rss/sportonline_uk_edition/football/rss.xml');
		$i = 1;
		$page_number = 303;
		
		foreach($feed->get_items() as $item){			
			if($i < 10) {
				// get the url	
				$url = $item->get_link();
				
				// get the title
				$title = $item->get_title();
				
				// get the content
				// load the file
				$content = file_get_contents($url);
				
				// shhh
				libxml_use_internal_errors(true);
				
				// get the file and get the .article
				@$doc = new DOMDocument();
				@$doc->loadHTML($content);
				$xml = simplexml_import_dom($doc);
				$result = $xml->xpath('//*[contains(concat(" ", normalize-space(@class), " "), " article ")]');
				
				// get it out of its own mess
				foreach($result as $content){
					$content = $content;
				}
				
				// get the length before the pees
				$length = strlen($content);
				
				// as long as it doesn't have some kind of BBC code in it, wrap it in pees
				foreach($content as $a) {
					$a = trim($a);
					if(!strpos($a, '[')){
						if(!strpos($a, ');')){
							$content .= '<p>' . $a . '</p>';
						}
					}
				}
				
				// make an array with the article content and give it it's own variable
				$article = ['content' => $content];			
				$content = $article['content'];
				
				// what's the category?				
				$url = explode('/', $url);
				$category = $url[5];
				$category = str_replace('-', ' ', $category);
				$category = ucwords($category);
				$url = $item->get_link();
				
				// echo (will be db insert)
				echo '<p>' . $title . ' - ' . $page_number . '</p>';
				
				// insert
				//$page = new Page;
				
				$page = Page::where('page_number', $page_number)->first();
				$page->page_number = $page_number;
				$page->title = $title;
				$page->content = $content;
				$page->category = $category;
				$page->url = $url;
				$page->length = $length;
				
				$page->save();				
				
				// iterate
				$i++; $page_number++;
			}
		}
	}

	public function sportsHeadlines()
	{
		$feed = FeedReader::read('http://newsrss.bbc.co.uk/rss/sportonline_uk_edition/front_page/rss.xml');		
		
		return View::make('301', ['feed' => $feed]);
	}	

	public function footballHeadlines()
	{
		$feed = FeedReader::read('http://feeds.bbci.co.uk/sport/0/football/rss.xml');		
		
		return View::make('302', ['feed' => $feed]);
	}	

	public function footballStory()
	{
		$feed = FeedReader::read('http://feeds.bbci.co.uk/sport/0/football/rss.xml');	
	
		// get the content
		// load the file
		$content = file_get_contents('http://www.bbc.co.uk/sport/0/football/29371753');
		
		// shhh
		libxml_use_internal_errors(true);
		
		// get the file and get the .article
		@$doc = new DOMDocument();
		@$doc->loadHTML($content);
		$xml = simplexml_import_dom($doc);
		$result = $xml->xpath('//*[contains(concat(" ", normalize-space(@class), " "), " article ")]');
		
		// get it out of its own mess
		foreach($result as $content){
			$content = $content;
		}
		
		// as long as it doesn't have some kind of BBC code in it, wrap it in pees
		foreach($content as $a) {
			$a = trim($a);
			if(!strpos($a, '[')){
				if(!strpos($a, ');')){
					$content .= '<p>' . $a . '</p>';
				}
			}
		}
		
		// make an array with the article content
		$article = ['content' => $content];
		
		return View::make('303', ['feed' => $feed, 'article' => $article]);
	}	

}
