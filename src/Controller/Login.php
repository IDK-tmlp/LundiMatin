<?php 

namespace Jordan\Test\Controller;
use Jordan\Test\Views;



class Login {
    private string $page='login';
    private ?string $action=null;
    public function __construct()
    {
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }
        switch ($this->action) {
            case 'logout':
                $this->logout();
                break;
            default:
                $this->login();
                break;
        }
    }

    

    public function login(){
        $flashmsg ='';
        if (isset($_POST['username']) && isset($_POST['password'])) {
            
            $datas =$this->getToken($_POST['username'], $_POST['password']);
            if (!empty($datas)) {
                $_SESSION['logged']=true;
                $_SESSION['token'] = $datas->token;
                header("Location: index.php?page=search");
                exit;
            }else $flashmsg="Mauvais login ou password";
        }
        $view = new Views('login/login');
        $view->setVar('page',$this->page);
        $view->setVar('flashmsg',$flashmsg);
        $view->render();

    }

    public function logout(){
        $view = new Views('login/login');
        $view->setVar('page',$this->page);
        session_unset();
        $view->render();
    }

    // Fonction qui test la connection a l'API, renvoie l'objet data qui est vide si la connexion a echouée et contient token si connexion effectuée
    public function getToken($username, $password){
        $data = array(
            "username" => $username,
            "password" => $password,
            "code_application" => "webservice_externe",
            "code_version" => "1"
        );
        $json_data = json_encode($data);

        // Initiate curl session in a variable (resource)
        $curl_handle = curl_init();
        $url = "https://evaluation-technique.lundimatin.biz/api/auth";
        // Set the curl URL option
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        // Set the curl Request option
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($curl_handle, CURLOPT_HEADER, false);
        curl_setopt($curl_handle,CURLOPT_HTTPHEADER, array( 'Content-Type:application/json', 'Accept: application/api.restv1+json'));
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        // Execute curl & store data in a variable
        $curl_data = curl_exec($curl_handle);

        // Close the curl session
        curl_close($curl_handle);

        // Decode JSON into PHP array (substr to get only the js object)
        $response_data = json_decode($curl_data);
        if ($response_data != []) {
            return $response_data->datas;
        }else return $response_data->datas;

    }
    
}