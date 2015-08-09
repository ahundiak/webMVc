<?php
/**
 * The template to output a single blog
 */

extract($model->{$this->request->getObject()}->getBlog());
$date = date('l jS \of F Y h:i A', $CreationDate);
$Content = nl2br($Content);
echo '<p><b>'. $Title .'</b></p>';
echo '<p><b><small>Created on: '. $date .'</small></b></p>';
echo '<div style="width: 600px;"><p>'. $Content .'</p></div>';
