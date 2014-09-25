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
		return View::make('303');
	}	

}
