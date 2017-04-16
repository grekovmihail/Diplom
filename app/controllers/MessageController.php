<?php session_start();
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class MessageController extends ControllerBase
{


    /**
     * Creates a new trace
     */
    public function SosAction()
    {
        date_default_timezone_set("Europe/Moscow");
        $message = new Message();
        $message->Text = "Sos!";
        $message->MessageTime = date("y-m-d  G:i:s");
        $message->Trace_idTrace = 759;
        $message->Trace_Auto_KO = 102;

        if (!$message->save()) {
            foreach ($message->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "new"
            ));
        }
        $text = $message->Text." ".$message->MessageTime." ".$_SESSION["auto"]." ".$_SESSION["GEO"] ;

// Установка токена

        $botToken = "301863717:AAGIfjHkY7XTFNDPMeZfTbLc6xcARVc87Ew";
        $website = "https://api.telegram.org/getUpdates";


// Получаем внутренний номер чата Telegram и команду, введённую пользователем в   чате

        $chatId = 2772150;

         // Отправляем сформированное сообщение обратно в Telegram пользователю
        file_get_contents("https://api.telegram.org/bot" . $botToken."/sendMessage?disable_web_page_preview=true&chat_id=" . $chatId . "&text=" . $text);

        $this->flash->success("Помощь в пути!");

    }



    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }



    public function MakeReportMessageAction()
    {
        $this->persistent->parameters = null;
    }







    /**
     * Searches for message
     */
    public function ReportAllMessageAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Message', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idMessage";

        $message = Message::find($parameters);
        if (count($message) == 0) {
            $this->flash->notice("The search did not find any message");

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $message,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }




    public function ReportMessageAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Message', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idMessage";

        $message = Message::find($parameters);
        if (count($message) == 0) {
            $this->flash->notice("The search did not find any message");

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $message,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }








    /**
     * Searches for message
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Message', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "idMessage";

        $message = Message::find($parameters);
        if (count($message) == 0) {
            $this->flash->notice("The search did not find any message");

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $message,
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
     * Edits a message
     *
     * @param string $idMessage
     */
    public function editAction($idMessage)
    {
        if (!$this->request->isPost()) {

            $message = Message::findFirstByidMessage($idMessage);
            if (!$message) {
                $this->flash->error("message was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "message",
                    "action" => "index"
                ));
            }

            $this->view->idMessage = $message->idMessage;

            $this->tag->setDefault("idMessage", $message->idMessage);
            $this->tag->setDefault("Text", $message->Text);
            $this->tag->setDefault("MessageTime", $message->MessageTime);
            $this->tag->setDefault("Trace_idTrace", $message->Trace_idTrace);
            $this->tag->setDefault("Trace_Auto_KO", $message->Trace_Auto_KO);
            
        }
    }

    /**
     * Creates a new message
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "index"
            ));
        }

        $message = new Message();

        $message->idMessage = $this->request->getPost("idMessage");
        $message->Text = $this->request->getPost("Text");
        $message->MessageTime = $this->request->getPost("MessageTime");
        $message->Trace_idTrace = $this->request->getPost("Trace_idTrace");
        $message->Trace_Auto_KO = $this->request->getPost("Trace_Auto_KO");
        

        if (!$message->save()) {
            foreach ($message->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "new"
            ));
        }

        $this->flash->success("message was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "message",
            "action" => "index"
        ));
    }

    /**
     * Saves a message edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "index"
            ));
        }

        $idMessage = $this->request->getPost("idMessage");

        $message = Message::findFirstByidMessage($idMessage);
        if (!$message) {
            $this->flash->error("message does not exist " . $idMessage);

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "index"
            ));
        }

        $message->idMessage = $this->request->getPost("idMessage");
        $message->Text = $this->request->getPost("Text");
        $message->MessageTime = $this->request->getPost("MessageTime");
        $message->Trace_idTrace = $this->request->getPost("Trace_idTrace");
        $message->Trace_Auto_KO = $this->request->getPost("Trace_Auto_KO");
        

        if (!$message->save()) {

            foreach ($message->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "edit",
                "params" => array($message->idMessage)
            ));
        }

        $this->flash->success("message was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "message",
            "action" => "index"
        ));
    }

    /**
     * Deletes a message
     *
     * @param string $idMessage
     */
    public function deleteAction($idMessage)
    {
        $message = Message::findFirstByidMessage($idMessage);
        if (!$message) {
            $this->flash->error("message was not found");

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "index"
            ));
        }

        if (!$message->delete()) {

            foreach ($message->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "message",
                "action" => "search"
            ));
        }

        $this->flash->success("message was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "message",
            "action" => "index"
        ));
    }

}
