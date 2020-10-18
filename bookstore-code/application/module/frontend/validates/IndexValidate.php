<?php
class IndexValidate extends Validate
{
    public function __construct($arrParams)
    {
        $dataForm = $arrParams['form'] ?? [];
        parent::__construct($dataForm);
    }

    public function validate($model = null)
    {
        $email	    = $this->source['email'];
        $password	= md5($this->source['password']);
        $query		= "SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'";

        $this
        ->addRule('email', 'existRecordAdmin', ['database' => $model, 'query' => $query] )
        ->addRule('password', 'string', ['min' => 3, 'max' => 255] );

        $this->run();
    }

    public function validateForgot($model = null)
    {
        $email	    = $this->source['email'];
        $query		= "SELECT `id` FROM `user` WHERE `email` = '$email' ";

        $this
        ->addRule('email', 'existRecord', ['database' => $model, 'query' => $query] );
        $this->run();
    }


    public function validateRegister($model = null)
    {
        $queryUserName	= "SELECT `id` FROM `".TBL_USER."` WHERE `username` = '{$this->source['username']}'";
        $queryEmail		= "SELECT `id` FROM `".TBL_USER."` WHERE `email` = '{$this->source['email']}'";

        $this
        ->addRule('username', 'string-notExistRecord', [
            'database'  => $model, 
            'query' 	=> $queryUserName, 
            'min' 		=> 3, 'max' => 25
        ])
        ->addRule('password', 'string', ['min' => 3, 'max' => 255] )
        // ->addRule('password', 'password', ['action' => 'add'])
        ->addRule('email', 'email-notExistRecord', ['database' => $model, 'query' => $queryEmail]);
        $this->run();
        }


}
