<!DOCTYPE html>
    <html lang="en">

        <body>

            <p><?php echo $model->header->aVariable ?></p>

            <?php $this->includeTemplate($model, 'navigation');

            if (isset($this->request->session['flashMessage'])) {
                echo '<p>'. $this->request->session['flashMessage'] .'</p>';
                unset($this->request->session['flashMessage']);
                $this->request->setSession();
            }