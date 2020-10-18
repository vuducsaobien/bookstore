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
        $username = $this->source['username'];
        $password = md5($this->source['password']);
        $query = "SELECT `id` FROM `user` WHERE `username` = '{$username}' AND `password` = '{$password}'";
        $this->addRule('username', 'existRecordAdmin', ['database' => $model, 'query' => $query]);

        $this->run();
    }

}
