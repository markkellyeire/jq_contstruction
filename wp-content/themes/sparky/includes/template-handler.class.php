<?php
/*
|--------------------------------------------------------------------------
| Plates PHP - setup templates
|--------------------------------------------------------------------------
| 
| In this file we will load the correct Plates PHP template instead of
| using the default WordPress templating.
| 
*/

class TemplateHandler
{
	public $engine;
	public $template;
	
	private $template_extension = 'php';
	
	public function __construct()
	{
		define( 'DIR_PLATES'    , DIR_INCLUDES . 'Plates/' );
		define( 'DIR_EXTENSION' , DIR_PLATES . 'Extension/' );
		define( 'DIR_VIEWS'     , TEMPLATEPATH );
		
		// Initialise and create the instances we need.
		$this->load_requirements();
		$this->create_engine();
		$this->create_template();
	}
	
	/**
	 * Load the correct template file based on what's currently
	 * being viewed.
	 *
	 * @return void
	 */
	public function render_template( $template )
	{
		echo $this->template->render( array_get( pathinfo($template) , 'filename') );
		exit;
	}
	
	/**
	 * Loads all the required files for the Plates library.
	 *
	 * @return void
	 */
	private function load_requirements()
	{
		$plates_required_files = [
			DIR_PLATES . 'Engine.php',
			DIR_PLATES . 'Template.php',
			DIR_EXTENSION . 'ExtensionInterface.php',
			// DIR_EXTENSION . 'Asset.php',
			DIR_EXTENSION . 'Batch.php',
			DIR_EXTENSION . 'Escape.php',
			// DIR_EXTENSION . 'URI.php',
		];

		foreach( $plates_required_files as $file )
		{
			require_once $file;
		}
	}
	
	/**
	 * Creates an instance of the Plates Engine and defines
	 * the templates directory.
	 *
	 * @return void
	 */
	private function create_engine()
	{
		if ( !$this->engine )
		{
			$this->engine = new \League\Plates\Engine( DIR_VIEWS , $this->template_extension );
		}
	}
	
	/**
	 * Creates an instance of a Plate template.
	 *
	 * @return void
	 */
	private function create_template()
	{
		if ( !$this->template )
		{
			$this->template = new \League\Plates\Template( $this->engine );
		}
	}
	
}



/**
 * Override the part where WordPress loads a template and let the Template Handler
 * class render a Plate template instead of the defautl WordPress template.
 *
 * @param  string $template
 *
 * @return void
 */
function use_plates_template( $template )
{
	$handler = new TemplateHandler();
	
	// Add the partials and templates folders to easily load the files in them.
	$handler->engine->addFolder( 'partials' , TEMPLATEPATH . '/_partials' );
	$handler->engine->addFolder( 'templates' , TEMPLATEPATH . '/_templates' );
	
	// Finally - render the correct template.
	$handler->render_template( $template );
}

add_action( 'template_include' , 'use_plates_template' );