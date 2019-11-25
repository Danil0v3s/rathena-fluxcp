<?php if (!defined('FLUX_ROOT')) exit; 
$g = array();
$stellar_settings = array (
	/** to edit the background go to main.css and find body {} around line 1624 **/
	'favicon' => $this->themePath('favi.ico'),
	'logo' => $this->themePath('images/logo.svg'),
	//'title' depends on the SiteTitle at application.php
	'description'=>'Ipsum sed adipiscing',
	'showTitle' => true,
	'showDescription' => true,
	
	/**If you put an entry here it means it'll be shown globally
	and also it would be the first in line **/
	'siteNavi' => array (
		// Format:
		// $this->url('account','login') => 'Login',
		// or
		// "#link" => 'LINK',
		),
);

	/**Front Page Menu**/
	if (in_array($params->get('module'), array('main'))) {
		$g[] = array(
		"#intro" => 'Introduction',
		"#ranking" => 'Ranking',
		"#server" => 'Server Information',
		"#gs" => 'Get Started',
		);
	}
	
	/** If you want items to only show up on certain pages then add more module names after 'main' **/
	/** Uncomment the conditional statement below **/
	/**
	if (in_array($params->get('module'), array('main','item','account'))) {
		$g[] = array(
		"#Item" => 'Item 1',
		);
	}
	**/
	
	/** Account session dependent **/
	if (!$session->isLoggedIn()) {
		$g[] = array(
		$this->url('account','login') => 'Login',
		$this->url('account','create') => 'Register',
		);
	}
	else {
		$g[] = array(
		$this->url('account','view') => 'Account',
		$this->url('account','logout') => 'Logout',
		);
	}
	
	/** In case you want to put items after certain links, put them here **/
	$g[] = array(
		// Format:
		// $this->url('account','login') => 'Login',
		// or
		// "#link" => 'LINK',
		
		$this->url('item') => 'Database',
	);
	
	
	// Put here the IDs of active castles 
	// $activeCastle = array (11,10);
	// Format: CastleID => (Starting Day, Starting Time, Ending Day, Ending Time)
	// 0 is Sunday; "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	$WoEdayTimes = array(
		15 => array(6, '10:00', 6, '11:00'),
		10 => array(6, '22:00', 6, '23:00'),
		0 => array(0, '10:00', 0, '11:00'),
		0 => array(0, '22:00', 0, '23:00'),

		16 => array(2, '10:00', 2, '11:00'),
		11 => array(2, '22:00', 2, '23:00'),
		6 => array(4, '10:00', 4, '11:00'),
		1 => array(4, '22:00', 4, '23:00'),
	);

?>
