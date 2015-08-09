<?php

$this->includeTemplate($model, 'header');


echo '<p>'. $model->{$this->request->getObject()}->error .'</p>';

if ( $model->{$this->request->getObject()}->showAction() === 'list') {

    $this->includeSubtemplate($model, 'blog', 'blogList');

    echo '<p>'. $model->blog->error .'</p>';

}

if ( $model->{$this->request->getObject()}->showAction() === 'blog') {

    $this->includeSubtemplate($model, 'blog', 'blogShow');

}

$this->includeTemplate($model, 'footer');

