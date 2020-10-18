<?php
class GroupModel extends BackendModel
{
	protected $_columnsGroup = [
		'id', 'name', 'group_acp', 'created', 'created_by', 
		'modified', 'modified_by', 'status'
	];
	protected $fieldSearchAcceptedGroup = ['id', 'name'];
	
	public function __construct()
	{
		parent::__construct();
	}




}
