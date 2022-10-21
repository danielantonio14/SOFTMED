<div class="tab-pane fade container" id="incidencia" role="tabpanel" aria-labelledby="menu-insidencia">
  <div class="card border-0">
    <div class="card-header bg-1">
      <div class=" h4 card-title text-white">Insidências e Prevalências</div>

      <div class="p-2 float-end alert alert-white">
        <?php
        if ($funcionario->getTipoFuncionario() == "Administrador") { ?>
          <a href="./relatorios/pdfCasosIP.php?view_pdf=casosIP" class="btn btn-success btn-sm" target="_blank">
            <i class=" bi bi-file-earmark-pdf"></i> PDF
          </a>
        <?php } ?>

      </div>
    </div>

    <!-- CASOS DE DADOS TABELADOS -->
    <div class="container bg-grey border-0" id="view-casos-tab">
      <div class="alert alert-light">
        <h4 class="card-title text-muted">Tabela de insidências e prevalências a niveis municipais</h4>
        <table class="table table-sm table-inverse table-hover  border-0">
          <thead class="thead-inverse border-0 bg-success text-white">
            <tr>

              <th>Município</th>
              <th>Distrito</th>
              <th>Ativos</th>
              <th>Riscos</th>
              <th>Incidências</th>
              <th>Prevalências</th>
            </tr>
          </thead>
          <tbody class="row-case-2 text-dark bg-light">
            <?= $casos->piDistrito($BD) ?>
          </tbody>
        </table>
      </div>
      <div class="row">
        <!-- CASO DE DADOS GRAFICACADOS -->
        <div class="col-12 p-5  d-flex justify-content-center align-content-center align-content-center" id="view-ip-chart">
          <div class="text-danger" id="ip_graficos"></div>
        </div>
        <div class="col-6 ">
          <div class="alert back text-danger alert-light shadow-sm">
            <div class="card-title">
              <b>Insidências</b>
            </div>
            <div class="card-title" id="II-data">
            </div>
          </div>
        </div>
        <div class="col-6 ">
          <div class="alert back text-primary alert-light shadow-sm">
            <dv class="card-title">
              <b>Prevalências</b>
            </dv>
            <div class="card-title" id="PI-data">
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>