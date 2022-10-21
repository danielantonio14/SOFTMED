
$(document).ready(function () {

  /* 
      ARQUIVO JS PARa MANIPULAR CASOS EM AJAX
   */


  // ================================ CRUD ============================

  // 1 - SAVE
  $('.form-add-casos').submit((e) => {

    e.preventDefault();

    $.ajax({
      url: './assets/controllers/casos.php',
      type: 'POST',
      data: $('.form-add-casos').serialize(),
      error: (error) => {
        $('.r2').html(`<span class="text-danger">${error}</span>`)
      },
      beforeSend: () => {
        $('.r2').html('<img src="./assets/images/loading.gif">')
      },
      success: (data) => {
        if (data == 200) {
          $('.r2').html('<span class="text-success"><b>Dados coletados.</b> </span> ')
          $('.form-add-casos').trigger('reset')
          setTimeout(() => {
            $('.r2').html('')
            $('.f-modal1').click()

          }, 3000)
        } else {
          $('.r2').html(`<span class="text-danger">${data}</span>`)
        }
      }
    })

  })


  // 2 - DELETE
  $('.delete-casos').click(function (e) {
    e.preventDefault()
    $.ajax({
      url: './assets/controllers/casos.php?acao=delete&id_user=' + $(this).attr('id'),
      success: (data) => {
        $('.row-user' + $(this).attr('id'))
          .addClass('alert-danger')
          .fadeOut('3500')
      }

    })
  })


  //3 - QUERY
  $('#campo-pesquisar-paciente').keyup(() => {
    const query = $('#campo-pesquisar-paciente').val()
    $.ajax({
      url: './assets/controllers/casos.php?acao=query&query=' + query,
      success: (data) => {
        $('#row-case-2').html(data)
        $('#row-case').hide()


      }
    })
  })


  // VIEW TAB 
  setInterval(() => {

    $.ajax({
      url: './assets/controllers/casos.php?acao=view',
      success: (data) => {
        $('.row-case').html(data)

      }

    })
  }, 5000)


  // PREVALENCIAS
  setInterval(() => {
    $.ajax({
      url: './assets/controllers/casos.php?acao=PI',
      success: (data) => {

        $('#PI-data').html(data)
      }
    })

  }, 1000)

  // INSIDENCIAS
  setInterval(() => {
    $.ajax({
      url: './assets/controllers/casos.php?acao=II',
      success: (data) => {

        $('#II-data').html(data)
      }
    })

  }, 1000)

  // SET FASES
  var campo_idade = $("#idade")
  var campo_fase = $("#fase")
  var valor
  campo_idade.change(function () {
    valor = campo_idade.val()
    if (valor >= 0 && valor <= 11) {

      $("#fases").attr('value', '1')
      campo_fase.attr('placeholder', 'Infância')

    } else if (valor >= 12 && valor <= 17) {

      $("#fases").attr('value', '2')
      campo_fase.attr('placeholder', 'Adolescência')

    } else if (valor >= 18 && valor <= 39) {

      $("#fases").attr('value', '3')
      campo_fase.attr('placeholder', 'Juventude')

    } else if (valor >= 40 && valor <= 69) {

      $("#fases").attr('value', '4')
      campo_fase.attr('placeholder', 'Adulta')

    } else {
      $("#fases").attr('value', '5')
      campo_fase.attr('placeholder', 'Idosa')

    }
  })

  // ENVIAR COMENTARIOS
  $('.form-comentario').submit(function (p) {
    p.preventDefault()

    var dados = $('.form-comentario').serialize()

    $.ajax({
      url: './assets/controllers/casos.php',
      method: 'POST',
      data: $('.form-comentario').serialize(),
      beforeSend: () => {
        $('.rc').html('<img src="./assets/images/loading.gif">')
      },
      success: function (data) {
        if (data == 200) {
          $('.rc').html('<span class="text-success">Comentario enviado.</span>')
          $('.form-comentario').trigger('reset')
        } else {
          $('.rc').html(data)
        }
      },
      error: function (err) {
        alert(err)
      }
    })
  })

  // VER INFO CASOS
  setInterval(() => {
    $.ajax({
      url: './assets/controllers/casos.php?acao=info',
      success: (data) => {
        $('.info-data').html(data)
      }
    })
  }, 1000)

  // set municipios dos ditritos

  var selectDistrito = $('#municipios')
  var distritos = $('#distritos')
  selectDistrito.change(function () {
    switch (selectDistrito.val()) {
      case '9':
        distritos.html('<option>Sambizanga</option><option>Rangel</option>')
        break;

      case '7':
        distritos.html('<option>Kikolo</option><option>Sequele</option>')
        break;

      case '8':
        distritos.html('<option>Golf</option><option>Palanca</option>')
        break;

      case '6':
        distritos.html('<option>Catete</option><option>Bela-vista</option>')
        break;

      case '5':
        distritos.html('<option>Hoji ya Henda</option><option>Tala Hadi</option>')
        break;

      case '4':
        distritos.html('<option>Cabo-ledo</option><option>Muxima</option>')
        break;

      case '2':
        distritos.html('<option>Kilamba</option><option>Ramiros</option>')
        break;
      case '1':
        distritos.html('<option>Estalagem</option><option>Zango</option>')
        break;
      case '3':
        distritos.html('<option>Benfica</option><option>Camama</option>')
        break;

    }
  })


})

