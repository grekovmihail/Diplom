<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class SecurityController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for security
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Security', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idSecurity";

        $security = Security::find($parameters);
        if (count($security) == 0) {
            $this->flash->notice("The search did not find any security");

            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $security,
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
     * Edits a security
     *
     * @param string $idSecurity
     */
    public function editAction($idSecurity)
    {
        if (!$this->request->isPost()) {

            $security = Security::findFirstByidSecurity($idSecurity);
            if (!$security) {
                $this->flash->error("security was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "security",
                    "action" => "index"
                ));
            }

            $this->view->idSecurity = $security->idSecurity;

            $this->tag->setDefault("idSecurity", $security->idSecurity);
            $this->tag->setDefault("FIO_Security", $security->FIO_Security);
            $this->tag->setDefault("Login", $security->Login);
            $this->tag->setDefault("Password", $security->Password);
            
        }
    }

    /**
     * Creates a new security
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "index"
            ));
        }

        $security = new Security();

        $security->idSecurity = $this->request->getPost("idSecurity");
        $security->FIO_Security = $this->request->getPost("FIO_Security");
        $security->Login = $this->request->getPost("Login");
        $security->Password = $this->request->getPost("Password");
        

        if (!$security->save()) {
            foreach ($security->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "new"
            ));
        }

        $this->flash->success("security was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "security",
            "action" => "index"
        ));
    }

    /**
     * Saves a security edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "index"
            ));
        }

        $idSecurity = $this->request->getPost("idSecurity");

        $security = Security::findFirstByidSecurity($idSecurity);
        if (!$security) {
            $this->flash->error("security does not exist " . $idSecurity);

            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "index"
            ));
        }

        $security->idSecurity = $this->request->getPost("idSecurity");
        $security->FIO_Security = $this->request->getPost("FIO_Security");
        $security->Login = $this->request->getPost("Login");
        $security->Password = $this->request->getPost("Password");
        

        if (!$security->save()) {

            foreach ($security->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "edit",
                "params" => array($security->idSecurity)
            ));
        }

        $this->flash->success("security was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "security",
            "action" => "index"
        ));
    }

    /**
     * Deletes a security
     *
     * @param string $idSecurity
     */
    public function deleteAction($idSecurity)
    {
        $security = Security::findFirstByidSecurity($idSecurity);
        if (!$security) {
            $this->flash->error("security was not found");

            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "index"
            ));
        }

        if (!$security->delete()) {

            foreach ($security->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "security",
                "action" => "search"
            ));
        }

        $this->flash->success("security was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "security",
            "action" => "index"
        ));
    }

}
