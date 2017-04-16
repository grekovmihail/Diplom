<?php

class Auto extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $KO;

    /**
     *
     * @var string
     */
    public $Name;

    /**
     *
     * @var string
     */
    public $Type;

    /**
     *
     * @var integer
     */
    public $Group_KOGroup;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('KO', 'Routes', 'Auto_KO', array('alias' => 'Routes'));
        $this->hasMany('KO', 'Trace', 'Auto_KO', array('alias' => 'Trace'));
        $this->belongsTo('Group_KOGroup', 'Group', 'KOGroup', array('alias' => 'Group'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'auto';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Auto[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Auto
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
