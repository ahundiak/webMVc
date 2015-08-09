<?php $this->includeTemplate($model, 'header'); ?>
        <div id="login">
            <div><p><?php echo $model->request->firewall->authentication->errorMessage; ?></p></div>

            <form action="/<?php echo $this->request->getObject(); ?>" method="post" id="login-form">
                <input type="hidden" name="redirectObject" value="<?php echo $this->request->getRedirectObject(); ?>">
                <div>
                    <label for="password">Password:</label>
                    <div >
                        <input type="password" id="password" name="password" required="required" />
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" id="login-btn" name="submit"><span style="padding-right: 5px;">Login</span></button>
                </div>
            </form>

        </div>

<?php $this->includeTemplate($model, 'footer'); ?>
