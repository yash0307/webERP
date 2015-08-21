<?php 

class SaleController extends BaseController
{
	public function getaddsalesitem()
	{
		return View::make('sales.add_salesitem');
	}
	public function post_save()
	{
		$validator = Validator::make(
				Input::all(),
				array(
					'delivery_address' => 'required'
					)
				);
		if($validator->fails())
		{
			return View::make('sales.add_salesitem')->withInput(Input::all())->withError($validator);
		}
		else
		{


			$select_customer=Input::get('select_customer');
			$select_item=Input::get('select_item');
			$delivery_address=Input::get('delivery_address');


			$sale1 = new Sale;
			$sale1->select_customer =$select_customer;
			$sale1->select_item =$select_item ;
			$sale1->delivery_address =$delivery_address; 
			if($sale1->save())
			{
				return View::make('sales.saved');
			}
			else
			{
				return View::make('home');
			}
		}
	}
}
