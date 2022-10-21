$(document).ready(function () {

  /* 
      ARQUIVO JS PARa MANIPULAR USUÁRIO EM AJAX
   */


  // ================================ CRUD ============================

  // 1 - SAVE
  $('.form-add-user').submit((e) => {

    e.preventDefault();

    $.ajax({
      url: './assets/controllers/funcionarios.php',
      type: 'POST',
      data: $('.form-add-user').serialize(),
      error: (error) => {
        $('.r1').html(`<span class="text-danger">${error}</span>`)
      },
      beforeSend: () => {
        $('.r1').html('<img src="./assets/images/loading.gif">')
      },
      success: (data) => {
        if (data == 200) {
          $('.r1').html('<span class="text-success">Usuário cadastrado.</span> ')
          $('.form-add-user').trigger('reset')
          setTimeout(() => {
            $('.r1').html('')
            $('.f-modal2').click()
          }, 3000)
        } else {
          $('.r1').html(`<span class="text-danger">${data}</span>`)
        }
      }
    })

  })


  // 2 - DELETE
  $('.delete-user').click(function (e) {
    e.preventDefault()
    $.ajax({
      url: './assets/controllers/funcionarios.php?acao=delete&id_user=' + $(this).attr('id'),
      success: (data) => {
        if (data != 201) {

          $('.row-user' + $(this).attr('id'))
            .addClass('alert-danger')
            .fadeOut('3500')
        }
      }

    })
  })


  //3 - VIEW 
  $('#campo-pesquisar').keyup(() => {
    const query = $('#campo-pesquisar').val()
    $.ajax({
      url: './assets/controllers/funcionarios.php?acao=query&query=' + query,
      success: (data) => {
        $('#data-view').html(data)
      }
    })
  })


  // ADICIONAr PERMISSÃO 
  $('.permission-user').click(function () {
    var idUser = $(this).attr('id')
    var status = $(this).attr('title')


    $.ajax({
      url: './assets/controllers/funcionarios.php?acao=permision&status=' + status + '&query=' + idUser,
      success: (data) => {
        if (status == '0') {

          $('.row-user' + idUser).addClass('alert-success')
        } else {
          $('.row-user' + idUser).addClass('alert-danger')

        }
      }
    })
  })


})


/* ================================ ADD PHOTO ============================ */
async function adionarFoto(id) {
  document.querySelector(".input-add-foto").setAttribute('value', id)
  document.querySelector(".form-add-foto").addEventListener('submit', (e) => {
    e.preventDefault()
    const dados = new FormData(document.querySelector(".form-add-foto"))
    fetch('./assets/controllers/funcionarios.php', {
      method: 'POST',
      body: dados
    })
      .then(res => res.text())
      .then(data => {
        if (data != 200) {
          $('.foto-up').html('<span class="text-danger">' + data + '</span>')
        } else {
          location.reload()
        }
      })
  })
}
