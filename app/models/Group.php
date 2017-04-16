<?php

class Group extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $KOGroup;

    /**
     *
     * @var string
     */
    public $GroupName;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('KOGroup', 'Auto', 'Group_KOGroup', array('alias' => 'Auto'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'group';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Group[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Group
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
