<?php

namespace Jordan\Test\Controller;

use Jordan\Test\Views;

class Search
{
    private string $page = 'search';
    private ?string $action = null;
    public function __construct()
    {
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }
        switch ($this->action) {
            case 'details':
                $this->details();
                break;
            case 'edit':
                $this->edit();
                break;
            default:
                $this->search();
                break;
        }
    }


    // Gere les données et la page edit
    public function edit()
    {
        if (isset($_SESSION) && $_SESSION['logged']) {
            $view = new Views('search/edit');
            $view->setVar('page', $this->page);
            if (isset($_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['adresse'], $_POST['code_postal'], $_POST['ville'])) {
                $id = $_GET['id'];
                $data = [$_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['adresse'], $_POST['code_postal'], $_POST['ville']];
                $this->editClient($data); //non fonctionnelle
                header("Location: index.php?page=search&action=details&id=$id");
                exit;
            }
            $id = $_GET['id'];
            $client = $this->getByID($id);
            $view->setVar('client', $client);
        } else {
            $view = new Views('login/login');
            $view->setVar('page', 'login');
        }

        $view->render();
    }

    // Gere les données et la page details
    public function details()
    {
        if (isset($_SESSION) && $_SESSION['logged']) {
            $view = new Views('search/details');
            $view->setVar('page', $this->page);
            $id = $_GET['id'];
            $client = $this->getByID($id);
            $view->setVar('client', $client);
        } else {
            $view = new Views('login/login');
            $view->setVar('page', 'login');
        }
        $view->render();
    }

    // Gere les données et la page search
    public function search()
    {
        if (isset($_SESSION) && $_SESSION['logged']) {
            $view = new Views('search/search');
            $view->setVar('page', $this->page);
            
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
                $clients =$this->getByName($name);
                $view->setVar('clients', $clients);
            } else{
                $clientAll = $this->getAll();
                $view->setVar('clients',$clientAll);
            }
            $view->render();
        } else {
            $view = new Views('login/login');
            $view->setVar('page', 'login');
        }
    }

    //Renvoie tous les clients
    public function getAll()
    {
        // Initiate curl session in a variable (resource)
        $curl_handle = curl_init();
        $url = "https://evaluation-technique.lundimatin.biz/api/clients?fields=nom,adresse,ville,tel";
        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        // Set the curl Request option
        curl_setopt($curl_handle, CURLOPT_HEADER, false); //allow to see request details
        curl_setopt($curl_handle, CURLOPT_USERPWD, '' . ":" . $_SESSION['token']); //set the Authorization
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/api.restv1+json'));
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);

        // Close the curl session
        curl_close($curl_handle);

        // Decode JSON into PHP array
        $response_data = json_decode($curl_data);
        // var_dump($response_data->datas);
        return $response_data->datas;
    }

    // A fusionner avec la fonction du dessus en curl($url) par exemple
    //Prends un string $id en attribut et renvoie le client correspondant
    public function getByID(string $id)
    {
        // Initiate curl session in a variable (resource)
        $curl_handle = curl_init();
        $url = "https://evaluation-technique.lundimatin.biz/api/clients/$id";
        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        // Set the curl Request option
        curl_setopt($curl_handle, CURLOPT_HEADER, false); //allow to see request details
        curl_setopt($curl_handle, CURLOPT_USERPWD, '' . ":" . $_SESSION['token']); //set the Authorization
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/api.restv1+json'));
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);

        // Close the curl session
        curl_close($curl_handle);

        // Decode JSON into PHP array
        $response_data = json_decode($curl_data);
        // var_dump($response_data->datas);
        return $response_data->datas;
    }


    public function editClient(array $data)
    {

        $url = "https://evaluation-technique.lundimatin.biz/api/clients/" . $_GET['id'];
        // Initiate curl session in a variable (resource)
        $curl_handle = curl_init();

        $datas = json_encode($data);
        $curl_handle = curl_init($url);

        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $datas);
        curl_setopt($curl_handle, CURLOPT_HEADER, false); //allow to see request details
        curl_setopt($curl_handle, CURLOPT_USERPWD, '' . ":" . $_SESSION['token']); //set the Authorization
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/api.restv1+json'));
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);

        // on execute la modification
        curl_exec($curl_handle);

        // Close the curl session
        curl_close($curl_handle);
    }

    //Prends un string $name en attribut et renvoie tous les clients dont le nom contient $name
    public function getByName(string $name){
        // Initiate curl session in a variable (resource)
        $curl_handle = curl_init();
        $url = "https://evaluation-technique.lundimatin.biz/api/clients?nom=$name&fields=nom,adresse,ville,tel";
        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        // Set the curl Request option
        curl_setopt($curl_handle, CURLOPT_HEADER, false); //allow to see request details
        curl_setopt($curl_handle, CURLOPT_USERPWD, '' . ":" . $_SESSION['token']); //set the Authorization
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/api.restv1+json'));
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);

        // Close the curl session
        curl_close($curl_handle);

        // Decode JSON into PHP array
        $response_data = json_decode($curl_data);
        // var_dump($response_data->datas);
        return $response_data->datas;
    }
}
