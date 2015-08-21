<?php
/**
  Yash Patel
  **/
class ListofitemsController extends BaseController
{
	public function getlistofitems()
	{
		$items = DB::table('inventory_items')->get();
		return View::make('list.items')->with('items',$items);
	}
}
