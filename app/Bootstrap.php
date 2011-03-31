<?php

namespace app;

/**
 * Description of Bootstrap
 *
 * @author peter
 */
class Bootstrap extends \glenn\defaults\Bootstrap {

	function __construct() {

		// Add modules
		$this->addModule('database');
		$this->addModule('auth');
		$this->addModule('orm');

		// Specify routes
		$router = $this->getRouter();
		//$router->addRoutes(...);

			// Or we could create a new router
			//$router = new myRouter();
			//$router->addRoutes(...);
			//$this->setRouter($router);

		
	}

}
?>
