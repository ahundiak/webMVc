<?php
namespace SkooppaOS\webMVc;
/*
 * View class for creating an output
 *
 */


class View {

	private $template;
        public $headers;


	public function __construct(Request $request)
        {
            $this->template = $request->object . ".html.php";
	}

	public function render($model)
	{
            $headers = [];
            ob_start();
            require_once __DIR__.'/templates/'.$this->template;

            return  ob_get_clean();
	}
}

