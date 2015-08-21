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
    height:300px;
}
</style>



<section class="">
	<section class = "wrapper">
<h1 align='center'>edit category {{ $category->sub_category }}</h1>

	<?php 
$categories = DB::table('sales_category_maintenance')->get();
?>
<div align='center' class='Table'>
	<table>
		<th>Sub Category</th>
		<th>Active?</th>
	@foreach ($categories as $category_1)
	<tr> 
		<td>{{ $category_1->sub_category }}</td>
		<td>{{ $category_1->active }}</td>
		<td>{{ $category_1->select }}</td>
		<td>{{ HTML::linkRoute('edit_categories','Edit',array($category_1->id)) }}</td>
		<td>{{ HTML::linkRoute('delete_categories','Delete',array($category_1->id)) }}</td>
		<td>{{ $category_1->image }}</td>


	</tr>
	@endforeach
	</table>
</div>

<div align='center' class='edit'>

{{Form::open(array('url'=>'category_edit',"class" => "form-horizontal bucket-form",'files'=>true))}}

<p> {{ Form::label('sub_category','Sub Category:') }}
	{{ Form::text('sub_category',$category->sub_category) }}
</p>
<p> {{ Form::label('active','Display in WebSHOP:') }}
	{{ Form::select('active',array('Yes'=>'Yes','No'=>'No')) }}
</p>

<p>

  {{ Form::label('file','Image:',array('id'=>'','class'=>'')) }}
  {{ Form::file('image','',array('id'=>'','class'=>'')) }}
</p>

{{ Form::hidden('id',$category->id) }}
<p> {{ Form::submit('update') }}

	{{ Form::close() }}
</div>
	</section>
</section>
@stop
