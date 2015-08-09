<?php
namespace models\blogAdmin;

/**
 * Class for removing blog records
 */

use SkooppaOS\webMVc\Model as Model;
use SkooppaOS\webMVc\Request as Request;

class DeleteBlogAdmin extends BlogAdmin
{
    public  $model;
    public  $request;
    public  $db;

    /**
     * Our constructor.
     * @param Request $request
     * @param Model $model
     */
    public function __construct(Request $request, Model $model)
    {
        $this->model = $model->blogAdmin;
        $this->request = $request;
        $this->db = $this->model->db;
        $this->deleteBlog();
    }

    /**
     * Function to delete a blog post or set an error.
     * It also sets up a redirect on success.
     */
    public function deleteBlog()
    {
        $sql =  'DELETE FROM Blog
                 WHERE Id = :id';

        $integerId = intval($this->request->postData['Id']);
        $this->db->query($sql);
        $this->db->bind(':id', $integerId);

        if ($this->db->execute()) {
            $this->request->session['flashMessage'] = 'The blog post was deleted!';
            $this->request->setObject('blogAdmin');
            $this->request->refreshPage();
        } else {

            $this->model->error = 'Oops, we have a problem Houston!';
        }
    }
}