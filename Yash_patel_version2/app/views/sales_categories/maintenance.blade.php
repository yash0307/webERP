@extends('layouts.main')
@section('content')
@extends('includes/sidebar')

<style>
table, th, td {
   border: 1px solid black;
} 
td {
    text-align: middle;
}
td {
    padding: 15px;
}
.Table{
	overflow:scroll;
    height:500px;
}
</style>



<section class="">
	<section class = "wrapper">
	@include("errors.global_alert_messages")
	<div class = "row" >
	<div class = "col-lg-12">
	<section class="panel">
		<header class="panel-heading">
		SALES CATEGORIES MAINTENANCE
		</header>
		<div class="panel-body">
			{{Form::open(array('url'=>'category_saved',"class" => "form-horizontal bucket-form"))}}
			<div class="form-group">
				<label class="col-sm-3 control-label">Sub Category</label>
				<div class="col-sm-4">
				{{Form::text('sub_category')}}
				{{ $errors->first('sub_category') }}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Display in webSHOP?:</label>
				<div class="col-sm-4">
				{{Form::select('active',array('Yes'=>'Yes','No'=>'No'))}}
				
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
	<?php 
$categories = DB::table('sales_category_maintenance')->get();
?>
<div align='center' class='Table'>
	<table>
		<th>Sub Category</th>
		<th>Active?</th>
	@foreach ($categories as $category)
	<tr> 
		<td>{{ $category->sub_category }}</td>
		<td>{{ $category->active }}</td>
		<td>{{ $category->select }}</td>
		<td>{{ HTML::linkRoute('edit_categories','Edit',array($category->id)) }}</td>
		<td>{{ HTML::linkRoute('delete_categories','Delete',array($category->id)) }}</td>
		@if ($category->image != 'no image')
		<td><img class="img-responsive" width='50px' height='50px' src="/assets/images/{{ $category->image }}" ></td>

		@else
		<td>{{$category->image }}</td>
		@endif

	</tr>
	@endforeach
	</table>
</div>


	</section>
</section>
@stop
