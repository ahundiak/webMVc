<?php
/**
 * The navigation template
 */
?>
<p>
    <div> Navigation: <a href="/">Index</a> |
                   <a href="/clock">Clock</a> |
                   <a href="/clock/ntp/date-only">NTP Clock just Date Format</a> |
                   <a href="/blog">Blog</a> |
                   <a href="/blogAdmin">Blog Admin</a>
                   <?php if(isset($model->request->session['loggedIn']) && $model->request->session['loggedIn'] === true) {?>
                       <form style="display: inline;" action="/login" method="post" id="logout">
                           <input type="hidden" name="method" value="delete">
                           <input type="hidden" name="redirectObject" value="<?php echo $model->request->getRedirectObject(); ?>">
                           | <a href="#" onclick="document.getElementById('logout').submit();">Logout</a>
                       </form>
                   <?php }
                   ?>
    </div>
</p>

