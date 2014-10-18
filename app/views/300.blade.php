@extends('layout')

@section('title', 'Index')

@section('content')

<?php
	$i = 1;
?>
@foreach ($feed->get_items() as $item)
	@if($i === 1)
		Top Sport
		<p>{{ $item->get_title() }}</p>
		<p>{{ $item->get_description() }}</p>
		<p>{{ $item->get_link() }}</p>
		<p>{{ $item->get_category() }}</p>
		<?php $i++; ?>
	@endif
@endforeach

@stop