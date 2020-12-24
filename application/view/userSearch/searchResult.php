<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" width='5%'><a class="t-col-href">#</a></th>
      <th scope="col" width='95%'><a class="t-col-href">Совпадения</a></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($studentArray as $key=>$value):?>
    <tr>
      <td><strong><?=++$countResults?></strong></td>
      <td>
        <?php foreach($value as $key=>$data):?>
          <strong><?=$key?></strong> --> <em><?=$data?></em><br>
        <?php endforeach; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
