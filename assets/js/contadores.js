$(document).ready(function () {

  /* 
      # Contadores de registro
      # não alterar nada nesse arquivo 
   */

  // conta aativos
  async function contarAtivos() {
    await $.ajax({
      url: './assets/controllers/contadores.php?table=casos_ativos',
      success: (data) => {
        $("#total-ativos").html(data)
      }
    })
  }
  // conta funcionários
  async function contarUsuario() {
    await $.ajax({
      url: './assets/controllers/contadores.php?table=funcionarios',
      success: (data) => {
        $("#total-funcionarios").html(data)
      }
    })
  }
  // conta casos
  async function contarCasos() {
    await $.ajax({
      url: './assets/controllers/contadores.php?table=casos',
      success: (data) => {
        $("#total-casos").html(data)
      }
    })
  }
  // conta analistas
  async function contarAnalistas() {
    await $.ajax({
      url: './assets/controllers/contadores.php?table=funcionario_analista',
      success: (data) => {
        $("#total-analista").html(data)
      }
    })
  }
  // conta Administradores
  async function contarAdministradores() {
    await $.ajax({
      url: './assets/controllers/contadores.php?table=default',
      success: (data) => {
        $("#total-adm").html(data)
      }
    })
  }


  // CONTA CASOS VIANA
  async function contarCasoViana() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=1',
      success: (data) => {
        $(".casosViana").html(data)
      }
    })
  }
  // CONTA CASOS BELAS
  async function contarCasoBelas() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=2',
      success: (data) => {
        $(".casosBelas").html(data)
      }
    })
  }
  // CONTA CASOS CAZENGA
  async function contarCasoCazenga() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=5',
      success: (data) => {
        $(".casosCazenga").html(data)
      }
    })
  }
  // CONTA CASOS Cacuaco
  async function contarCasoCacuaco() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=7',
      success: (data) => {
        $(".casosCacuaco").html(data)
      }
    })
  }
  // CONTA CASOS kilamba kiaxi
  async function contarCasoKK() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=8',
      success: (data) => {
        $(".casosKK").html(data)
      }
    })
  }
  // CONTA CASOS Kisssama
  async function contarCasosKissama() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=4',
      success: (data) => {
        $(".casosKissama").html(data)
      }
    })
  }
  // CONTA CASOS Icolo e Bengo
  async function contarCasosIB() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=6',
      success: (data) => {
        $(".casosIB").html(data)
      }
    })
  }
  // CONTA CASOS talatona 
  async function contarCasosTalatona() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=3',
      success: (data) => {
        $(".casosTalatona").html(data)
      }
    })
  }
  // CONTA CASOS luanda
  async function contarCasosLuanda() {
    await $.ajax({
      url: './assets/controllers/contadores.php?t=9',
      success: (data) => {
        $(".casosLuanda").html(data)
      }
    })
  }




  setInterval(() => {
    contarAdministradores()
    contarAnalistas()
    contarUsuario()
    contarCasos()
    contarAtivos()

    contarCasoViana()
    contarCasoBelas()
    contarCasoCazenga()
    contarCasoCacuaco()
    contarCasoKK()
    contarCasosKissama()
    contarCasosIB()
    contarCasosTalatona()
    contarCasosLuanda()
  }, 1500)



})
