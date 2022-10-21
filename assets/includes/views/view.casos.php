<div class="tab-pane fade container  active show" id="casos" role="tabpanel" aria-labelledby="menu-casos">
  <div class="card">
    <div class="card-header bg-1">
      <div class=" h4 card-title text-white">Gerenciamento de casos</div>
      <div class="p-2 float-end">

        <button type="button" title="<?= $funcionario->getIdLocalidade() ?>" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <i class="bi-receipt"></i> Relatar
        </button>

        <button type="button" class="btn btn-success btn-sm" id="btn-view-tab">
          <i class=" bi bi-table"></i> lista
        </button>
        <?php
        if ($funcionario->getTipoFuncionario() == "Administrador") { ?>
          <a href="./relatorios/pdfCasos.php?view_pdf=casos" class="btn btn-success btn-sm" target="_blank">
            <i class=" bi bi-file-earmark-pdf"></i> PDF
          </a>

          <a href="#" class="btn btn-success btn-sm btn-view-mortalidade">
            <i class="bi bi-person-x-fill"></i> mortalidades
          </a>
        <?php } ?>
        <a data-bs-toggle="modal" href="#modalNovoCaso" role="button" class="btn btn-success btn-sm t">
          <i class="bi bi-bug"></i> novo
        </a>
      </div>
    </div>

    <!-- CASOS DE DADOS TABELADOS -->
    <div class="card-body" id="view-casos-tab">
      <h4 class="card-title text-muted">Casos tabelados</h4>
      <!-- <form class="d-flex float-end col-7">
        <input id="campo-pesquisar-paciente" class="form-control form-control-lg" type="search" placeholder="Pesquisar paciente" aria-label="Search">
      </form> -->
      <br><br>
      <table class="table table-sm table-inverse table-hover  border-0 mt-4">
        <thead class="thead-inverse border-0 bg-success text-white">
          <tr>
            <th>Nome</th>
            <th>Fase</th>
            <th>Idade</th>
            <th>Genero</th>
            <th>Estado</th>
            <th>Morada</th>
            <th>Data</th>
            <th>Alterar</th>
          </tr>
        </thead>
        <tbody class="row-case text-dark bg-light">
        <tbody class="row-case-2 text-dark bg-light">
        </tbody>
      </table>
    </div>
    <!-- CASOS DE DADOS TABELADOS DE MORTE -->

    <div class="card-body" id="view-casos-morte">
      <h4 class="card-title text-muted">Casos de Mortes</h4>
      <table class="table table-lg table-center text-center table-inverse table-hover  border-0">
        <thead class="thead-inverse border-0 bg-success text-white">
          <tr>

            <th>Município</th>
            <th>Distrito</th>
            <th>N. Mortes</th>
            <!--  <th>Data</th> -->
            <!-- <th>Hora</th> -->
          </tr>
        </thead>
        <tbody class="row-cases text-dark bg-light">
          <?= $casos->casosMortes($BD) ?>
        </tbody>
      </table>
    </div>

    <!-- CASO DE DADOS GRAFICACADOS -->

    <div class="" id="view-casos-chart bg-light">
      <div class="alertlight" id="casos_graficos"></div>
    </div>
  </div>
</div>