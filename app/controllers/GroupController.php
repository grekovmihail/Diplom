<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class GroupController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for group
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Group', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "KOGroup";

        $group = Group::find($parameters);
        if (count($group) == 0) {
            $this->flash->notice("The search did not find any group");

            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $group,
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
     * Edits a group
     *
     * @param string $KOGroup
     */
    public function editAction($KOGroup)
    {
        if (!$this->request->isPost()) {

            $group = Group::findFirstByKOGroup($KOGroup);
            if (!$group) {
                $this->flash->error("group was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "group",
                    "action" => "index"
                ));
            }

            $this->view->KOGroup = $group->KOGroup;

            $this->tag->setDefault("KOGroup", $group->KOGroup);
            $this->tag->setDefault("GroupName", $group->GroupName);
            
        }
    }

    /**
     * Creates a new group
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "index"
            ));
        }

        $group = new Group();

        $group->KOGroup = $this->request->getPost("KOGroup");
        $group->GroupName = $this->request->getPost("GroupName");
        

        if (!$group->save()) {
            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "new"
            ));
        }

        $this->flash->success("group was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "group",
            "action" => "index"
        ));
    }

    /**
     * Saves a group edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "index"
            ));
        }

        $KOGroup = $this->request->getPost("KOGroup");

        $group = Group::findFirstByKOGroup($KOGroup);
        if (!$group) {
            $this->flash->error("group does not exist " . $KOGroup);

            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "index"
            ));
        }

        $group->KOGroup = $this->request->getPost("KOGroup");
        $group->GroupName = $this->request->getPost("GroupName");
        

        if (!$group->save()) {

            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "edit",
                "params" => array($group->KOGroup)
            ));
        }

        $this->flash->success("group was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "group",
            "action" => "index"
        ));
    }

    /**
     * Deletes a group
     *
     * @param string $KOGroup
     */
    public function deleteAction($KOGroup)
    {
        $group = Group::findFirstByKOGroup($KOGroup);
        if (!$group) {
            $this->flash->error("group was not found");

            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "index"
            ));
        }

        if (!$group->delete()) {

            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "group",
                "action" => "search"
            ));
        }

        $this->flash->success("group was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "group",
            "action" => "index"
        ));
    }

}
