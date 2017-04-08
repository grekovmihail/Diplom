<?php session_start();




use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TraceController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;





    }



    public function makeReportAction()
    {
        $this->persistent->parameters = null;





    }




    /**
     * Searches for trace
     */
    public function ReportMapsAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Trace', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idTrace";

        $trace = Trace::find($parameters);
        if (count($trace) == 0) {
            $this->flash->notice("The search did not find any trace");

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $trace,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }







    /**
     * ־עקועû
     */
    public function reportAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Trace', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idTrace";

        $trace = Trace::find($parameters);
        if (count($trace) == 0) {
            $this->flash->notice("The search did not find any trace");

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $trace,
            "limit"=> 50000,
            "page" => 1
        ));

        $this->view->page = $paginator->getPaginate();
    }



    public function reportAllKOAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Trace', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idTrace";

        $trace = Trace::find($parameters);
        if (count($trace) == 0) {
            $this->flash->notice("The search did not find any trace");

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $trace,
            "limit"=> 50000,
            "page" => 1
        ));

        $this->view->page = $paginator->getPaginate();
    }



    public function ReportAllMessageAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Trace', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idTrace";

        $trace = Trace::find($parameters);
        if (count($trace) == 0) {
            $this->flash->notice("The search did not find any trace");

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $trace,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }





    /**
     * Searches for trace
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Trace', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idTrace";

        $trace = Trace::find($parameters);
        if (count($trace) == 0) {
            $this->flash->notice("The search did not find any trace");

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $trace,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a trace
     *
     * @param string $idTrace
     */
    public function editAction($idTrace)
    {
        if (!$this->request->isPost()) {

            $trace = Trace::findFirstByidTrace($idTrace);
            if (!$trace) {
                $this->flash->error("trace was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "trace",
                    "action" => "index"
                ));
            }

            $this->view->idTrace = $trace->idTrace;

            $this->tag->setDefault("idTrace", $trace->idTrace);
            $this->tag->setDefault("Auto_KO", $trace->Auto_KO);
            $this->tag->setDefault("Coordinates", $trace->Coordinates);
            $this->tag->setDefault("Message", $trace->Message);
            $this->tag->setDefault("Time", $trace->Time);
            
        }
    }

    /**
     * Creates a new trace
     */
    public function createAction()
    {


        date_default_timezone_set("Europe/Moscow");



        $trace = new Trace();
        $trace->Speed = 60;

        $trace->Auto_KO = 102;
         $trace->Coordinate = $_POST["d"];
        $trace->Time = date("y-m-d  G:i:s");
        $_SESSION["GEO"]=$_POST["d"];
        $_SESSION["auto"]=102;


        if (!$trace->save()) {
            foreach ($trace->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "new"
            ));
        }

        $this->flash->success("trace was created successfully");


    }



    /**
     * Saves a trace edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        $idTrace = $this->request->getPost("idTrace");

        $trace = Trace::findFirstByidTrace($idTrace);
        if (!$trace) {
            $this->flash->error("trace does not exist " . $idTrace);

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        $trace->Auto_KO = $this->request->getPost("Auto_KO");
        $trace->Coordinates = $this->request->getPost("Coordinates");
        $trace->Message = $this->request->getPost("Message");
        $trace->Time = $this->request->getPost("Time");
        

        if (!$trace->save()) {

            foreach ($trace->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "edit",
                "params" => array($trace->idTrace)
            ));
        }

        $this->flash->success("trace was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "trace",
            "action" => "index"
        ));
    }

    /**
     * Deletes a trace
     *
     * @param string $idTrace
     */
    public function deleteAction($idTrace)
    {
        $trace = Trace::findFirstByidTrace($idTrace);
        if (!$trace) {
            $this->flash->error("trace was not found");

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "index"
            ));
        }

        if (!$trace->delete()) {

            foreach ($trace->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "trace",
                "action" => "search"
            ));
        }

        $this->flash->success("trace was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "trace",
            "action" => "index"
        ));
    }

}
