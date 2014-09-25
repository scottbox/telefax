<!doctype html>
<html lang="en">
<head>
<title>Ceefax</title>

<style type="text/css">
</style>

</head>

<body>

<?php
	$i = 9;
	$page = 303;
?>
@foreach ($feed->get_items() as $item)
	@if($i < 10)
		<pre>{{ $item->get_title() }} - {{ $page }}</pre>
		<div class="story"></div>
		<?php $i++; $page++ ?>
	@endif
@endforeach
<pre>Football news in brief - 312</pre>

@foreach($article as $a)
	<?php
		$a = trim($a);
		if(!strpos($a, '$render')){
			echo '<p>' . $a . '</p>';
		}
	?>
@endforeach

</body>
</html>