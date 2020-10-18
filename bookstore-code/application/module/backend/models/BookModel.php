<?php
class BookModel extends BackendModel
{
	protected $_columnsBook = [
		'id', 'name', 'description', 'price', 'sale_off', 'picture', 'special', 'short_description',
		'category_id', 'status', 'ordering', 'created', 'created_by',  'modified', 'modified_by'
	];
	protected $fieldSearchAcceptedBook = ['id', 'name'];

	public function __construct()
	{
		parent::__construct();
	}

	/*----- ELSE -----*/
	public function changeCategory($arrParam, $options = null)
    {
        $id 		= $arrParam['id'];
		$stateName 		= 'category_id';
		$state			= $arrParam['category_id'];

		$query  = "UPDATE `$this->table` SET `$stateName` = '$state', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` = $id";
		$this->query($query);
        return [
            'id' 	   	=> $id,
			'modified'  => HTML::showItemHistory($this->username, $this->timeNow),
			'link'      => URL::createLink($arrParam['module'], $arrParam['controller'], 'changeCategory', ['id' => $id, "$stateName" => $state])
        ];
    }

	public function ajaxOrdering($arrParam, $options = null)
    {
        $id 	  		= $arrParam['id'];
		$stateName 		= 'ordering';
		$state			= $arrParam['ordering'];

		$query  = "UPDATE `$this->table` SET `$stateName` = '$state', `modified_by` = '{$this->username}', `modified` = '{$this->timeNow}' WHERE `id` = $id";
		$this->query($query);
        return [
            'id' 	   	=> $id,
			'modified'  => HTML::showItemHistory($this->username, $this->timeNow),
			'link'      => URL::createLink($arrParam['module'], $arrParam['controller'], 'ajaxOrdering', ['id' => $id, "$stateName" => $state])
        ];
	}

	public function itemInSelectbox($arrParam, $options = null){
		if($options == null){
			$query 	= "SELECT `id`, `name` FROM `".TBL_CATEGORY."`";
			$result = $this->fetchPairs($query);
			$result['default'] = "- Select Category -";
			ksort($result);
		}	
		return $result;
	}







}
