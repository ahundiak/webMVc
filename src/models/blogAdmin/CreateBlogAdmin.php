<?php
namespace models\blogAdmin;

/**
 * Class for creating blog posts
 *
 */
use models\blog\Blog;
use SkooppaOS\webMVc\Request;
use SkooppaOS\webMVc\Model;


class CreateBlogAdmin extends BlogAdmin
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
        $this->model = $model->blogAdmin;
        $this->request = $request;
        $this->db = $this->model->db;
        $this->createBlog();
    }

    /**
     * This will create our blog post.
     */
    private function createBlog()
    {
        $slug = $this->buildSlug($this->request->postData['Title']);

        $sql =  'INSERT INTO Blog
                 (Title, Slug, Content, CreationDate)
                VALUES (:title, :slug, :content, :creationDate)';

        $this->db->query($sql);

        $this->db->bind(':title', $this->request->postData['Title']);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':content', $this->request->postData['Content']);
        $this->db->bind(':creationDate', time());

        if ($this->db->execute()) {
            $this->request->session['flashMessage'] = 'Your blog was added!';
            $this->request->setObject('blogAdmin/'.$slug.'/'.$this->db->lastInsertId());
            $this->request->refreshPage();
        } else {

            $this->model->error = 'Oops, we have a problem Houston!';
        }

    }

}