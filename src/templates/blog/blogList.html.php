<?php
/**
 * A template to list just the blogs
 */

echo '<p><div><p><b>Blogs:</b></p>';
echo '<script language="javascript">
          function confirm_delete() {
              var return_value = confirm(\'Are you sure you want to delete this post!\');
              if (return_value === true) {
                  document.getElementById(\'deleteBlog\').submit();
              }
          }
      </script>';

$blogList = $model->{$this->request->getObject()}->getBlogList();

if (! empty($blogList)) {
    foreach ($blogList as $blog) {
        extract($blog);
        $date = date('l jS \of F Y h:i A', $CreationDate);
        $excerpt = substr($Content, 0, 20).'...';
        echo '<div style="line-height: 1.5em"><small>' . $date . ' |
              <a href="/'. $this->request->getObject() .'/'. $Slug .'/'. $Id . '">'. $Title . '</a> | '
            . $excerpt . ' | ';
        if ($this->request->session['loggedIn'] === true){
            echo '<a href="/blogAdmin/updateBlog/' . $Id . '">Edit</a>'

                 . '<form style="display: inline;" action="/blogAdmin/deleteBlog" method="post" id="deleteBlog">
                           <input type="hidden" name="method" value="delete">
                           <input type="hidden" name="Id" value="'. $Id .'">
                           <input type="hidden" name="redirectObject" value="'. $model->request->getRedirectObject() .'">
                           | <a href="javascript:{}" onclick="confirm_delete()">Delete</a>
                       </form>';
        }
        echo '</small></div>';
    }
}
echo '</div></p>';