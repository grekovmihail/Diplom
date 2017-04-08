<?php

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idUsers;

    /**
     *
     * @var string
     */
    public $UsersFIO;

    /**
     *
     * @var string
     */
    public $UsersType;

    /**
     *
     * @var string
     */
    public $UsersLogin;

    /**
     *
     * @var string
     */
    public $UsersPassword;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
