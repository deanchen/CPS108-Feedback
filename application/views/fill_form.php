<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fill Form</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>
	
<?=form_open('feedback/submit_form/' . $id)?>
	<?foreach ($form as $name=>$element):?>
		<?=form_label($element['label'], $name)?>
		<?$element['attributes']['name'] = $name ?>
		<?php if (!isset($element['value'])) $element['value'] = ""; 
		?>
		<?=$element['type']($element['attributes'], $element['value'])?>
	<?endforeach?>
	<br />
	<?=form_submit('submit','Submit')?>
<?=form_close() ?>

</body>
</html>