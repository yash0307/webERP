<?php

class Purchase extends Eloquent
{
	public  $timestamps = false;
	protected $fillable = array(
			'user',
			'order_date',
			'supplier',
			'location',
			//'qty'
			
			);
	public $table = 'purchase_orders';
}