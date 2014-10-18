<?php

class Page extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

    public $timestamps = false;

    protected $fillable = array('page', 'title', 'content', 'category', 'url', 'length', 'pages');

}
