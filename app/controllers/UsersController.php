<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UsersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for users
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Users', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idUsers";

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $users,
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
     * Edits a user
     *
     * @param string $idUsers
     */
    public function editAction($idUsers)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstByidUsers($idUsers);
            if (!$user) {
                $this->flash->error("user was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "users",
                    "action" => "index"
                ));
            }

            $this->view->idUsers = $user->idUsers;

            $this->tag->setDefault("idUsers", $user->idUsers);
            $this->tag->setDefault("UsersFIO", $user->UsersFIO);
            $this->tag->setDefault("UsersType", $user->UsersType);
            $this->tag->setDefault("UsersLogin", $user->UsersLogin);
            $this->tag->setDefault("UsersPassword", $user->UsersPassword);
            
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user = new Users();

        $user->idUsers = $this->request->getPost("idUsers");
        $user->UsersFIO = $this->request->getPost("UsersFIO");
        $user->UsersType = $this->request->getPost("UsersType");
        $user->UsersLogin = $this->request->getPost("UsersLogin");
        $user->UsersPassword = $this->request->getPost("UsersPassword");
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "new"
            ));
        }

        $this->flash->success("user was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $idUsers = $this->request->getPost("idUsers");

        $user = Users::findFirstByidUsers($idUsers);
        if (!$user) {
            $this->flash->error("user does not exist " . $idUsers);

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        $user->idUsers = $this->request->getPost("idUsers");
        $user->UsersFIO = $this->request->getPost("UsersFIO");
        $user->UsersType = $this->request->getPost("UsersType");
        $user->UsersLogin = $this->request->getPost("UsersLogin");
        $user->UsersPassword = $this->request->getPost("UsersPassword");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "edit",
                "params" => array($user->idUsers)
            ));
        }

        $this->flash->success("user was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));
    }

    /**
     * Deletes a user
     *
     * @param string $idUsers
     */
    public function deleteAction($idUsers)
    {
        $user = Users::findFirstByidUsers($idUsers);
        if (!$user) {
            $this->flash->error("user was not found");

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "index"
            ));
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "search"
            ));
        }

        $this->flash->success("user was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users",
            "action" => "index"
        ));
    }

}
