<?php
class CategoryModel extends BackendModel
{
	protected $_columnsCategory = [
		'id', 'name', 'picture', 'created', 'created_by', 'special',
		'modified', 'modified_by', 'status', 'ordering'
	];
	protected $fieldSearchAcceptedCategory = ['id', 'name'];

	public function __construct()
	{
		parent::__construct();
	}

	/*----- ELSE -----*/
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

	
}
