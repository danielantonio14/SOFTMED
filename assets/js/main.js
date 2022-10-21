$(document).ready(function () {

  $('#graficoPizza').hide('fast')

  $('.gp').click(() => {
    $('#graficoPizza').fadeIn('fast')
    $('#graficosColuna, #graficoColuna2').fadeOut('fast')
  })
  $('.gg').click(() => {
    $('#graficoPizza').fadeOut('fast')
    $('#graficosColuna, #graficoColuna2').fadeIn('fast')

  })

  // alternar vizualização dos casos
  $('#view-casos-chart').fadeOut('fast')
  $('#btn-view-chart').click(() => {

    $('#view-casos-tab').fadeOut('fast')
    $('#view-casos-chart').fadeIn('fast')
    $('#view-casos-morte').fadeOut('fast')
  })

  $('#btn-view-tab').click(() => {

    $('#view-casos-tab').fadeIn('fast')
    $('#view-casos-chart').fadeOut('fast')
    $('#view-casos-morte').fadeOut('fast')
  })

  $('#view-casos-morte').fadeOut('fast')

  $('.btn-view-mortalidade').click(function () {
    $('#view-casos-tab').fadeOut('fast')
    $('#view-casos-chart').fadeOut('fast')
    $('#view-casos-morte').fadeIn('fast')
  })

  // preloders
  setTimeout(() => {
    $('.preloader').fadeOut()
  }, 1500)

})

