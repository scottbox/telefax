@extends('layout')

@section('title', 'Football Story')

@section('content')

<?php
	$i = 1;
?>
@foreach ($feed->get_items() as $item)
	@if($i < 10)
		<?php
			$url = explode('/', $item->get_permalink());
			$category = $url[5];
			$category = str_replace('-', ' ', $category);
			$category = ucwords($category);
			
		?>
		<p>{{ $category }} {{ $item->get_title() }}</p>
		<?php $i++; ?>
	@endif
@endforeach

@stop