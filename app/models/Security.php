<?php

class Security extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idSecurity;

    /**
     *
     * @var string
     */
    public $FIO_Security;

    /**
     *
     * @var string
     */
    public $Login;

    /**
     *
     * @var string
     */
    public $Password;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'security';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Security[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Security
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
