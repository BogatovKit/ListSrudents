<?php

	/* ***************************
	Контроллер станицы User
	**************************** */
	
	class User extends Controller {
		
		public $userData = [];
		public $errorData = 0;
		public $readonlyAtrr = '';
		public $checkCokieIdBool = false;

		public function index() {
			// подгружаем Виды для заданого Экшн
			require APP . 'view/template/header.php';
			require APP . 'view/user/user.php';
			require APP . 'view/template/footer.php';
		}	

		public function getUserInfo($param = [])
		{
			//if(!$this->checkCokieId())	$param['idUser'] = $_COOKIE['userInfo']['id'];

			$this->checkCokieId($param['idUser']);
			
			$resultArray = $this->model->getUserInfoToId($param['idUser']);
			if(!is_null($resultArray)){
				foreach ($resultArray as $key => $value) {
					$this->userData[$key] = $value;
				}
			}
			else{
				$errorMsg = "Такой пользователь не существует.";
				header("Location: ?c=errorPage&act=viewErrorMsg&errorMsg=$errorMsg");				
				die(); //?
			}

			$this->index();
		}

		public function checkCokieId($id)
		{
			if($id != $_COOKIE['userInfo']['id']) $this->checkCokieIdBool = false;
			else $this->checkCokieIdBool = true;

			$this->checkCokieIdBool ? $this->readonlyAtrr = '' : $this->readonlyAtrr = 'disabled';

			return $this->checkCokieIdBool;
		}

		public function pressButtons() {

			if(array_key_exists('userSave',$_POST)){
				// Перезаписать информацию в БД
				// регулярка для проверки почтового ящика 
				$regexpEmail = '/[\w]+@[a-z]+[.][a-z]{1,6}/u';
				if( !preg_match($regexpEmail,$_POST['email']) || (int)($_POST['score'])>300 )
				{
					$this->errorData = 1;
				}
				elseif( $this->model->updateUserWrite($_POST) )
				{
					$this->errorData = 2;			
				}
				$this->getUserInfo( [ 'idUser' => $_POST['id'] ] );

			}
			elseif(array_key_exists('userExit',$_POST)){
				$userInfoCookie = $_COOKIE['userInfo'];
				foreach($userInfoCookie as $key => $value){
					setcookie("userInfo[$key]",null);
				}
				header("Location: ?c=Register");		
				die(); //?
			}
		}			
	}		
?>