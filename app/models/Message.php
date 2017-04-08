<?php

class Message extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idMessage;

    /**
     *
     * @var string
     */
    public $Text;

    /**
     *
     * @var string
     */
    public $MessageTime;

    /**
     *
     * @var integer
     */
    public $Trace_idTrace;

    /**
     *
     * @var integer
     */
    public $Trace_Auto_KO;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('Trace_idTrace', 'Trace', 'idTrace', array('alias' => 'Trace'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'message';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Message[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Message
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
