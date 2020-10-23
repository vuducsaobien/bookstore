<?php 
	// ====================== PATHS ===========================
	define ('DS'				, '/');
	define ('PATH_PATH'			, dirname(__FILE__));						// Định nghĩa đường dẫn đến thư mục gốc
	define ('PATH_LIBRARY'		, PATH_PATH . DS . 'libs' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('PATH_LIBRARY_EXT'	, PATH_LIBRARY . 'extends' . DS);			// Định nghĩa đường dẫn đến thư mục thư viện
	define ('PATH_PUBLIC'		, PATH_PATH . DS . 'public' . DS);			// Định nghĩa đường dẫn đến thư mục public							
	define ('PATH_UPLOAD'		, PATH_PUBLIC  . 'files' . DS);				// Định nghĩa đường dẫn đến thư mục upload
	define ('PATH_SCRIPT'		, PATH_PUBLIC  . 'scripts' . DS);				// Định nghĩa đường dẫn đến thư mục upload
	define ('PATH_APPLICATION'	, PATH_PATH . DS . 'application' . DS);		// Định nghĩa đường dẫn đến thư mục application							
	define ('PATH_MODULE'		, PATH_APPLICATION . 'module' . DS);		// Định nghĩa đường dẫn đến thư mục module							
	define ('PATH_BLOCK'		, PATH_APPLICATION . 'block' . DS);			// Định nghĩa đường dẫn đến thư mục block							
	define ('PATH_TEMPLATE'		, PATH_PUBLIC . 'template' . DS);			// Định nghĩa đường dẫn đến thư mục template							
	
	define	('URL_ROOT'			, DS . 'bookstore' .DS. 'bookstore-code' . DS);
	// define	('URL_ROOT'			, DS);

	define	('URL_APPLICATION'	, URL_ROOT . 'application' . DS);
	define	('URL_PUBLIC'		, URL_ROOT . 'public' . DS);
	define	('URL_UPLOAD'		, URL_PUBLIC . 'files' . DS);
	define	('URL_TEMPLATE'		, URL_PUBLIC . 'template' . DS);

	define	('DEFAULT_MODULE'		, 'frontend');
	define	('DEFAULT_CONTROLLER'	, 'index');
	define	('DEFAULT_ACTION'		, 'index');

	// ====================== DATABASE ===========================
	define ('DB_HOST'			, 'localhost');
	define ('DB_USER'			, 'root');						
	define ('DB_PASS'			, '');						
	define ('DB_NAME'			, 'bookstore');						
	define ('DB_TABLE'			, 'group');
		
	// define ('DB_HOST'			, 'localhost');
	// define ('DB_USER'			, 'ducvuphp03_bookstore');						
	// define ('DB_PASS'			, '3y4lg35p');						
	// define ('DB_NAME'			, 'ducvuphp03_bookstore');						
	// define ('DB_TABLE'			, 'group');			

	// ====================== DATABASE TABLE===========================
	define ('TBL_GROUP'			, 'group');
	define ('TBL_USER'			, 'user');
	define ('TBL_PRIVELEGE'		, 'privilege');
	define ('TBL_CATEGORY'		, 'category');
	define ('TBL_BOOK'			, 'book');
	define ('TBL_CART'			, 'cart');
	define ('TBL_SLIDE'			, 'slide');
	
	// ====================== CONFIG ===========================
	define ('TIME_LOGIN'		 , 7200);
	define('DB_DATETIME_FORMAT',    'Y-m-d H:i:s');
	// define('DEFAULT_TIMEZONE',      'Asia/Ho_Chi_Minh');
	define('DEFAULT_TIMEZONE',      'Asia/Krasnoyarsk'); //+7.00
	define('DATETIME_FORMAT',       'd-m-Y H:i:s');
	define('TIMEDATE_FORMAT',       'H:i:s || d-m-Y');
	define('MONEY_VALUE',       'đ');

	// ====================== ELSE ===========================

	define('URL_FRIENDLY',       true);
	// define('URL_FRIENDLY',       false);

	define('ITEM_PER_PAGE',       5);
	define('PAGE_RANGE',       3);

	?>
