<?php

require_once 'Core/Controller.php';

class CategoriaFuncionarioController extends Controller
{
    private $controller = 'CategoriaFuncionario';
    private $view;

    public function __construct()
    {
        parent::__construct();
        $this->CategoriaFuncionario = parent::loadModel("CategoriaFuncionario");
    }

    public function index($param)
    {
        $categoriasFuncionario = $this->CategoriaFuncionario->list();
        $count = $this->CategoriaFuncionario->countItems();
        require_once parent::loadView($this->controller, $this->view);
    }

    public function setView($a)
    {
        $this->view = $a;
    }

    public function add()
    {
        $nm_categoria = isset($_POST['nm_categoria']) ? $_POST['nm_categoria'] : null;
        $ic_status = isset($_POST['ic_status']) ? $_POST['ic_status'] : null;
        $nm_sigla = isset($_POST['nm_sigla']) ? $_POST['nm_sigla'] : null;

        if ($nm_categoria != null && $ic_status != null && $nm_sigla != null) {
            $this->CategoriaFuncionario->nm_categoria = $nm_categoria;
            $this->CategoriaFuncionario->ic_status = $ic_status;
            $this->CategoriaFuncionario->nm_sigla = $nm_sigla;
            $this->CategoriaFuncionario->insert();
            $this->redirectUrl($this->controller);
            exit;
        } else {
            // echo 'Preencha todos os campos';
            // $this->redirectUrl();
            // exit;
        }

        require_once parent::loadView($this->controller, $this->view);
    }

    public function edit(array $param)
    {
        $cd_categoria = $param[0];
        if ($cd_categoria != "") {
            $nm_categoria = isset($_POST['nm_categoria']) ? $_POST['nm_categoria'] : null;
            $ic_status = isset($_POST['ic_status']) ? $_POST['ic_status'] : null;
            $nm_sigla = isset($_POST['nm_sigla']) ? $_POST['nm_sigla'] : null;
            
            if ($nm_categoria != null && $ic_status != null && $nm_sigla != null) {
                $this->CategoriaFuncionario->cd_categoria = $cd_categoria;
                $this->CategoriaFuncionario->nm_categoria = $nm_categoria;
                $this->CategoriaFuncionario->ic_status = $ic_status;
                $this->CategoriaFuncionario->nm_sigla = $nm_sigla;
                $this->CategoriaFuncionario->update();
                $this->redirectUrl($this->controller);
                exit;
            } else {
                $this->CategoriaFuncionario->cd_categoria = $cd_categoria;
                $categoriaFuncionario = $this->CategoriaFuncionario->select();
                $nm_categoria = $categoriaFuncionario->nm_categoria;
                $ic_status = $categoriaFuncionario->ic_status;
                $nm_sigla = $categoriaFuncionario->nm_sigla;
            }
        } else {
            echo 'É necessário um código';
            $this->redirectUrl();
            exit;
        }

        require_once parent::loadView($this->controller, $this->view);
    }

    public function view(array $param)
    {
        $cd_categoria = $param[0];
        if ($cd_categoria != "") {
            $this->CategoriaFuncionario->cd_categoria = $cd_categoria;
            $categoriaFuncionario = $this->CategoriaFuncionario->select();
        } else {
            echo 'É necessário um código';
            $this->redirectUrl();
            exit;
        }

        require_once parent::loadView($this->controller, $this->view);
    }

    public function disable(array $param)
    {
        $cd_categoria = $param[0];
        if ($cd_categoria != "") {
            $this->CategoriaFuncionario->cd_categoria = $cd_categoria;
            $this->CategoriaFuncionario->disable();
            $this->redirectUrl();
            exit;
        } else {
            echo 'É necessário um código';
            $this->redirectUrl();
            exit;
        }
    }

    public function enable(array $param)
    {
        $cd_categoria = $param[0];
        if ($cd_categoria != "") {
            $this->CategoriaFuncionario->cd_categoria = $cd_categoria;
            $this->CategoriaFuncionario->enable();
            $this->redirectUrl();
            exit;
        } else {
            echo 'É necessário um código';
            $this->redirectUrl();
            exit;
        }
    }
}
