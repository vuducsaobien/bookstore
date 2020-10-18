<?php
class GroupValidate extends Validate
{
    public function __construct($arrParams)
    {
        $dataForm = $arrParams['form'] ?? [];
        parent::__construct($dataForm);
        // parent::__construct($arrParams['form']);
    }

    public function validate()
    {
        $this
            ->addRule('name', 'string', array('min' => 3, 'max' => 255))
            ->addRule('status', 'status', array('deny' => array('default')))
            ->addRule('group_acp', 'status', array('deny' => array('default')));
        $this->run();
    }
}
