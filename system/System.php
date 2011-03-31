<?php
namespace glenn;
ob_start(); // TEMP TO ALLOW DEBUG

define('BASE_PATH', realpath('../') . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);
define('EXTRAS_PATH', BASE_PATH . 'extras' . DIRECTORY_SEPARATOR);
define('SYSTEM_PATH', BASE_PATH . 'system' . DIRECTORY_SEPARATOR);

require SYSTEM_PATH . 'classes/loader/Loader.php';

use glenn\config\Config,
 glenn\controller\FrontController,
 glenn\http\Request,
 glenn\loader\Loader,
 glenn\error\ErrorHandler,
 glenn\router\RouterTree,
 glenn\router\datastructures\TreeArray,
 glenn\router\datastructures\ClosureTree;

class System {

	private $config;

	public function __construct() {
		$this->loadUserConfig();
		$this->loadModules();
	}

	public function execute() {
		// Dispatch request
		echo "<p>Handing over to dispatcher</p>";
		$dispatcher = $this->config->getDispatcher();
		$response = $dispatcher->dispatch($this->getRequest());

		return $response;
	}

	private function loadUserConfig() {
		echo '<p>Reading user configuration</p>';
		$config = new \app\Bootstrap();
		$this->config = $config;
	}

	private function loadModules() {
		$modules = $this->config->getModules();
		foreach ($modules as $module) {
			echo '<p>Load module: ' . $module . '</p>';
		}
	}

	private function getRequest() {
		return new Request($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
	}

}

// Init some low level stuff
echo '<p>Register classloader</p>';

Loader::registerAutoloader();
Loader::registerModules(array(
			'app' => APP_PATH,
			'glenn' => SYSTEM_PATH
		));
require APP_PATH . 'Bootstrap.php';

// Jump into the OO world! If we do not use static and some kind of registery
// for global access instead of singleton we should be able to run several
// execuations completly isolated.
$app = new System();
$response = $app->execute();
$response->send();

ob_end_flush(); // TEMP TO ALLOW DEBUG