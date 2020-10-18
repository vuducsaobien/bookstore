<?php
class UserValidate extends Validate
{
    public function __construct($arrParams)
    {
        $dataForm = $arrParams['form'] ?? [];
        parent::__construct($dataForm);
    }

    public function validate()
    {
        $this
        ->addRule('fullname', 'string', ['min' => 3, 'max' => 255] )
        ->addRule('address', 'string', ['min' => 3, 'max' => 255] )
        ->addRule('phone', 'string', ['min' => 3, 'max' => 12] );
        $this->run();
    }

    public function validateResetPassword()
    {
        $this
            ->addRule('old-password', 'string', ['min' => 3, 'max' => 255] )
            ->addRule('new-password', 'string', ['min' => 3, 'max' => 255] );
        $this->run();
    }

}
