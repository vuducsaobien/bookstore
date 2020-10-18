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

	
}
