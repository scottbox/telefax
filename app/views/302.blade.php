@extends('layout')

@section('title', 'Football Story')

@section('content')

<?php
	$i = 1;
	$page = 303;
?>
@foreach ($feed->get_items() as $item)
	@if($i < 10)
		<p>{{ $item->get_title() }} - {{ $page }}</p>
		{{ Form::hidden('url', $item->get_permalink()) }}
		<?php $i++; $page++ ?>
	@endif
@endforeach
<p>Football news in brief - 312</p>

@stop