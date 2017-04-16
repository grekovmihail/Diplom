<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AutoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for auto
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Auto', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KO";

        $auto = Auto::find($parameters);
        if (count($auto) == 0) {
            $this->flash->notice("The search did not find any auto");

            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $auto,
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
     * Edits a auto
     *
     * @param string $KO
     */
    public function editAction($KO)
    {
        if (!$this->request->isPost()) {

            $auto = Auto::findFirstByKO($KO);
            if (!$auto) {
                $this->flash->error("auto was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "auto",
                    "action" => "index"
                ));
            }

            $this->view->KO = $auto->KO;

            $this->tag->setDefault("KO", $auto->KO);
            $this->tag->setDefault("Name", $auto->Name);
            $this->tag->setDefault("Type", $auto->Type);
            $this->tag->setDefault("Group_KOGroup", $auto->Group_KOGroup);
            
        }
    }

    /**
     * Creates a new auto
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "index"
            ));
        }

        $auto = new Auto();

        $auto->KO = $this->request->getPost("KO");
        $auto->Name = $this->request->getPost("Name");
        $auto->Type = $this->request->getPost("Type");
        $auto->Group_KOGroup = $this->request->getPost("Group_KOGroup");
        

        if (!$auto->save()) {
            foreach ($auto->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "new"
            ));
        }

        $this->flash->success("auto was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "auto",
            "action" => "index"
        ));
    }

    /**
     * Saves a auto edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "index"
            ));
        }

        $KO = $this->request->getPost("KO");

        $auto = Auto::findFirstByKO($KO);
        if (!$auto) {
            $this->flash->error("auto does not exist " . $KO);

            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "index"
            ));
        }

        $auto->KO = $this->request->getPost("KO");
        $auto->Name = $this->request->getPost("Name");
        $auto->Type = $this->request->getPost("Type");
        $auto->Group_KOGroup = $this->request->getPost("Group_KOGroup");
        

        if (!$auto->save()) {

            foreach ($auto->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "edit",
                "params" => array($auto->KO)
            ));
        }

        $this->flash->success("auto was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "auto",
            "action" => "index"
        ));
    }

    /**
     * Deletes a auto
     *
     * @param string $KO
     */
    public function deleteAction($KO)
    {
        $auto = Auto::findFirstByKO($KO);
        if (!$auto) {
            $this->flash->error("auto was not found");

            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "index"
            ));
        }

        if (!$auto->delete()) {

            foreach ($auto->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "auto",
                "action" => "search"
            ));
        }

        $this->flash->success("auto was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "auto",
            "action" => "index"
        ));
    }

}
