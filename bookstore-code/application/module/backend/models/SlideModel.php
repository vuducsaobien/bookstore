<?php
class SlideModel extends BackendModel
{
	protected $_columnsSlide = [
		'id', 'name', 'picture', 'created', 'created_by', 'description', 'link',
		'modified', 'modified_by', 'status', 'ordering'
	];
	protected $fieldSearchAcceptedSlide = ['id', 'name'];

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
		$modified 	  	= $this->modified;
		$modified_by 	= $this->modified_by;

		$query  = "UPDATE `$this->table` SET `$stateName` = '$state', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = $id";
		
		$this->query($query);
        return [
            'id' 	   	=> $id,
			'modified'  => HTML::showItemHistory($modified_by, $modified),
			'link'      => URL::createLink($arrParam['module'], $arrParam['controller'], 'ajaxOrdering', ['id' => $id, "$stateName" => $state])
        ];
	}

	
}
