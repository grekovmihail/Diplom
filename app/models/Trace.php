<?php

class Trace extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idTrace;

    /**
     *
     * @var integer
     */
    public $Auto_KO;

    /**
     *
     * @var integer
     */
    public $Coordinate;

    /**
     *
     * @var string
     */
    public $Message;

    /**
     *
     * @var string
     */
    public $Time;


       public $Speed;
           /**
     *
     * @var string
     */




    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('idTrace', 'Message', 'Trace_idTrace', array('alias' => 'Message'));
        $this->belongsTo('Auto_KO', 'Auto', 'KO', array('alias' => 'Auto'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'trace';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Trace[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Trace
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
