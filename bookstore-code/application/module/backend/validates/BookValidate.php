<?php
class BookValidate extends Validate
{
    public function __construct($arrParams)
    {
        $dataForm = $arrParams['form'] ?? [];
        parent::__construct($dataForm);
    }

    public function validate()
    {
        $this
        ->addRule('name', 'string', ['min' => 3, 'max' => 255])
        ->addRule('status', 'status', ['deny' => ['default']])
        ->addRule('category_id', 'group', ['deny' => array('default')])
        ->addRule('special', 'status', ['deny' => array('default')])
        ->addRule('sale_off', 'int', ['min' => 1, 'max' => 100])
        ->addRule('price', 'int', ['min' => 1000, 'max' => 1000000])
        ->addRule('picture', 'file', ['min' => 100, 'max' => 1000000000, 'extension' => ['jpg', 'jpeg', 'png']], false);
        $this->run();
    }
}
