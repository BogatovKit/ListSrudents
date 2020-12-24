<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Icon fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- User CSS styles -->
    <link rel="stylesheet" href="..\application\css\my_styles.css">
    <title>Cписок студентов</title>
  </head>
  <body>
    <header class="border-bottom">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="?">
        <img src=<?="..\application\img\\elearning\svg\\027-global-education.svg";?> width="50" height="50" class="d-inline-block align-top" alt="">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"  aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="?">О проекте</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=ListStudents">Список студентов</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=Register&act=userProfile">Личный кабинет</a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="?" method="GET">
        <input type="hidden" name="c" value="SearchUser">
        <input type="hidden" name="act" value="activateSearch">
        <input class="form-control mr-sm-2" type="text" placeholder="Введите запрос" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
        </form>
    </div>
    </nav>
    </header>


    