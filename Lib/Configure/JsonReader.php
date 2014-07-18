<?php

App::uses('Json', 'TinyAdmin.Lib');

class JsonReader implements ConfigReaderInterface {

	protected $_path = null;

	public function __construct($path = null) {
		if (!$path) {
			$path = APP . 'Config' . DS;
		}
		$this->_path = $path;
	}

	public function read($key) {
		if (strpos($key, '..') !== false) {
			throw new ConfigureException(__d('tinyadmin', 'Cannot load configuration files with ../ in them.'));
		}
		if (substr($key, -5) === '.json') {
			$key = substr($key, 0, -5);
		}
		list($plugin, $key) = pluginSplit($key);

		if ($plugin) {
			$file = App::pluginPath($plugin) . 'Config' . DS . $key;
		} else {
			$file = $this->_path . $key;
		}
		$file .= '.json';
		if (!is_file($file)) {
			if (!is_file(substr($file, 0, -4))) {
				throw new ConfigureException(__d('tinyadmin', 'Could not load configuration files: %s or %s', $file, substr($file, 0, -4)));
			}
		}
		debug(file_get_contents($file));
		$config = json_decode(file_get_contents($file), true);
		debug($config);die;
		return $config;
	}
}
