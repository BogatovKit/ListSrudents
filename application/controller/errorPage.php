<?php

	class ErrorPage extends Controller {
		public $errorMsg = '';

		public function index() {			
			// подгружаем Виды для заданого Экшн
			require APP . 'view/template/header.php';
			require APP . 'view/errorPage/errorPage.php';
			require APP . 'view/template/footer.php';
			
		}	
		
		public function viewErrorMsg ( $param =[] ){

			if(array_key_exists('errorMsg',$param) || !is_null($param['errorMsg'])){
				$this->errorMsg = $param['errorMsg'];			
			}	
			$this->index();
		}
	}		
?>