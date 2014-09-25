<!doctype html>
<html lang="en">
<head>
<title>Ceefax</title>

<style type="text/css">
</style>

</head>

<body>

<?php
	$i = 1;
?>
@foreach ($feed->get_items() as $item)
	@if($i < 10)
		<pre>{{ $item->get_title() }}</pre>
		<div class="story"></div>
		<?php $i++; ?>
	@endif
@endforeach

</body>
</html>