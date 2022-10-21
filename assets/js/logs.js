
$(document).ready(function () {

  // LOGS DO SISTEMA
  setInterval(() => {

    $.ajax({
      url: './assets/controllers/logs.php?acao=logs',
      success: (data) => {
        $('.logs').html(data)
      }
    })
  }, 1000)

})

