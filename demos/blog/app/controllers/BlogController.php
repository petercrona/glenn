<?php
namespace controllers;

use glenn\controller\Controller,
	glenn\http\Response;

class BlogController extends Controller
{
	public function indexAction()
	{
		return new Response('Hello Blog!');
	}
	
	public function newAction()
	{
		return new Response('Hello Create Blog Post!');
	}
	
	public function createAction()
	{
		$response = new Response(null, 303);
		$response->addHeader('Location', 'http://www.google.com');
		return $response;
	}
}