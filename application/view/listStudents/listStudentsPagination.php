<form class="form-inline mx-auto py-3" style="width: 15%;" action="?" method="GET">

<input type="hidden" name="c" value="ListStudents"> <!-- Напрямую задаем команду для передачи аргумента через GET -->
<input type="hidden" name="act" value="viewPage"> <!-- Напрямую задаем действие для передачи аргумента через GET -->

<div class="input-group">
  <input class="form-control mr-sm-0 text-center col-md-4 border border-secondary" type="text" name="p" value="<?=$param['p']?>">
  <div class="input-group-append">
    <span class="input-group-text bg-transparent text-dark">из <?=$this->max_page?> стр.</span>
  </div>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Перейти</button>
  </div>
</div>


</form>
