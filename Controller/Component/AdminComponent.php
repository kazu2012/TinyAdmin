<?php

class AdminComponent extends Component {

	public $components = array(
		'Session'
	);

	public function beforeRender(Controller $controller) {
		// load helpers
		$controller->helpers[] = 'TinyAdmin.Parser';
		if ($this->Session->check('Auth.User.id')) {
			$controller->helpers[] = 'TinyAdmin.Admin';
		}
	}
}
