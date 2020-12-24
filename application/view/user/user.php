<div class="container-fluid">
    <div class="row mt-3"> 
        <div class="col-2">
            <?php if($this->userData['male']=='Male'): ?> 
            <img src=<?="..\application\img\\elearning\png\\006-online-learning.png";?> class="img-thumbnail"> 
            <?php else: ?>
            <img src=<?="..\application\img\\elearning\png\\040-online-learning.png";?> class="img-thumbnail">  
            <?php endif; ?> 
        </div>
        <div class="col-10">
            <form method="POST" action="?c=User&act=pressButtons">
                <div class="form-group row">
                    <label for="id" class="col-sm-2 col-form-label">Индентификатор</label>
                    <div class="col-sm-3">
                        <input type="text" readonly class="form-control" id="id" name="id" value=<?=$this->userData['id']?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lastname" class="col-sm-2 col-form-label">Фамилия</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="lastname" name="lastname" value=<?=$this->userData['lastname']?> <?=$this->readonlyAtrr?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Имя</label>
                    <div class="col-sm-3">
                        <input type="text" if="name" class="form-control" name="name" value=<?=$this->userData['name']?> <?=$this->readonlyAtrr?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateBirthday" class="col-sm-2 col-form-label">Дата Рождения</label>
                    <div class="col-sm-3">
                        <input type="date" id="dateBirthday" class="form-control" name="dateBirthday" value=<?=$this->userData['dateBirthday']?> <?=$this->readonlyAtrr?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label" >Пол студента</label>
                    <div class="col-sm-3"> 
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="male" id="male" value="Male"
                        <?php if($this->userData['male']=='Male'): ?>
                        checked
                        <?php endif; ?>
                        <?=$this->readonlyAtrr?>
                        >
                        <label class="form-check-label" for="male">
                            Мужчина
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="male" id="female" value="Female"
                        <?php if($this->userData['male']=='Female'): ?>
                        checked
                        <?php endif; ?>
                        <?=$this->readonlyAtrr?>
                        >
                        <label class="form-check-label" for="female">
                            Женщина
                        </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="score" class="col-sm-2 col-form-label">Экзаменационные баллы</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="score" id="score" value=<?=$this->userData['score']?> <?=$this->readonlyAtrr?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="numGroup" class="col-sm-2 col-form-label">Группа</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="numGroup" id="numGroup" value=<?=$this->userData['numGroup']?> <?=$this->readonlyAtrr?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">email</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="email" id="email" value=<?=$this->userData['email']?> <?=$this->readonlyAtrr?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="city" class="col-sm-2 col-form-label">Город</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="city" id="city" value=<?=$this->userData['city']?> <?=$this->readonlyAtrr?>>
                    </div>
                </div>
                <?php if($this->checkCokieIdBool): ?>
                <button type="submit" class="btn btn-outline-success" name="userSave">Сохранить</button>
                <button type="submit" class="btn btn-outline-danger"  name="userExit">Выход</button>
                <?php endif; ?>
                <?php if($this->errorData == 1): ?>
                <small class="form-text alert alert-danger col-sm-5">Некорректно введены данные.<br>Попробуйте еще раз.</small>
                <?php elseif($this->errorData == 2): ?>
                <small class="form-text alert alert-success col-sm-5">Данные успешно сохранены.</small>
                <?php endif; ?>
            </form>           
        </div>
    </div>
</div>
