<?php 
	$name = "";
	if (!isset($given_name)) {
		$name = $netid;
	} else {
		$name = $given_name;	
	}
	function displayList($elements, $pending = TRUE, $write = FALSE) {
		$output = "";
		$hasElements = false;
		foreach ($elements as $element) {
			if (
			($pending and (!isset($element->data) or $element->data == ''))
			or (!$pending and (isset($element->data) and $element->data != ''))) {
				$hasElements = true;	
				if ($write) {
					$form_url = "fill_form";	
				} else {
					$form_url = "read_form";	
				}
				
				if ($pending and !$write) {
					$output .= "<p>" . $element->name . "</p>";	
				} else {
					$output .= "<p><a href='feedback/$form_url/" . $element->id . "'>" . $element->name . "</a></p>";
				}
				if ($pending) {
					$due_date = explode("-", $element->date_due);
					if (!$write) {
						$by = " by " . $element->origin;
					} else {
						$by = "";	
					}
					$output .= "<p class='due-date'>due on " . $due_date[1] . '-' . $due_date[2] . "$by</p>";
				}
			}
		}
		
		if ($hasElements) {
			if ($pending) {
				$title = "Pending";	
			} else {
				$title = "Completed";	
			}
			$output = "<h3>$title</h3>" . $output;
		}
		print $output;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Overview</title>
	
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css">
	<link rel="stylesheet" type="text/css" href='css/styles.css'></link>

</head>
<body>
	<div class="content rounded-box clearfix" style="width: 500px">
	<div style="text-align: right; font-size: 0.8em; margin-right: -1em;"><a href="https://github.com/deanchen/CPS108-Feedback/blob/master/license.txt">Dean Chen &copy; 2011</a></div>
	<?if (!isset($given_name)) $given_name = ''; ?>
	<?="<h3 style='text-align: center; margin-bottom: 1em; margin-top: 0px'>$given_name ($netid)</h2>"?>
	<div class="overview">
		<div id="feedbacks">
			<h2>Submissions</h2>
			
			<?displayList($assignments, TRUE, TRUE);?>
			
			<?displayList($assignments, FALSE);?>
			
		</div>
		<div id="assignments">
			<h2>Feedbacks</h2>
			
			<?displayList($feedbacks, TRUE);?>
			
			<?displayList($feedbacks, FALSE);?>
		</div>
	</div>
	<div style="clear: both"></div>
	
	</div>
	
</body>
</html>