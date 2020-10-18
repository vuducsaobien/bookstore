<?php
// IndexController
$module     = $this->arrParam['module'];
$controller = $this->arrParam['controller'];
$action     = $this->arrParam['action'];
$item		= $this->Items;

$linkLogout = URL::createLink($module, 'index', 'logout');
$linkViewSite = URL::createLink('frontend', 'index', 'index');

$imageURL	= $this->_dirImg;
$arrMenu	= array(
	['link' => URL::createLink($module, 'group', 'index')		, 'name' => 'Group Manager'		, 'count' => $item['group']		, 'icon' => 'ion ion-ios-people'],
	['link' => URL::createLink($module, 'user', 'index')		, 'name' => 'User Manager'		, 'count' => $item['user']		, 'icon' => 'ion ion-ios-person'],
	['link' => URL::createLink($module, 'category', 'index')	, 'name' => 'Category Manager'	, 'count' => $item['category']	, 'icon' => 'ion ion-clipboard'],
	['link' => URL::createLink($module, 'book', 'index')		, 'name' => 'Book Manager'		, 'count' => $item['book']		, 'icon' => 'ion ion-ios-book'],
	['link' => URL::createLink($module, 'cart', 'index')		, 'name' => 'Cart Manager'		, 'count' => $item['cart']		, 'icon' => 'ion ion-ios-cart'],
	['link' => URL::createLink($module, 'slide', 'index')		, 'name' => 'Slide Manager'		, 'count' => $item['slide']		, 'icon' => 'far fa-images']
);

foreach($arrMenu as $value){
	$xhtml .= '
	<div class="col-lg-3 col-6">
		<div class="small-box bg-info">
			<div class="inner">
				<h3>'.$value['count'].'</h3>
				<p>'.$value['name'].'</p>
			</div>
			<div class="icon text-white">
			<i class="'.$value['icon'].'"></i>
			</div>
			<a href="'.$value['link'].'" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
';
}
?>

<div class="row justify-content-center">
	<?php echo $xhtml;?>
</div>