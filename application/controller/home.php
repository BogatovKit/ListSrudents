<?php

	/* ***************************
	Контроллер станицы Home
	**************************** */
	
	class Home extends Controller {
		
		public function index() {
			
			// подгружаем Виды для заданого Экшн
			require APP . 'view/template/header.php';
			require APP . 'view/home/home.php';
			require APP . 'view/template/footer.php';
			
		}		
	}		
?>