<div class="modal fade" id="modalNovoCaso" data-bs-backdrop="static" aria-labelledby="m1" tabindex="-1">
  <div class="modal-dialog modal-lg bg-grey">
    <div class="modal-content">
      <div class="modal-header bg-1">
        <h5 class="modal-title text-white" id="m1">Coleta de dados</h5>
        <button type="button" class="btn-close f-modal1 cor-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-grey">
        <form class="form-add-casos" method="post">
          <div class="row">
            <div class="col form-group">
              <input type="text" class="form-control form-control-lg border-1" name="nome" placeholder="Nome do paciente" required>
            </div>
            <div class="col form-group">
              <select class="form-select form-select-lg" name="genero">
                <option selected disabled>Genero</option>
                <option>Femenino</option>
                <option>Masculino</option>
              </select>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col form-group">
              <input type="text" class="form-control form-control-lg border-1" id="idade" placeholder=" Idade" name="idade" required min="0" max="2" maxlength="3">
            </div>
            <div class="col form-group">
              <input type="text" class="form-control form-control-lg border-1" id="fase" placeholder=" Fase" readonly disabled>
              <input type="hidden" class="form-control form-control-lg border-1" id="fases" placeholder=" Fase" name="fase" value="">
            </div>
          </div>

          <div class="row mt-4">
            <div class="col form-group">
              <select class="form-select form-select-lg" name="estado">
                <option selected disabled>Estado</option>
                <?php
                $select = $BD->query("SELECT *FROM estados WHERE idestados <=2 ORDER BY designacao_estado");
                while ($estado = $select->fetch()) : ?>
                  <option value="<?= $estado->idestados ?>"><?= $estado->designacao_estado ?></option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="col form-group">
              <select class="form-select form-select-lg" name="nacionalidade">
                <option selected disabled>Nacionalidade</option>
                <?php
                $select = $BD->query("SELECT *FROM nacionalidade ORDER BY designacao_nacionalidade");
                while ($localide = $select->fetch()) : ?>
                  <option value="<?= $localide->idnacionalidade ?>"><?= $localide->designacao_nacionalidade ?></option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="col">
              <input type="text" name="morada" class="form-control form-control-lg" placeholder="Morada" required>
            </div>
          </div>

          <div class="row mt-4">

            <div class="col form-group">
              <select class="form-select form-select-lg" name="localidade" id="municipios">
                <option selected disabled>Localidade</option>
                <?php
                $select = $BD->query("SELECT *FROM localidades ORDER BY designacao_localidade");
                while ($localide = $select->fetch()) : ?>
                  <option value="<?= $localide->idlocalidades ?>"><?= $localide->designacao_localidade ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="col">
              <select name="bairro" id="distritos" class="form-select form-select-lg">
                <option selected> Distrito</option>
              </select>
            </div>
          </div>


          <div class="mt-4 mb-4 r2 text-center p-2"></div>
          <div class="mt-3 text-lg-center">
            <button type="submit" class="btn btn-lg text-white bg-1 rounded-bottom">coletar</button>
          </div>
          <input type="hidden" name="acao" value="save">
        </form>
      </div>

    </div>
  </div>
</div>