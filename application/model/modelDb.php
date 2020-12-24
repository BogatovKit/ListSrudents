<?php

class ModelDb {

    // Конструктор
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    // Получить количество записей относительно главной таблицы (userInfo)
    public function getCountWrites(){
        $command = 'SELECT count(*)
                    FROM userInfo';
        
        $result = $this->db->query($command);
        $result = $result->fetchArray(SQLITE3_NUM);
        return $result[0];
    }

    // Выдать конкретный кусок списка для страницы "Список студентов"
    // $start - начальный элемент списка
    // $amount - длина списка
    // $orderBy - условие сортировки перед выборкой 
    public function getListStudentForHtmlPage($start,$amount,$orderBy='userInfo.id', $sort='asc'){
        $command = "SELECT userInfo.id,userInfo.lastname,userInfo.name,userInfo.dateBirthday,studentGroup.numGroup,exam.score
                    FROM userInfo LEFT JOIN studentGroup
                    ON userInfo.id=studentGroup.id
                    LEFT JOIN exam
					on userInfo.id=exam.id
                    ORDER BY $orderBy $sort
                    LIMIT $amount
                    OFFSET $start";
        
        $result = $this->db->query($command);
        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            $studentArray[] = $row;
        }
        return $studentArray;
    }

    // Получить информацию о пользователе с конкретным email-ящиком
    // $email - почтовый ящик по которому будет произведен поиск
    public function getUserInfoToEmail($email='')
    {
        $command = "SELECT *
                    FROM userInfo INNER JOIN studentGroup
                    ON userInfo.id=studentGroup.id
                    INNER JOIN exam
                    ON userInfo.id=exam.id
                    WHERE userInfo.email='$email'";

        $result = $this->db->query($command);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $studentArray[] = $row;
        }
        return $studentArray[0];
    }

    // Получить информацию о пользователе по конкретному ID
    // $id - индивидуальный номер пользователя по которому будет произведен поиск
    public function getUserInfoToId($id=0)
    {
        $command = "SELECT *
                    FROM userInfo INNER JOIN studentGroup
                    ON userInfo.id=studentGroup.id
                    INNER JOIN exam
                    ON userInfo.id=exam.id
                    WHERE userInfo.id=$id";

        $result = $this->db->query($command);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $studentArray[] = $row;
        }
        return $studentArray[0];
    }

    // Обновить запись в базе данных 
    // $data - массив данных в котором должны хранится ключи/значения для обновления БД
    public function updateUserWrite( $data=[] )
    {
        $command = "UPDATE userInfo
                    SET name = '{$data['name']}',
                        lastname = '{$data['lastname']}',
                        dateBirthday = '{$data['dateBirthday']}',
                        male = '{$data['male']}',
                        city = '{$data['city']}',
                        email = '{$data['email']}'
                    WHERE id = {$data['id']}
        ";
        $result = $this->db->query($command);

        $command = "UPDATE exam
                    SET score = {$data['score']}
                    WHERE id = {$data['id']}
        ";
        $result = $this->db->query($command);
        
        $command = "UPDATE studentGroup
                    SET numGroup = '{$data['numGroup']}'
                    WHERE id = {$data['id']}
        ";
        $result = $this->db->query($command);

        return $result;
    }

    // Добавить запись в базе данных 
    // $data - массив данных в котором должны хранится ключи/значения для записи в БД
    public function insertUserWrite( $data=[] )
    {
        // Добавляем запись в таблицу с личной информацией о студентах
		$command = "INSERT INTO userInfo(name,
                        lastname,
                        dateBirthday,
                        male,
                        city,
                        email
                    )
                    VALUES('{$data['name']}',
                        '{$data['lastname']}',
                        '{$data['dateBirthday']}',
                        '{$data['male']}',
                        '{$data['city']}',
                        '{$data['email']}')";						
        $result = $this->db->query($command);
        if($result==false) return $result;

        // Добавляем запись в таблицу с баллами
        $command = "INSERT INTO exam(score)
                    VALUES({$data['score']})";
        $result = $this->db->query($command);
        if($result==false) return $result;

        // Добавляем запись в таблицу со списком состава групп
        $command = "INSERT INTO studentGroup(numGroup)
                     VALUES('{$data['numGroup']}')";
        $result = $this->db->query($command);
        if($result==false) return $result;

        // Создаем для пользователя хэш и пароль
			
		$salt = '';						// переменная для соли
		$password = $data['password'];	// 
		$length = rand(5,10); 			// длина соли (от 5 до 10 сомволов)
		for($i=0; $i<$length; $i++) {
			$salt .= chr(rand(97,126)); // символ из ASCII-table
		}
		$hash = password_hash( ($password.$salt),PASSWORD_DEFAULT);
		$command = "INSERT INTO userPassword(hash,
											salt)
					VALUES(	'$hash',
							'$salt')";
        $result = $this->db->query($command);
        if($result==false) return $result;
        
        return $result;
    }

    // Получить хэш/соль и email пользователя
    // $email - почтовый ящик по которому будет получен хэш и соль
    public function getValidateData ($email='')
    {
        $command = "SELECT userInfo.email,userPassword.hash,userPassword.salt
                    FROM userInfo INNER JOIN userPassword
                    ON userInfo.id=userPassword.id
                    WHERE userInfo.email='$email'";

        $result = $this->db->query($command);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $studentArray[] = $row;
        }
        return $studentArray[0];
    }

    // Выдать данные конкретных пользователей по результатам совпадения поиска 
     // $searchExp - условие поиска по БД
    public function getResultSearch($searchExp)
    {
        $searchId = $this->getIdOverlapSearch($searchExp);
        $studentArray = $this->getUserInfoSearch($searchId);

        return $studentArray;
    }

    // Получить все уникальные записи пользователей, которые соответсвуют запросу поиска 
    // $searchExp - условие поиска по БД
    private function getIdOverlapSearch($searchExp)
    {
        $modifSearchExp = '';                   // Переменная для преобразования условия в поиске
        $searchExp = trim($searchExp);          // Удаляем пробелы в начале и конце строки
        $searchExp = explode(' ',$searchExp);   // Разделяем на части поисковый запрос по наличию пробела
        // Создаем запрос в БД чтобы выполнить поиск
        for( $i=0; $i<count($searchExp); $i++ )
        {
            $modifSearchExp .= "info LIKE '%$searchExp[$i]%'";
            if($i<count($searchExp)-1) $modifSearchExp .= " AND ";
        }
        
        $command = "SELECT DISTINCT userInfo.id, (name || ' ' || lastname || ' ' || dateBirthday || ' ' || male || ' ' || city || ' ' || email || ' ' || numGroup || ' ' || score || ' ' ) as info 
                    FROM userInfo inner join studentGroup
                    on userInfo.id=studentGroup.id
                    INNER JOIN exam
                    ON userInfo.id=exam.id
                    WHERE $modifSearchExp
                    ";

        $result = $this->db->query($command);
        while ($row = $result->fetchArray(/*SQLITE3_ASSOC*/SQLITE3_NUM)) {
            $studentArray[] = $row;
        }
        
        return $studentArray;
    }

    // Получить данные конкретных пользователей по результатам совпадения поиска 
    // $id - массив идентификаторов, который были получены после поиска по базе данных
    private function getUserInfoSearch($id=[])
    {
        foreach($id as $value)
        {
            $resultSearch[] = $this->getUserInfoToId($value[0]);
        }
        
        return $resultSearch;
    }

}

?>