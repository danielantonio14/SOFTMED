<div class="tab-pane fade" id="prevalencia" role="tabpanel" aria-labelledby="menu-prevalencia">
  <div class="card">
    <div class="card-header bg-1">
      <h4 class="card-title text-white">Gerar Relatórios</h4>
    </div>
    <div class="card-body bg-grey">
      <div class="alert bg-grey">
        <br>
        <b>casos</b>
        <br><br>
        <a href="./relatorios/pdfCasosRiscos.php?tipo_casos=1&tipo=Normais" target="_black" class="btn btn-sm btn-success">Normais</a>
        <a href="./relatorios/pdfCasosRiscos.php?tipo_casos=2&tipo=Riscos" target="_black" class="btn btn-sm btn-success">Riscos</a>
        <a href="./relatorios/pdfCasosRiscos.php?tipo_casos=3&tipo=Mortos" target="_black" class="btn btn-sm btn-success">Mortos</a>
        <a href="./relatorios/pdfCasosRiscos.php?tipo_casos=4&tipo=Recuperados" target="_black" class="btn btn-sm btn-success">Recuperados</a>

        <div class="card-title mt-4"> <b>Casos a níveis municipais</b> </div>
        <br><br>
        <div class="card-subtitle alert alert-light">
          <a href="./relatorios/niveismunicipais.php?municipio=1" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">viana</a>
          <a href="./relatorios/niveismunicipais.php?municipio=2" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">belas</a>
          <a href="./relatorios/niveismunicipais.php?municipio=3" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">talatona</a>
          <a href="./relatorios/niveismunicipais.php?municipio=4" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">kissama</a>
          <a href="./relatorios/niveismunicipais.php?municipio=5" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">cazenga</a>
          <a href="./relatorios/niveismunicipais.php?municipio=6" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">I. bengo</a>
          <a href="./relatorios/niveismunicipais.php?municipio=7" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">cacuaco</a>
          <a href="./relatorios/niveismunicipais.php?municipio=8" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">k. Kiaxi</a>
          <a href="./relatorios/niveismunicipais.php?municipio=9" class="text-decoration-none btn border-0 btn-outline-success d-inline" target="_blank">luanda</a>
        </div>
        <br>
        <div class="card-subtitle">

          <b>Gerar relatório de casos filtrados</b>
          <br><br>
          <form action="./relatorios/casosfiltrados2.php" method="get" target="_blank">
            <div class="row">

              <div class="col">
                <select class="form-select form-select-md" required name="localidade">
                  <option selected disabled>Localidade</option>
                  <?php
                  $select = $BD->query("SELECT *FROM localidades ORDER BY designacao_localidade");
                  while ($localide = $select->fetch()) : ?>
                    <option value="<?= $localide->idlocalidades ?>"><?= $localide->designacao_localidade ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="col">
                <select class="form-select form-select-md" required name="fase">
                  <option selected disabled>Fases</option>
                  <?php
                  $select = $BD->query("SELECT *FROM fases ORDER BY designacao_fase");
                  while ($fase = $select->fetch()) : ?>
                    <option value="<?= $fase->idfases ?>"><?= $fase->designacao_fase ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="col">
                <select class="form-select form-select-md" required name="estado">
                  <option selected disabled>Estados</option>
                  <?php
                  $select = $BD->query("SELECT *FROM estados ORDER BY designacao_estado");
                  while ($estado = $select->fetch()) : ?>
                    <option value="<?= $estado->idestados ?>"><?= $estado->designacao_estado ?></option>
                  <?php endwhile; ?>

                </select>
              </div>

              <div class="col">
                <select class="form-select form-select-md" required name="genero">
                  <option selected disabled>Genero</option>
                  <option>Femenino</option>
                  <option>Masculino</option>
                </select>
              </div>

              <div class="col">
                <input type="submit" class="btn btn-success btn-md" name="CASE" value="GERAR">
              </div>

            </div>
          </form>

        </div>

        <br>

        <div class="card-subtitle">

          <b>Gerar relatório de casos filtrados por data</b>
          <br><br>
          <form action="./relatorios/casosfiltrados.php" method="post" target="_blank">
            <div class="row">

              <div class="col">
                <select class="form-select form-select-md" required name="localidade">
                  <option selected disabled>Localidade</option>
                  <?php
                  $select = $BD->query("SELECT *FROM localidades ORDER BY designacao_localidade");
                  while ($localide = $select->fetch()) : ?>
                    <option value="<?= $localide->idlocalidades ?>"><?= $localide->designacao_localidade ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="col">
                <select class="form-select form-select-md" required name="dia">
                  <option selected disabled>Dia</option>
                  <?php
                  for ($i = 31; $i >= 1; $i--) : ?>
                    <option><?= $i ?></option>
                  <?php endfor; ?>
                </select>
              </div>

              <div class="col">
                <select class="form-select form-select-md" required name="mes">
                  <option selected disabled>Mês</option>
                  <?php
                  for ($i = 12; $i >= 1; $i--) : ?>
                    <option><?= $i ?></option>
                  <?php endfor; ?>
                </select>
              </div>

              <div class="col">
                <select class="form-select form-select-md" required name="ano">
                  <option selected disabled>Ano</option>
                  <option><?= date('Y') ?></option>
                  <option><?= date('Y') - 1 ?></option>
                  <option><?= date('Y') - 2 ?></option>
                  <option><?= date('Y') - 3 ?></option>
                  <option><?= date('Y') - 4 ?></option>
                  <option><?= date('Y') - 5 ?></option>
                  <option><?= date('Y') - 6 ?></option>
                  <option><?= date('Y') - 7 ?></option>
                  <option><?= date('Y') - 8 ?></option>
                  <option><?= date('Y') - 9 ?></option>
                  <option><?= date('Y') - 10 ?></option>
                </select>
              </div>

              <div class="col">
                <button type="submit" class="btn btn-success btn-md" name="municipio">Gerar</button>
              </div>

            </div>
          </form>

        </div>

        <br>
        <b>funcionários</b>
        <br><br>
        <a href="./relatorios/pdfFuncionariosTipos.php?tipo_func=1&tipo=Analistas" target="_blank" class="btn btn-sm btn-success">Administradores</a>
        <a href="./relatorios/pdfFuncionariosTipos.php?tipo_func=2&tipo=Admnistradores" target="_blank" class="btn btn-sm btn-success">Analistas</a>

      </div>
    </div>
  </div>
</div>