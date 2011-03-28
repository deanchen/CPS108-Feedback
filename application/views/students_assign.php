<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Map students</title>
	<style>
		label {
			display: block;
		}
	</style>
</head>
<body>
	
<?php echo form_open_multipart('admin/map_students_to_ta');?>

<input type="file" name="file" size="20" />
<br />
<br />
<input type="submit" value="Upload" />

</form>
</body>
</html>
