
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" width='10%'><a class="t-col-href text-center" href="<?=$this->tableColumnArray['userInfo.id']->reference?>">#<i class="fas fa-caret-<?=$this->tableColumnArray['userInfo.id']->icon?>"></i></a></th>
      <th scope="col" width='18%'><a class="t-col-href text-center" href="<?=$this->tableColumnArray['userInfo.lastname']->reference?>">Фамилия<i class="fas fa-caret-<?=$this->tableColumnArray['userInfo.lastname']->icon?>"></i></a></th>
      <th scope="col" width='18%'><a class="t-col-href text-center" href="<?=$this->tableColumnArray['userInfo.name']->reference?>">Имя<i class="fas fa-caret-<?=$this->tableColumnArray['userInfo.name']->icon?>"></i></a></th>
      <th scope="col" width='18%'><a class="t-col-href text-center" href="<?=$this->tableColumnArray['userInfo.dateBirthday']->reference?>">Дата рождения<i class="fas fa-caret-<?=$this->tableColumnArray['userInfo.dateBirthday']->icon?>"></i></a></th>
      <th scope="col" width='18%'><a class="t-col-href text-center" href="<?=$this->tableColumnArray['studentGroup.numGroup']->reference?>">№ группы<i class="fas fa-caret-<?=$this->tableColumnArray['studentGroup.numGroup']->icon?>"></i></a></th>
      <th scope="col" width='18%'><a class="t-col-href text-center" href="<?=$this->tableColumnArray['exam.score']->reference?>">Кол-во баллов<i class="fas fa-caret-<?=$this->tableColumnArray['exam.score']->icon?>"></i></a></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($studentArray as $key=>$value):?>
    <tr>
      <td class="text-center font-weight-bold"><a class="t-col-href text-decoration-none" href="?c=User&act=getUserInfo&idUser=<?=$value[0]?>"><u><?=$value[0]?></u></a></td>
      <td class="text-center"><?=$value[1]?></td>
      <td class="text-center"><?=$value[2]?></td>
      <td class="text-center"><?=$value[3]?></td>
      <td class="text-center"><?=$value[4]?></td>
      <td class="text-center"><?=$value[5]?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
