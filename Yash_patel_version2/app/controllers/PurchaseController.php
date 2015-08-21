<?php
/**
	Yash Khandelwal
  **/

class PurchaseController extends BaseController
{
	public function get_purchase_order()
	{
		return View::make('purchase.add_order');
	}

	public function search_supplier()
	{
		    $text_input = Input::get('in');

		    $suppliers = DB::table('suppliers')->lists('supplier_name');
		    
		    $stack = array();
		    	foreach ($suppliers as $value )
		    	{
		    		//if (stristr($value,'a') === true){
		    		//	return $value;
		    		//}
		    		if (strpos($value,$text_input) !== false) {
								 	   array_push($stack, $value);
								}
		    	}

			return $stack;	    
	}

	public function display_supplier()
	{
		$text_input = Input::get('in');

		return $text_input;
	}

	public function search_item()
	{
		    $text_input = Input::get('in');

		    $items = DB::table('inventory_items')->lists('part_descriptions');
		    
		    $stack = array();
		    	foreach ($items as $value )
		    	{
		    		//if (stristr($value,'a') === true){
		    		//	return $value;
		    		//}
		    		if (strpos($value,$text_input) !== false) {
								 	   array_push($stack, $value);
								}
		    	}

			return $stack;	    
	}

		public function search_location()
	{
		    $text_input = Input::get('in');

		    $locations = DB::table('locations')->lists('location_name');
		    
		    $stack = array();
		    	foreach ($locations as $value )
		    	{
		    		//if (stristr($value,'a') === true){
		    		//	return $value;
		    		//}
		    		if (strpos($value,$text_input) !== false) {
								 	   array_push($stack, $value);
								}
		    	}

			return $stack;	    
	}

	public function add_order()
	{	
		//return 
		$sup_item =  Input::get('in');
		$cmnt =  Input::get('cmnt');
		if($cmnt == NULL)
		{
			$cmnt = 'no comments';
		}
		$user = Input::get('usr');
		$location = Input::get('location');
		$supp = NULL;
		$i=0; 	

		if($sup_item == ","  || $location == NULL || $user == NULL) 
		{
			return "Fill Mandatory fields *"; 
		}
		while($sup_item[$i] != ",")
		{
			$supp = $supp.$sup_item[$i];
			$i++;
		}	
		$purchase = new Purchase;
		$purchase->supplier = $supp;
		$purchase->user = $user;
		$purchase->location = $location;
		$purchase->order_date = date("d/m/y  h:i:sa");
		$purchase->comments = $cmnt;
		$purchase->save();

		//$order_id = SELECT max(id) FROM purchase_orders;
		$order_id = DB::table('purchase_orders')->where('id', DB::raw("(select max(`id`) from purchase_orders)"))->get();
		$x = json_encode($order_id);
		$z = 0;
		$y = NULL;
		for($i=0 ; $i<strlen($x); $i++)
		{
			if($x[$i] == '"')
				{
					$z += 1;
				}
			if($z == 3)
			{
				while($x[$i + 1] != '"' )
				{
					$y = $y.$x[$i + 1];
					$i += 1;
				}
			}


		}
		
			$flag = 2;
			$count = 0;
			$items = 0;

		for($i=0 ; $i<strlen($sup_item); $i++)
		{	if($flag == 2)
			{	
				$order = new Orderitem;
				//return $order;
				$order->purchase_order_id = $y;
				$flag = 0;
			}

			$name = NULL;
			if ($sup_item[$i] == ",")
			{	$count++;
				$j = $i + 1;
				while($sup_item[$j] != "{")
				{
				$name = $name.$sup_item[$j];
				$j++;
				}
				//return $name;
				$order->item = $name;
				$flag++;
				//return $order->item;
			}
			
			if($sup_item[$i] == "{")
			{
				$j = $i + 1;
				$qty = NULL;
				while($sup_item[$j] != "}")
				{
						$qty = $qty.$sup_item[$j];
						$j++;
				}
				$order->quantity = $qty;
				//$order->supplier = $supp;
				$flag++;
				//return $flag;
			}

			if($flag==2 && $order->save())
					{$items++;
						//return "asdd";
					}
			if($flag==2 && !$order->save())
			{
				return "not saved";
			}
			//return "ohyeah";


			if($i == strlen($sup_item) - 1)
			{
				return "SAVED";
			}
			
			

		}
		  

		return $text_input;		
	}
}
