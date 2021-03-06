<?php
	/* *************************************
		обьект данного класса является точкой 
		входа приложения. Своеобразный "Роутер", 
		который будет направлять пользователя 
		на нужную страницу
	 ************************************* */

	class Router {
		
		// тут будет хранится controller который надо вызвать; s
		public $url_controller = null;
		
		//тут будет хранится action который надо выполнить; 
		public $url_action = null;
		
		// тут будет хранится параметры
		//public $params = null;
		public $params = [];

		// конструктор будет передавать управление соответствующему контроллеру
		public function __construct() {		
			
			// "парсим" УРЛ
			$this->parseUrl(); 	
			
			// если никакой контролер не передан то переходим на Главную
			// *на пустоту проверяет метод parseUrl();
			if(!isset($this->url_controller)) { 
				require APP . 'controller/home.php';
				$home = new Home();
				$home->index();
			}
			// если контроллер передан и он у нас физически существует, то
			else if(file_exists(APP . 'controller/' . $this->url_controller .'.php')){
				// подключаем файл класса
				require_once APP . 'controller/' . $this->url_controller . '.php';
				
				// создаём новый обьект контроллера
				$this->url_controller = new $this->url_controller();	
				
				// проверяем есть ли у него такой метод(экшн)
				// если есть, вызываем его
				if(method_exists($this->url_controller, $this->url_action)) {
					// есть параметры
					if(isset($this->params)) {
						$this->url_controller->{$this->url_action}($this->params);						
					} 
					// нету параметров
					else $this->url_controller->{$this->url_action}();
				}
				
				// иначе вызываем базовый метод(экшн) контроллера
				else {
					$this->url_controller->index();
				}
			}
			else {
				echo '<h2>Данная страница не существует!</h2>';
			}				
		}
		
		// просто берёт параметры с УРЛ 
		// и записывает их в соостветствующие переменные
		private function parseUrl() {
			
			// Контроллер. Если установлен и не пустой
			if(isset($_GET['c']) && !empty($_GET['c'])) 
				$this->url_controller = htmlspecialchars($_GET['c']);
				
			// Экшн. Аналогично для экшн	
			if(isset($_GET['act']) && !empty($_GET['act']))
				$this->url_action = htmlspecialchars($_GET['act']);	
			
			// Параметры. Аналогично
			//if(isset($_GET['p']) && !empty($_GET['p']))
			//	$this->params = htmlspecialchars($_GET['p']);
			
			if (count($_GET) > 2){
				foreach ($_GET as $key => $value) {
					if($key=='c' || $key=='act') continue;
					$this->params[$key] = htmlspecialchars($value);
				}
				//$this->paramObject = (object)($this->params);
			}
			/*
			if(!empty($_GET['p'])){
				foreach($_GET as $key=>$value){
					$this->params[$key] = htmlspecialchars($value);
				}
			}
			*/		
		}
	}
?>