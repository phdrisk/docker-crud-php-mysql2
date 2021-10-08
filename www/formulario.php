<p class="text-center h2">FORMULÁRIO DE INCLUSÃO</p>
<div class="justify-content-center align-items-center row">
<div class="w-50 p-3" style="background-color: #eee;">

<form method="post" action="?pag=incluirRegistro" id="form">
  <input type="hidden"  name="inputCodigo" value="<?php echo ($registro->codigo ?: false); ?>">
  <div class="form-row">
    <div class="form-group col-md-6">

      <label for="inputNome">Nome</label>
      <input type="text" class="form-control" id="inputNome" name="inputNome" placeholder="Nome" value="<?php echo ($registro->nome ?: false); ?>" >
    </div>
    <div class="form-group col-md-4">
      <label for="inputSexo">Sexo</label>
      <select id="inputSexo" name="inputSexo" class="form-control">
        <option value="M" <?php echo ($registro->sexo =="M" ? "selected=": ''); ?>>Masculino</option>
        <option value="F" <?php echo ($registro->sexo =="F" ? "selected": ''); ?>>Feminino</option>
        
      </select>
    </div>
    
  </div> 
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNome">Hobby</label>
      <input type="text" class="form-control" id="inputHobby" name="inputHobby" placeholder="Hobby" value="<?php echo ($registro->hobby ?: false); ?>">
    </div>
    <div class="form-group col-md-4" data-date-formart="dd/mm/yyyy">
      <label for="inputNome">Data Nascimento</label>
      <input type="date" class="form-control" id="inputDataNascimento" name="inputDataNascimento" placeholder="DataNascimento" value="<?php echo ($registro->datanascimento ?: false); ?>">
      
    </div>
    
  </div>

  <button type="button" class="btn btn-primary" id="botaoSubmit">Enviar</button>
</form>
</div>
</div>
