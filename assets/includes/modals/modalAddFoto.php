<div class="modal fade" id="modalAddFoto" data-bs-backdrop="static" aria-labelledby="m1" tabindex="-1">
  <div class="modal-dialog modal-md fundo-rgb-preto">
    <div class="modal-content">
      <div class="modal-header fundo rounded-0">
        <h5 class="modal-title text-muted" id="m1">FOTO</h5>
        <button type="button" class="btn-close f-modal2 cor-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fundo-rgb-preto">
        <form class="form-add-foto" method="post" enctype="multipart/form-data">


          <div class="mb-3">
            <label class="custom-file">
              <input type="file" name="foto_usuario" id="" placeholder="foto de usuario" class="custom-file-input" aria-describedby="fileHelpId">
              <span class="custom-file-control"></span>
            </label>

          </div>

          <div class="mt-4 mb-4 foto-up text-center p-2"></div>
          <div class="mt-3 text-lg-center">

            <button type="submit" class="btn btn-md fundo text-white-50" id="btn-add-foto" title="">adicionar</button>
          </div>
          <input type="hidden" name="acao" value="foto">
          <input type="hidden" class="input-add-foto" name="id_funcionario" value="">
        </form>
      </div>

    </div>
  </div>
</div>