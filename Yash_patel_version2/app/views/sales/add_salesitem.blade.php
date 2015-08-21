@extends('layouts.main')
@section('content')
@extends('includes/sidebar')
<section class="">
	<section class = "wrapper">
	@include("errors.global_alert_messages")
	<div class = "row" >
	<div class = "col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			ADD SALEITEM
		</header>
		<div class="panel-body">
			{{Form::open(array('url'=>'saleitemadded',"class" => "form-horizontal bucket-form"))}}
			
			<div class="form-group">
				<label class="col-sm-3 control-label">Select Customer</label>
				<div class="col-sm-4">
				  <?php 
					$categories = DB::table('users')->get();
					
				?>
				<?php
    				$category_selector = array();
    				//echo json_encode($categories1);
    				foreach($categories as $category)
    				{
      					$category_selector[$category->username] = $category->username;
    				}
    				 
  				?>
  				{{Form::select('usr',$category_selector)}}
 
 
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Select Item</label>
				<div class="col-sm-4">
				
				<?php 
					$categories1 = DB::table('inventory_items')->get();
					?>
				<?php
    				$category_selector = array();
    				
    				//echo json_encode($categories1);
    				foreach($categories1 as $category)
    				{
    				 
      					$category_selector[$category->item_code] = $category->item_code;
    				}
  				?>
  				{{Form::select('usr1',$category_selector)}}
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label">Delivery Address</label>
				<div class="col-sm-4">
				{{Form::text('delivery_address')}}
				{{ $errors->first('delivery_address') }}
				</div>
			</div>
			
			<div class="pull-right">
				{{link_to('system','Cancel',array("class"=>"btn btn-danger"))}}
			{{Form::submit('Update',array("class"=>"btn btn-success"))}}
			</div>
			{{Form::close()}}
		</div>
	</section>
	</div>
	</div>
	</section>
</section>
@stop
