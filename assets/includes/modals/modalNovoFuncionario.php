<div class="modal fade" id="modalNovoFuncionario" data-bs-backdrop="static" aria-labelledby="m1" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-1 rounded-0">
        <h5 class="modal-title text-white" id="m1">Cadastrar Funcionário</h5>
        <button type="button" class="btn-close f-modal2 text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-grey">
        <form class="form-add-user" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col form-group">
              <input type="text" class="form-control form-control-lg border-1" placeholder=" Nome Completo" name="nome" required>
            </div>
            <div class="col form-group">
              <input type="tel" class="form-control form-control-lg border-1" placeholder=" Telefone" name="telefone" required>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col form-group">
              <input type="mail" class="form-control form-control-lg border-1" placeholder=" E-mail" name="email" required>
            </div>
            <div class="col form-group">
              <select class="form-select form-select-lg" name="tipo_funcionario">
                <option selected disabled>Categoria</option>
                <?php
                $select = $BD->query("SELECT *FROM tipo_funcionarios ORDER BY designacao_tipo");
                while ($tipo = $select->fetch()) : ?>
                  <option value="<?= $tipo->idtipo_funcionarios ?>"><?= $tipo->designacao_tipo ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="col form-group">
              <input type="password" name="senha" class="form-control form-control-lg border-1" placeholder="palavra-passe" required>
            </div>

            <div class="col form-group">
              <select class="form-select form-select-lg" name="loc">
                <option selected disabled>Localidade</option>
                <?php
                $select = $BD->query("SELECT *FROM localidades ORDER BY designacao_localidade");
                while ($localide = $select->fetch()) : ?>
                  <option value="<?= $localide->idlocalidades ?>"><?= $localide->designacao_localidade ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="mt-4 mb-4 r1 text-center p-2"></div>
            <div class="mt-3 text-lg-center">
              <button type="reset" class="btn btn-md btn-dark text-white">limpar</button>
              <button type="submit" class="btn btn-md btn-success text-white">cadastrar</button>
            </div>
            <input type="hidden" name="acao" value="save">
        </form>
      </div>

    </div>
  </div>
</div>