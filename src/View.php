<?php
namespace SkooppaOS\webMVc;

/*
 * View class for  creating an output
 *
 */


class View
{
    public  $headers;
	private $template;
    private $templateDirectory;
    private $request;
    private $newObject;
    public  $model;


    /**
     * Our constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
            $this->request = $request;
            $this->setNames($this->request->getObject());
            $this->newObject = $this->request->getObject();
	}

    /**
     * This sets up the names needed to get the proper classes,
     * determined by the required object.
     * @param $object
     * @param null $templateName
     */
    private function setNames($object, $templateName = null)
    {
        $this->templateDirectory = $object;
        if($templateName === null) {
            $this->template = $object.".html.php";
        } else {
            $this->template = $templateName.".html.php";
        }
    }

    /**
     * A method to call templates in the view.
     * @param Model $model
     * @param string $object
     */
    public function includeTemplate(Model $model, $object = '')
    {
        $this->newObject = $object;
        $this->setNames($this->newObject);
        $this->getTemplate($model);
    }

    /**
     * This method gets the called template.
     * @param Model $model
     */
    public function getTemplate(Model $model)
    {
        if ($this->request->getObject() !== $this->newObject) {
            $model->buildSecondaryClientModel($this->newObject);
        }
        $this->loadTemplate($model);
    }

    /**
     * This method allows us to get supplemental templates in the view.
     * @param Model $model
     * @param $object
     * @param $subtemplateName
     */
    public function includeSubtemplate(Model $model, $object, $subtemplateName)
    {
        $this->setNames($object, $subtemplateName);
        $this->loadTemplate($model);
    }

    /**
     * This method will get the template file.
     * @param Model $model
     */
    private function loadTemplate(Model $model)
    {
        if (file_exists(__DIR__.'/templates/'.$this->templateDirectory.'/'.$this->template)) {
            require_once __DIR__ . '/templates/' . $this->templateDirectory . '/' . $this->template;
        }
    }


    /**
     * This method generates the final output of the view.
     * @param Model $model
     * @return string
     */
    public function render(Model $model)
    {
        $this->headers = array();
        ob_start();

        $this->getTemplate($model);

        return  ob_get_clean();
    }
}

