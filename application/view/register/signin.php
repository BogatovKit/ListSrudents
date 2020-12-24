<!--

<div class="container mt-4">
  <form action="" method="GET">
    <h1 class="h3 mb-3 font-weight-normal">Заполните данные для входа</h1>
    <label for="inputEmail" class="sr-only">Адрес почтового ящика</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Ваша почта" required autofocus name="userEmail" value="mail@mail.ru">
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Ваш пароль" required name="userPassword" value="12345">
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Запомнить меня
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="c" value="Register">Вход</button>
  </form>
</div>

-->
<form class="mx-auto mt-5" style="width: 20%;" method="POST" action="?c=Register&act=validateUser">
  <div class="form-group">
    <?php if($this->errorMsg == true): ?>
    <small class="form-text alert alert-danger">Неправильный пароль или Email. <br>Попробуйте еще раз.</small>
    <?php endif; ?>

    <label for="inputEmail">Email address</label>
    <input type="email" class="form-control" id="inputEmail" placeholder="Enter email" name="userEmail" 
    value=<?php if(isset($_COOKIE['userInfo']['email'])): ?> <?=$_COOKIE['userInfo']['email']?> <?php endif; ?>>
  </div>
  <div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="userPassword" value="youShallNotPass!">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="check" name="userCheckMe">
    <label class="form-check-label" for="check">Запомнить меня</label>
  </div>
  <button type="submit" class="btn btn-outline-success btn-block">Вход</button>
  <!--<button type="submit" class="btn btn-outline-primary btn-block">Регистрация</button>-->
  <div class="alert alert-light" role="alert">
  Если вы здесь впервые, можете <a href="?c=Register&act=registerNewUser" class="alert-link">зарегистрироваться</a>.
  </div>
</form>