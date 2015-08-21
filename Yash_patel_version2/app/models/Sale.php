<?php

class Sale extends Eloquent
{
	protected $fillable = array(
			'select_customer',
			'select_item',
			'delivery_address'
	);
	public $table = 'sales_items';
}
