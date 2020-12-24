<?php

class SearchUser extends Controller {

    public function index(){			
        // подгружаем Виды для заданого Экшн
        require APP . 'view/template/header.php';
        require APP . 'view/userSearch/searchResult.php';
        require APP . 'view/template/footer.php';
    }

    public function activateSearch($param = []){
        
        $studentArray = $this->model->getResultSearch($param['search']);
        
        require APP . 'view/template/header.php';
        require APP . 'view/userSearch/searchResult.php';
        require APP . 'view/template/footer.php';
        
        /*
        echo "<br>";
        foreach ($result as $value) {
            var_dump($value);
            echo "<br>";
        }
        */
    }
}


?>