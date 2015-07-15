
 <p>See what time it is!</p>

	<form action="/clock" method="post">
        <?php
        foreach ($model->clock->objectParams as $key => $value) { ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php
        }
        ?>
	<label>Select a city</label>
	<select name="timezone" onchange="this.form.submit();">
            <option value="">Pick one!</option>
	    <?php foreach ($model->clock->timezones as $timezone => $city) {
	    ?>
	    <option value="<?php echo $timezone; ?>" <?php echo $model->clock->timezone === $timezone ? 'selected="selected"' : ''; ?>><?php echo $city; ?></option>
	<?php } ?>
	</select>
	</form>

<?php
if ($model->clock->submitted) { ?>

	The time in <em><?php echo $model->clock->getCity(); ?></em> is
        <strong>
        <?php
    if ($model->clock->objectParams['dateFormat'] === 'date-only') {
        echo $model->clock->getTime()->format('Y-m-d');

    }elseif ($model->clock->objectParams['dateFormat'] == 'default') {
        echo $model->clock->getTime()->format('Y-m-d H:i:s');
        ?>
        </strong>
	<?php
    }
}
?>
