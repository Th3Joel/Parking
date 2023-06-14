function pajina(rut, id) {
  $("#" + id).load("app.php", { ruta: rut });
}
pajina("inicio", "app");

$("#btnSalir").click(function () {
  pajina("salir", "joel");
});

$("#btnConfig").click(function () {
  $("#btnConfig").addClass("active");
  $("#sistema").addClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("config", "app");
});

$("#btnInicio").click(function () {
  $("#btnInicio").addClass("active");
  $("#btnConfig").removeClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#sistema").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("inicio", "app");
});

$("#btnUsers").click(function () {
  $("#btnUsers").addClass("active");
  $("#sistema").addClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("users", "app");
});

$("#btnClientes").click(function () {
  $("#btnClientes").addClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#sistema").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("clientes", "app");
});

$("#btnEspacios").click(function () {
  $("#btnEspacios").addClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#sistema").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("espacios", "app");
});

$("#btnVehiculos").click(function () {
  $("#btnVehiculos").addClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#sistema").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("vehiculos", "app");
});

$("#btnSuscripcion").click(function () {
  $("#btnSuscripcion").addClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#sistema").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("suscripciones", "app");
});

$("#btnPlanes").click(function () {
  $("#btnPlanes").addClass("active");
  $("#sistema").addClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnInspeccion").removeClass("active");
  pajina("planes", "app");
});

$("#btnInspeccion").click(function () {
  $("#btnInspeccion").addClass("active");
  $("#btnSuscripcion").removeClass("active");
  $("#btnUsers").removeClass("active");
  $("#btnInicio").removeClass("active");
  $("#btnConfig").removeClass("active");
  $("#sistema").removeClass("active");
  $("#btnClientes").removeClass("active");
  $("#btnPlanes").removeClass("active");
  $("#btnEspacios").removeClass("active");
  $("#btnVehiculos").removeClass("active");
  pajina("inspecciones", "app");
});
