<?php 

namespace Jordan\Test;
use Jordan\Test\Controller\Login;
use Jordan\Test\Controller\Search;




class Dispatcher {
    private ?string $page=null;
    private ?string $id=null;
    private ?string $action=null;
    public function __construct()
    {
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        } 
        if (isset($_GET['id'])) {
            $this->id = $_GET['id'];
        }
        if (isset($_GET['action'])) {
            $this->action = $_GET['action'];
        }
    }

    public function dispatch()
    {
        if (is_null($this->page) || $this->page === 'login') {
            new Login();
        }elseif ($this->page === 'search') {
            new Search();
        }
    }
}