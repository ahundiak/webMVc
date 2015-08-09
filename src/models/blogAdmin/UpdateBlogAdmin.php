<?php
namespace models\blogAdmin;

/**
 * A class for updating the BlogAdmin model.
 *
 */

use SkooppaOS\webMVc\Model as Model;
use SkooppaOS\webMVc\Request as Request;

class UpdateBlogAdmin extends BlogAdmin
{

    public  $model;
    public  $request;
    public  $db;

    /**
     * The constructor
     * @param Request $request
     * @param Model $model
     */
    public function __construct(Request $request, Model $model)
    {
        $this->model = $model->blogAdmin; // not sure if this is kosher.
        $this->request = $request;
        $this->db = $this->model->db;
        $this->updateBlog();
    }

    /**
     * This is the logic to update the blog post.
     */
    private function updateBlog()
    {
        $slug = $this->buildSlug($this->request->postData['Title']);

        $sql =  'UPDATE Blog SET
                     Title = :title,
                     Slug = :slug,
                     Content = :content
                 WHERE Id = :id';

        $integerId = intval($this->request->postData['Id']);
        $this->db->query($sql);

        $this->db->bind(':title', $this->request->postData['Title']);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':content', $this->request->postData['Content']);
        $this->db->bind(':id', $integerId);

        if ($this->db->execute()) {
            $this->request->session['flashMessage'] = 'The blog post was updated!';
            $this->request->setObject('blogAdmin/'.$slug.'/'.$integerId);
            $this->request->refreshPage();
        } else {

            $this->model->error = 'Oops, we have a problem Houston!';
        }
    }
}