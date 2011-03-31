<?php

namespace glenn\defaults;

/**
 * Description of Bootstrap
 *
 * @author peter
 */
abstract class Bootstrap {

	private $router = null;
	private $dispatcher = null;
	private $modules = array();

	function __construct() {

	}

	public function addModule($module) {
		$this->modules[] = $module;
	}

	public final function getRouter() {
		if ($this->router == null) {
			$this->router = new \glenn\router\RouterTree();
		}

		return $this->router;
	}

	/**
	 * Return a dispatcher
	 * @return Dispatcher A dispacher
	 */
	public final function getDispatcher() {
		if ($this->dispatcher == null) {
			$this->dispatcher = new \glenn\controller\FrontController($this->getRouter());
		}

		return $this->dispatcher;
	}

	public function getModules() {
		return $this->modules;
	}

	public final function replaceRouter(\glenn\router\Router $router) {
		$this->router = $router;
	}

	public final function replaceDispatcher(\glenn\controller\Dispatcher $dispatcher) {
		$this->dispatcher = $dispatcher;
	}

}
?>
