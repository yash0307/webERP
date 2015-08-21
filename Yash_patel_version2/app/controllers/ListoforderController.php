<?php

/**
  Yash Patel
  **/
class ListoforderController extends BaseController
{
	public function getlistoforder()
	{
		$purchase_list = DB::table('purchase_order_items')->get;
		
	}
}
