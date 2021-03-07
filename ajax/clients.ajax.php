<?php

    require_once "../controllers/clients.controller.php";
    require_once "../models/clients.model.php";
    
    class AjaxClients{

        //Edit Client
        public $client_id;

        public function ajaxEditClient(){

            $item = "id";
            $value = $this->client_id;
            $request = ClientController::ctrShowClients($item, $value);

            echo json_encode($request);
        }        

    }

    //Edit User
    if(isset($_POST["clientId"])){

        $edit_client = new AjaxClients();
        $edit_client->client_id = $_POST["clientId"];
        $edit_client->ajaxEditClient();
    }    