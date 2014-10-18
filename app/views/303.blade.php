@extends('layout')

@section('title', 'Football Story')

@section('content')

<?php
	$i = 1;
	$page = 303;
?>
@foreach ($feed->get_items() as $item)
	@if($i < 2)
		<h1>{{ $item->get_title() }}</h1>
		<?php $i++; $page++ ?>
	@endif
@endforeach

{{ $article['content'] }}

@stop