<?php
$url = '/tinyadmin';
if (Configure::read('TinyAdmin.loginURL')) {
	$url = Configure::read('TinyAdmin.loginURL');
}
Router::connect(
	$url,
    array('plugin' => 'tiny_admin', 'controller' => 'auth', 'action' => 'login')
);

Router::connect(
	sprintf('%s/:controller/:action/*', $url),
    array('plugin' => 'tiny_admin')
);
