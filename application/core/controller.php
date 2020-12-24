<?php

/* ****************************
	Базовый класс контроллера.
	От него будут наследоватся
	все созданные контроллеры 
   ************************* */

class Controller {
	
	// тут будет хранится объект соединения БД
	public $db  = null;
	
	// тут будет хранится модель
	public $model = null;
	
	// б.к.
	public function __construct() {
		$this->createDatabaseConn();
		$this->loadModel();
	}
	
	// создание соединения
	private function createDatabaseConn() {
		# проверяем наличие баззы данных 
		if( !file_exists(APP . "db/studentTable.db") ){
			# если БД отсутсвует
			$this->createNewDateBaseStudentList();
			
			//ini_set('max_execution_time', 900);	// Временно разрешаем допустимую длительность времени скрипта
			//$this->fillNewDateBase(500);
			//ini_set('max_execution_time', 30);	// Возвращаем старое значение 
		}
		$this->db = new SQLite3( APP . "db/studentTable.db");
	}
	
	// загрузка модели
	public function loadModel() {
		require APP . 'model/modelDb.php';		// загружаем функции модели для их использования (?)
		$this->model = new ModelDb($this->db);
		//var_dump($this->model);
	}		

	// Создание базы данных при отсутствии базы данных
	private function createNewDateBaseStudentList() {

		$db = new SQLite3( APP . "db/studentTable.db");

		$command = 'CREATE TABLE "userInfo" (
			"id"	INTEGER,
			"name"	TEXT NOT NULL,
			"lastname"	TEXT NOT NULL,
			"dateBirthday"	TEXT,
			"male"	TEXT NOT NULL,
			"city"	TEXT,
			"email"	TEXT UNIQUE,
			PRIMARY KEY("id" AUTOINCREMENT)
		)';
		$resultSQLite3 = $db->query( $command );

		$command = 'CREATE TABLE "exam" (
			"id"	INTEGER UNIQUE,
			"score"	INTEGER,
			PRIMARY KEY("id"),
			FOREIGN KEY("id") REFERENCES "userInfo"("id")
		)';
		$resultSQLite3 = $db->query( $command );

		$command = 'CREATE TABLE "studentGroup" (
			"id"	INTEGER UNIQUE,
			"numGroup"	TEXT NOT NULL,
			FOREIGN KEY("id") REFERENCES "userInfo"("id"),
			PRIMARY KEY("id")
		)';
		$resultSQLite3 = $db->query( $command );
		
		$command = 'CREATE TABLE "userPassword" (
			"id"	INTEGER UNIQUE,
			"hash"	TEXT NOT NULL,
			"salt"	TEXT NOT NULL,
			FOREIGN KEY("id") REFERENCES "userInfo"("id"),
			PRIMARY KEY("id")
		)';
		$resultSQLite3 = $db->query( $command );

		$db->close();
	}

	// Функция  заполняет новый массив случайными данными
	// Входной аргумент - сколько записей надо добавить в тольк-что созданнуб таблицу 
	private function fillNewDateBase( $numNewWrites ) {
		$arrayGroups = ['ЭЭ-01-15','ЭТ-41-11','ИТ-10-13','АП-01-12','РР-55-10','ПК-45-16'];
		$arrayLastName = ['Иванов','Петров','Сидоров','Косыгин','Романов','Семенов','Казаков','Малышкин','Белов','Морозов','Босяков','Беляков'];
		$arrayNameMale = ['Иван','Никита','Роман','Алексей','Александр','Сергей','Игорь','Петр','Владимир','Константин'];
		$arrayNameFemale = ['Анастасия','Анна','Мария','Татьяна','Полина','Раиса','Людмила','Ольга','Ирина','Екатерина'];
		$arrayCity = ['Чебоксары','Москва','Санкт-Петербург','Казань','Ярославль','Владивосток','Сочи','Анапа','Таганрог'];
		$arrayMale = ['Male','Female'];
		$arrayEmail = ['pro','gam','ap','ter','a','sun','_','pop','_','wrap','ny','cat','nerd','666','123','lucky'];
		$arrayEmailServer = ['gmail.com','yandex.ru','mail.ru','rambler.ru','yahoo.com'];

		$db = new SQLite3( APP . "db/studentTable.db");

		for($j=0;$j<$numNewWrites;$j++){
			// Генерируем случайный пол студента
			$randMale = $arrayMale[array_rand($arrayMale)];
			// Генерируем случайное имя в зависимости от пола
			if($randMale == 'Male'){
				$randName = $arrayNameMale[array_rand($arrayNameMale)];
				$randLastName = $arrayLastName[array_rand($arrayLastName)];
			}
			else{
				$randName = $arrayNameFemale[array_rand($arrayNameFemale)];
				$randLastName = $arrayLastName[array_rand($arrayLastName)].'а';
			}
			// Генерируем случайную дату в промежутке  между 1 января 1990 и 1 января 2000
			$randBirthday = $randDate = date( "Y-m-d", rand(631141200,946674000) ); 
			// Генерируем случайный город
			$randCity = $arrayCity[array_rand($arrayCity)];
			// Генерируем случайный почтовый ящик
			$count = rand(3,8);
			$randEmail = '';
			for($i=0;$i<$count;$i++){
				$randEmail .= $arrayEmail[array_rand($arrayEmail)];
			}
			$randEmail .= '@'.$arrayEmailServer[array_rand($arrayEmailServer)];
			// Заполняем таблицу со списком студентов
			$command = "INSERT INTO userInfo(name,
										lastname,
										dateBirthday,
										male,
										city,
										email
						)
						VALUES('$randName',
								'$randLastName',
								'$randBirthday',
								'$randMale',
								'$randCity',
								'$randEmail')";						
			$db->query( $command );
			// Заполняем таблицу со списком баллов
			$randScore = rand(100,300);
			$command = "INSERT INTO exam(score)
						VALUES($randScore)";
			$db->query( $command );
			// Заполняем таблицу со списком состава групп
			$randGroup = $arrayGroups[array_rand($arrayGroups)];
			$command = "INSERT INTO studentGroup(numGroup)
						VALUES('$randGroup')";
			$db->query( $command );
			// Создаем для пользователя хэш и пароль
			
			$salt = '';						// переменная для соли
			$password = 'password';			// задаем стандартный пароль для всех
			$length = rand(5,10); 			// длина соли (от 5 до 10 сомволов)
			for($i=0; $i<$length; $i++) {
				$salt .= chr(rand(97,126)); // символ из ASCII-table
			}
			$hash = password_hash( ($password.$salt),PASSWORD_DEFAULT);
			$command = "INSERT INTO userPassword(hash,
												salt)
						VALUES(	'$hash',
								'$salt')";
			$db->query( $command );
			
		}
		$db->close();		
	}
}	
?>