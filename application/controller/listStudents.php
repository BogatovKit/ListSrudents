<?php

	/* ***************************
	Контроллер станицы ListStudents
	**************************** */
	class TableColumn {
		public $condition;
		public $reference;
		public $icon;

		public function __construct(){
			$this->condition = '';
			$this->reference = '';
			$this->icon = '';
		}
	}

	class ListStudents extends Controller {

		const SIZE_PART_TABLE = 25;	// константа задает количество записей на одну страницу 
		public $max_page = 0;
		private $tableColumnArray = [];

		// Начальная функция страницы со списком студентов
		public function index() {			
			// подгружаем Виды для заданого Экшн
			//$studentArray = $this->model->getAllInfoStudentsForHtmlPage();
			$this->viewPage();			
		}	

		// Основная функция для отрисовки страницы. Принимает на фход массив параметров и отбражает в записимости от задачи
		// Ожидаемые параметры входного массива: 
		//						'p' => страница таблицы, которую выведет на экран 
		//						'orderBy' => указываем, по какому условию сортируем запрос перед выводом. Условие соответсвует названию столбца из 
		//									запроса в функции модели getListStudentForHtmlPage.
		//						'asc' => указываем как сортируем, возрастание/убывание
		// Внутри вызывается функция для работы с моделью, которая формирует запрос к БД и возвращает массив данных для отображения на странице
		public function viewPage( $param = [] ){

			//$studentArray = $this->viewPagination($page['p'], $page['orderBy']);
			if(!array_key_exists('p',$param) || is_null($param['p']))				$param['p'] = 1;
			if(!array_key_exists('orderBy',$param) || is_null($param['orderBy'])) 	$param['orderBy']='userInfo.id';
			if(!array_key_exists('asc',$param) || is_null($param['asc'])) 			$param['asc']='asc';			

			$this->solveMaxPage();
			if( $this->max_page < $param['p'] )	$param['p'] = $this->max_page;

			$studentArray = $this->viewPaginationTable(	$param['p'],
														$param['orderBy'],
														$param['asc'] );
														
			$this->updateTableColumn(	$param['orderBy'],
										$param['asc']);

			require APP . 'view/template/header.php';
            require APP . 'view/listStudents/listStudents.php';
            require APP . 'view/listStudents/listStudentsPagination.php';
			require APP . 'view/template/footer.php';	
		}

		public function viewSortTable( $param = [] )
		{
			$this->viewPage($param);
		}

		// Функция выполняет запрос к БД из модели и получает массив данных.
		private  function viewPaginationTable($page,$orderBy,$sort){
			return $this->model->getListStudentForHtmlPage( ($page-1)*self::SIZE_PART_TABLE, self::SIZE_PART_TABLE, $orderBy, $sort );
		}

		private function updateTableColumn($orderBy,$sort){
			$this->tableColumnArray = [
				'userInfo.id' => new TableColumn(),
				'userInfo.lastname' => new TableColumn(),
				'userInfo.name' => new TableColumn(),
				'userInfo.dateBirthday' => new TableColumn(),
				'studentGroup.numGroup' => new TableColumn(),
				'exam.score' => new TableColumn()
			];

			if(array_key_exists($orderBy,$this->tableColumnArray))
			{				
				$sort=='asc'? $this->tableColumnArray[$orderBy]->icon='up' : $this->tableColumnArray[$orderBy]->icon='down';

				$this->tableColumnArray[$orderBy]->condition = $sort=='asc'? 'desc' : 'asc';
			}

			foreach($this->tableColumnArray as $key => $value ){
				$this->tableColumnArray[$key]->reference = "?c=ListStudents&act=viewSortTable&orderBy=$key&asc={$this->tableColumnArray[$orderBy]->condition}";
			}
		}

		private function solveMaxPage(){
			$this->max_page = $this->model->getCountWrites();

			if(($this->max_page%self::SIZE_PART_TABLE)==0) $this->max_page = intdiv($this->max_page,self::SIZE_PART_TABLE);
			else $this->max_page = intdiv($this->max_page,self::SIZE_PART_TABLE)+1;
		}
	}		
?>