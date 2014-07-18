<?php
App::uses('JsonReader', 'TinyAdmin.Configure');
Configure::config('json', new JsonReader());
if (file_exists(App::pluginPath('TinyAdmin') . 'Config' . DS . 'tinyadmin.json')) {
	Configure::load('tinyadmin', 'json');
}
if (file_exists(APP . 'Config' . DS . 'tinyadmin.json')) {
	Configure::load('tinyadmin', 'json');
}
debug(Configure::read());die;
