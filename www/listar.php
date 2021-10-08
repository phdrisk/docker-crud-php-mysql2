<p class="text-center h2">LISTAGEM DE REGISTROS</p>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Sexo</th>
      <th scope="col">idade</th>
      <th scope="col">hobby</th>
      <th scope="col">Data Nascimento</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

   <?php 
  
   $tabela = json_decode($registros->getLista(false)->getResultado());
   foreach($tabela as $chave => $valor){
    echo "<tr><th scope='row'>{$valor->codigo}</th>";
    foreach($valor as $chaves => $valor2){
      if($chaves == "codigo")
        continue;
      echo "<td>{$valor2}</td>";
    }
    echo '<td><a href=?pag=alterarRegistro&codigo='.$valor->codigo.'><span class="glyphicon glyphicon-pencil"></span>Alterar</a></td>';
    echo "<td><a href=?pag=apagarRegistro&codigo=".$valor->codigo.
    " onclick=\"return confirm('Deseja Realmente Excluir?')\">Excluir</a></td>";
    echo "</tr>";

  }

  ?>
 </tbody>
</table>
