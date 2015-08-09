<?php $this->includeTemplate($model, 'header');


echo '<p>'. $model->{$this->request->getObject()}->error .'</p>';

if($model->blogAdmin->showAction() === 'create') {
    echo '<p> Add a blog article!</p>
          <form action="'. $model->request->path .'" method="post" />
               <input type="hidden" name="method" value="create"/>
               <p>
                <label>Titel:
                 <input type="text" name="Title" value="" size="45" maxlength="100" required="required">
                </label>
               </p>
               <p>
                <label>Article: <br>
                 <textarea rows="10" cols="80" name="Content" required="required"></textarea>
                </label>
               </p>
                <input type="submit" value="Submit">
          </form>';


}

if($model->blogAdmin->showAction() === 'update') {
    extract($model->blogAdmin->getBlog());
    echo '<p> Update a blog article!</p>
          <form action="'. $model->request->path .'" method="post">
               <input type="hidden" name="Id" value="'. $Id .'">
               <input type="hidden" name="method" value="update">

               <p>
                <label>Titel:
                 <input type="text" name="Title" value="'. $Title .'" size="45" maxlength="100" required="required">
                </label>
               </p>
               <p>
                <label>Article: <br>
                 <textarea rows="10" cols="80" name="Content" required="required">'. $Content .'</textarea>
                </label>
               </p>
                <input type="submit" value="Submit">
          </form>';


}

if($model->blogAdmin->showAction() === 'list') {

    $this->includeSubtemplate($model, 'blog', 'blogList');

    echo '<p>'. $model->blogAdmin->error .'</p>

    <form action="'. $model->request->path .'/createBlog" method="post">
        <input type="hidden" name="method" value="read">
         <button onclick="submit()">New Blog</button>
    </form>';

}

if($model->{$this->request->getObject()}->showAction() === 'blog') {

    echo '<script language="javascript">
              function confirm_delete() {
                  var return_value = confirm(\'Are you sure you want to delete this post!\');
                  if (return_value === true) {
                      document.getElementById(\'deleteBlog\').submit();
                  }
              }
          </script>';

    $this->includeSubtemplate($model, 'blog', 'blogShow');

    echo '<form style="display: inline" action="/'. $model->request->getObject() .'/updateBlog/'. $model->{$this->request->getObject()}->getBlogId() . '" method="post">
            <input type="hidden" name="method" value="read">
            <button onclick="submit()">Edit</button>
          </form>';

    echo '<form style="display: inline"/'. $model->request->getObject() .'/deleteBlog" method="post" id="deleteBlog">
             <input type="hidden" name="method" value="delete">
             <input type="hidden" name="Id" value="'. $model->{$this->request->getObject()}->getBlogId() .'">
             <a href="javascript:{}" onclick="confirm_delete()">Delete</a>
         </form></div></p>';
}


$this->includeTemplate($model, 'footer');


