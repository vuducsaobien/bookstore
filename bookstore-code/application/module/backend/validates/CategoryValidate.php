<?php
class CategoryValidate extends Validate
{
    public function __construct($arrParams)
    {
        $dataForm = $arrParams['form'] ?? [];
        parent::__construct($dataForm);
    }

    public function validate()
    {
       $this
            ->addRule('name', 'string', ['min' => 3, 'max' => 255] )
            ->addRule('status', 'status', ['deny' => array('default') ])
            ->addRule('special', 'special', ['deny' => array('default') ])
            ->addRule('ordering', 'int', ['min' => 1, 'max' => 100] )
            ->addRule('picture', 'file', ['min' => 100, 'max' => 1000000000, 'extension' => ['jpg', 'jpeg', 'png']], false);
       $this->run();
    }
}
