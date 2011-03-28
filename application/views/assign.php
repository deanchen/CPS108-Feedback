<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Assign</title>
	<style>
		label {
			display: block;
		}
		
		#due_date, #template, #target, #title {
			float: left;
			margin-right: 10px;
		}
	</style>
</head>
<body>
<?=form_open('admin/assign')?>
	<div id='template'>
	<?foreach ($templates as $name=>$template):?>
	<?=form_label($name, 'template')?>
	<?=form_radio('template', $name, FALSE);?>
	<?endforeach;?>
	</div>
	
	<div id='target'>
	<?=form_label('student')?>
	<?=form_radio('target', 'student', FALSE);?>
	<?=form_label('ta')?>
	<?=form_radio('target', 'ta', FALSE);?>
	</div>
	<div id='title'>
		<?=form_label('Form name');?>
		<?=form_input('name');?>
	</div>
	<div id='due_date'>
	  <?=form_label('Due date');?>
	  <?=form_input('due_date')?>
	</div>
	<?=form_submit('submit','Assign')?>
<?=form_close() ?>

</body>
</html>
