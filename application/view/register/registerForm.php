<div class="container-fluid">
    <div class="row mt-3"> 
        <div class="col-2">
            <img src=<?="..\application\img\\elearning\png\\006-online-learning.png";?> class="img-thumbnail">    
        </div>
        <div class="col-10">
            <form method="POST" action="?c=Register&act=addNewUser">
                <div class="form-group row">
                    <label for="lastname" class="col-sm-2 col-form-label">Фамилия</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control <?php if(array_key_exists("lastname",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Имя</label>
                    <div class="col-sm-3">
                        <input type="text" if="name" class="form-control <?php if(array_key_exists("name",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateBirthday" class="col-sm-2 col-form-label">Дата Рождения (ГГГГ-ММ-ДД)</label>
                    <div class="col-sm-3">
                        <input type="date" id="dateBirthday" class="form-control <?php if(array_key_exists("dateBirthday",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" name="dateBirthday">
                    </div>
                </div>
                <!-- <fieldset class="form-group mb-0"> -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Пол студента</label>
                    <div class="col-sm-3"> 
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="male" id="male" value="Male" checked>
                        <label class="form-check-label" for="male">
                            Мужчина
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="male" id="female" value="Female">
                        <label class="form-check-label" for="female">
                            Женщина
                        </label>
                        </div>
                    </div>
                </div>
                <!-- </fieldset> -->
                <div class="form-group row">
                    <label for="score" class="col-sm-2 col-form-label">Экзаменационные баллы</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control <?php if(array_key_exists("score",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="3" name="score" id="score">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="numGroup" class="col-sm-2 col-form-label">Группа</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control <?php if(array_key_exists("numGroup",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" name="numGroup" id="numGroup">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">Город</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control <?php if(array_key_exists("city",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" name="city" id="city">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">email</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control <?php if(array_key_exists("email",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" name="email" id="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control <?php if(array_key_exists("password",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" name="password" id="password">
                    </div>
                    <label for="password2" class="col-sm-2 col-form-label">Повторите пароль</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control <?php if(array_key_exists("password2",$this->emptyStr)): ?>border-danger<?php endif; ?>" maxlength="50" name="password2" id="password2">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary" name="userNew" value="true">Зарегистрироваться</button>
                
                <?php if(count((array)$this->resultMsg) != 0): ?>
                <small class="form-text alert alert-secondary col-sm-5"><?=$this->resultMsg?></small>
                <?php endif; ?>
            </form>           
        </div>
    </div>
</div>