<?php $this->includeTemplate($model, 'header');?>

    <form action="<?php echo $model->request->path; ?>" method="post">
        <?php
        foreach ($model->clock->parameters as $key => $value) { ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php
        }
        ?>
    <label>Select a city</label>
    <select name="timezone" onchange="this.form.submit();">
            <?php
            if( ! $model->clock->submitted) { ?>
                <option value="">Pick one!</option>
            <?php
            }
            foreach ($model->clock->timezones as $timezone => $city) {
        ?>
        <option value="<?php echo $timezone; ?>" <?php echo $model->clock->timezone === $timezone ? 'selected="selected"' : ''; ?>><?php echo $city; ?></option>
    <?php } ?>
    </select>
    </form>

<?php
if ($model->clock->submitted) { ?>

    <p>The time in <em><?php echo $model->clock->getCity(); ?></em> is
        <strong>
        <?php
    if ($model->clock->parameters['dateFormat'] === 'date-only') {
        echo $model->clock->getTime()->format('Y-m-d');

    }elseif ($model->clock->parameters['dateFormat'] == 'default') {
        echo $model->clock->getTime()->format('Y-m-d H:i:s');
        ?>
        </strong></p>
    <?php
    }
}
$this->includeTemplate($model, 'footer'); ?>

