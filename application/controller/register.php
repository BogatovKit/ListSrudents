<?php

	/* ***************************
	Контроллер станицы Register
	**************************** */
	
	class Register extends Controller {
		
		public $errorEmail = true;
		public $errorMsg = false;
		public $resultMsg;
		public $emptyStr = [];

		// Подключаем представление для входа
		public function index() {			
			// подгружаем Виды для заданого Экшн
			require APP . 'view/template/header.php';
			require APP . 'view/register/signin.php';
			require APP . 'view/template/footer.php';
		}	

		// Подключаем представление для формы регистрации
		public function registerNewUser(){
			require APP . 'view/template/header.php';
			require APP . 'view/register/registerForm.php';
			require APP . 'view/template/footer.php';
		}
		
		// Проверяем куки пользователя и при необходимости переходим в личный кабинет
		public function userProfile(){
			$this->checkCookieUser();
			$this->index();
		}

		// Проверяем самые простые случаи ошибки при регистрации нового пользователя
		public function addNewUser(){	
					
			$regexpEmail = '/[\w]+@[a-z]+[.][a-z]{1,6}/u';

			foreach($_POST as $key=>$value)
			{
				if(mb_strlen($value)==0) $this->emptyStr[$key] = $value;
			}

			if( count($this->emptyStr)>0 ){
				$this->resultMsg = 'Введены не все данные';
			}
			elseif( !preg_match($regexpEmail,$_POST['email']) || (int)($_POST['score'])>300 || $_POST['password']==null ){				
				$this->resultMsg = 'Некорректно введены данные.<br>Попробуйте еще раз.';
				if( (int)($_POST['score'])>300 ) $this->resultMsg += '<br><em>Общее число экзаменационных баллов неверно.</em>';
				elseif( $_POST['password']==null ) $this->resultMsg += '<br><em>Строка для ввода пароля пустая.</em>';
				else $this->resultMsg += '<br><em>Неверный email.</em>';
			}
			elseif(substr_compare($_POST['password'],$_POST['password2'],0) != 0){
				$this->resultMsg = 'Пароли не совпадают.';
				$this->emptyStr['password'] = -1;
				$this->emptyStr['password2'] = -1;
			}
			elseif($this->model->insertUserWrite($_POST)){
				$this->resultMsg = 'Данные успешно сохранены.<br>Можете <a href="?c=Register" class="alert-link">вернуться назад</a> и войти в личный кабинет.';
			}
			else {
				$this->resultMsg = 'Ошибка записи в базу данных.';
			}		
			
			$this->registerNewUser();
		}

		// Проверить входные данные пользователя
		public function validateUser()		{			
			$paswordInfo = $this->model->getValidateData($_POST['userEmail']);
			$result = password_verify($_POST['userPassword'].$paswordInfo['salt'],$paswordInfo['hash']);
			if($result==true){
				$userInfo = $this->getUserInfoFromEmail($_POST['userEmail']);
				$idUser = $userInfo['id'];
				$this->saveCookieUser($userInfo, (array_key_exists('userCheckMe',$_POST)) );
				header("Location: ?c=User&act=getUserInfo&idUser=$idUser");				
				die(); //?
			}
			else{
				$this->errorMsg = true;
				$this->index();	
			}
		}

		// Запрашиваем с БД пользователя по eMail 
		private function getUserInfoFromEmail($email) {
			if(is_null($email)) return null;

			$resultArray = $this->model->getUserInfoToEmail($email);
			return $resultArray;
		}

		// Проверить куки юзера и выполнить автоматический вход [?]
		private function checkCookieUser() {
			if(!array_key_exists('userInfo',$_COOKIE)) return;

			$userInfoCookie= $_COOKIE['userInfo'];
			//if(!isset($_COOKIE['userInfo'])) return;

			//if($userInfoCookie['signIn']==self::MSG_FIND_USER){
			if(array_key_exists('id',$userInfoCookie)){
				$idUser = $userInfoCookie['id'];
				header("Location: ?c=User&act=getUserInfo&idUser=$idUser");				
				die(); //?
			}
		}

		// Записываем куки юзера для дальнейшего использования. Срок хранения куки 10 лет (без учета високосных годов)
		private function saveCookieUser($array, $shortSave) {
			//setcookie('userInfo',serialize($array),time()+60*60*24*365*10);
			
			if( $shortSave == true )
			{
				foreach($array as $key => $value){
					setcookie("userInfo[$key]",$value,time()+60*60*24*365*10);
				}
			}
			else
			{
				foreach($array as $key => $value){
					setcookie("userInfo[$key]",$value);
				}
			}

			
		}


	}		
?>