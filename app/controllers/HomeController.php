<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		$posts = Post::paginate(2);
		return View::make('home.index')->with('posts', $posts);
	}


}
