<div class="tab-pane fade container" id="usuarios" role="tabpanel" aria-labelledby="menu-usuarios">
  <div class="card border-0">
    <div class="card-header bg-1">
      <h4 class="card-title text-white">Gerenciar funcionários</h4>

      <div class="row">
        <form class="d-flex float-end col-7">
          <input id="campo-pesquisar" class="form-control me-2 form-control-sm" type="search" placeholder="Pesquisar usuário" aria-label="Search">
        </form>
        <div class="col-4 float-end ms-2">
          <button type="button" class="btn btn-sm btn-success">
            <i class="bi bi-table"></i> todos
          </button>
          <a href="./relatorios/pdfFuncionarios.php?view_pdf=funcionarios" class="btn btn-success btn-sm" target="_black">
            <i class=" bi bi-file-earmark-pdf"></i> PDF
          </a>
          <a data-bs-toggle="modal" href="#modalNovoFuncionario" role=" button" class="btn btn-success btn-sm t">
            <i class="bi bi-person-plus"></i> novo
          </a>
        </div>
      </div>

    </div>
    <div class="card-body bg-white">
      <table class="table table-sm table-inverse table-hover  border-0 cor-2">
        <thead class="thead-inverse bg-success border-0 text-white">
          <tr>
            <th>#ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Categoria</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody id="data-view" class="bg-light text-dark">
          <?= $funcionario->index($BD) ?>
        </tbody>
      </table>
    </div>
    <?php require './assets/includes/modals/modalAddFoto.php'; ?>
  </div>
</div>
<br>