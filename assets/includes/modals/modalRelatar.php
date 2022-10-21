<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-1">
        <h5 class="modal-title text-white" id="staticBackdropLabel">Comente sobre os casos em <?= ucfirst($funcionario->getIdLocalidade()) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-comentario">
          <div class="form-floating">
            <textarea class="form-control" name="comentario" placeholder="Deixe aqui o seu comentário" id="floatingTextarea" minlength="20" min="20" required></textarea>
            <label for="floatingTextarea">Comentário</label>
          </div>
          <div class="modal-footer">
            <div class="alert rc"></div>
            <input type="hidden" name="funcionario" value="<?= ucfirst($funcionario->getIdFuncionario()) ?>">
            <input type="hidden" name="local" value="<?= ucfirst($funcionario->getIdLocalidade()) ?>">
            <input type="hidden" name="acao" value="coment">
            <button type="submit" class="btn btn-success">enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>