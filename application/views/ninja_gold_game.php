<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ninja Gold Game</title>
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<h3>Your Gold:</h3>
<div id="gold"> 
<?= $this->session->userdata['total_gold'] ?>
</div>
<table>
    <tr>
        <td>
        	<div class='money'>
        		<p>Farm</p>
        		<p>(earns 10-20 golds)</p>
        		<form action='<?= base_url('process_money') ?>' method='post'>
	        		<input type="hidden" name="building" value='farm' />
	        		<input type="submit" class ="find_gold_button" value="Find Gold!"/>
        		</form>
        	</div>
        </td>

        <td>
        	<div class='money'>
        		<p>Cave</p>
        		<p>(earns 5-10)</p>
        		<form action='/process_money' method='post'>
        			<input type="hidden" name="building" value='cave' />
	        		<input type="submit" class ="find_gold_button" value="Find Gold!"/>
        		</form>
        	</div>
        </td>
        <td>
        	<div class='money'>
        		<p>House</p>
        		<p>(earns 2-5 golds)</p>
        		<form action='/process_money' method='post'>
	        		<input type="hidden" name="building" value='house' />
	        		<input type="submit" class ="find_gold_button" value="Find Gold!"/>
        		</form>
        	</div>
        </td>
        <td>
        	<div class='money'>
        		<p>Casino</p>
        		<p>(earns/takes 0-50 golds)</p>
        		<form action='/process_money' method='post'>
	        		<input type="hidden" name="building" value='casino' />
	        		<input type="submit" class ="find_gold_button" value="Find Gold!"/>
        		</form>
        	</div>
        </td>
    </tr>
</table>
<p class='act'>Activities:</p>
<div id='activity'>
<?php
	$activities = array_reverse($this->session->userdata['activity']);
	foreach($activities as $activity)
	{  ?>
		<p><?= $activity ?></p>
<?php
	}
?>
</div>
<table>
	<tr>
		<td colspan="4">
			<form action="/ninjagoldgame/restart">
				<input type='submit' value='Restart'>
			</form>
		</td>
	</tr>
</table>
</body>
</html>