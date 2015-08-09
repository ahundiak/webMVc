<?php
namespace models\blog;

/**
 *  Our Blog Model
 */

use SkooppaOS\webMVc\Model;
use SkooppaOS\webMVc\Request;
use SkooppaOS\webMVc\Database;

class Blog extends Model
{
    public  $request;
    private $showAction;
    public  $db;
    public  $blogList;
    public  $installed;
    public  $error;
    public  $blog;

    /**
     * Our constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->db = new Database();
        $this->setAction();
    }

    /**
     * This is what the "actions" in controllers in most frameworks do.
     * We can argue about it being at the blog model level and it being a different concern.
     * This control logic should probably be removed and could be made to follow a convention for sure!
     */
    private function setAction()
    {
        switch($this->request->parameters['slug']) {
            case 'createBlog':
                $this->showAction = 'create';
                break;
            case 'updateBlog':
                $this->showAction = 'update';
                break;
            case 'deleteBlog':
                $this->showAction = 'delete';
                break;
            default:
                if($this->requestHasProperSlug()) {
                    $this->showAction = 'blog';
                    break;
                }
                $this->showAction = 'list';

        }
    }

    /**
     * This returns the action we are doing for read activity.
     * @return mixed
     */
    public function showAction()
    {
        return $this->showAction;
    }

    /**
     * Returns an array of blog posts or sets an error message.
     * @return mixed
     */
    public function getBlogList()
    {

        $sql = "SELECT * FROM blog";

        $this->db->query($sql);

        if ($this->db->execute()) {
           $this->blogList = $this->db->resultset();
            if (! empty($this->blogList)) {
               return $this->blogList;
            }
        }

        $this->error = 'Sorry no blog posts to show.';

    }

    /**
     * Returns a single blog post or sets an error message.
     * @return mixed
     */
    public function getBlog()
    {
        $sql = "SELECT * FROM blog WHERE Id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $this->request->parameters['id']);

        if ($this->db->execute()) {
            $this->blog = $this->db->single();
            if ( ! empty($this->blog)) {
                return $this->blog;
            }
        }

        $this->error = 'Sorry, but you didn\'t specify a proper blog to show.';

    }

    /**
     * Returns the current blog post Id.
     * @return mixed
     */
    public function getBlogID()
    {
        if(isset($this->blog)) {
            return $this->blog['Id'];
        }
    }

    /**
     * This returns the slug parameter.
     * @return mixed
     */
    public function getSlug()
    {
        return $this->request->parameters['slug'];
    }

    /**
     * This builds the slug.
     * @param $string
     * @return mixed
     */
    public function buildSlug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }


    /**
     * This checks to make sure the slug is a proper slug.
     * @return bool
     */
    public function requestHasProperSlug()
    {
        if ($this->request->parameters['slug'] !== 'createBlog'
            && $this->request->parameters['slug'] !== 'updateBlog'
            && $this->request->parameters['slug'] !== 'deleteBlog'
            && $this->request->parameters['id'] !== '') {

            return true;
        }

        return false;
    }

    /**
     * Check to see if the slug has a value.
     * @return bool
     */
    public function slugIsNotEmpty()
    {
        return $this->request->parameters['slug'] !== '';
    }

}