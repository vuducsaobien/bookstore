<?php
class UserValidate extends Validate
{
    public function __construct($arrParams)
    {
        $dataForm = $arrParams['form'] ?? [];
        parent::__construct($dataForm);
    }

    public function validate($model=null)
    {
        $queryUsername = "SELECT `id` FROM " . TBL_USER . " WHERE `username` = '{$this->source['username']}'";
        $queryEmail = "SELECT `id` FROM " . TBL_USER . " WHERE `email` = '{$this->source['email']}'";
        if(isset($this->source['id'])){
            $queryUsername .= " AND `id` <> '{$this->source['id']}'";        
            $queryEmail .= " AND `id` <> '{$this->source['id']}'";
        } else {
            $this->addRule('password', 'string', ['min' => 3, 'max' => 32]);
        }

        $this
        ->addRule('username', 'string-notExistRecord', [
            'database'  => $model, 
            'query'     => $queryUsername, 
            'min'       => 3, 'max' => 25
        ])
        ->addRule('email', 'email-notExistRecord', [
            'database'  => $model, 
            'query'     => $queryEmail
            ])
        ->addRule('status', 'status', ['deny' => ['default']])
        ->addRule('group_id', 'group', ['deny' => ['default']] );
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
