function mostrarCamposFactura() {
  var tipoDocumento = document.getElementById("tipoDocumento");
  var facturaFields = document.getElementsByClassName("factura-fields")[0];
  
  if (tipoDocumento.value === "factura") {
    facturaFields.style.display = "block";
  } else {
    facturaFields.style.display = "none";
  }
}

function toggleProductos() {
  var productosSection = document.getElementById("productos-section");
  productosSection.style.display = productosSection.style.display === "none" ? "block" : "none";
}1

function actualizarTotal() {
  var checkboxes = document.querySelectorAll('input[name="producto[]"]:checked');
  var total = 0;

  checkboxes.forEach(function (checkbox) {
    var cantidadSelect = document.getElementById("cantidad-" + checkbox.value);
    var cantidad = parseInt(cantidadSelect.value);
    var precio = parseFloat(checkbox.getAttribute("data-precio"));
    var subtotal = cantidad * precio;
    total += subtotal;

    var subtotalSpan = document.getElementById("subtotal-" + checkbox.value);
    subtotalSpan.textContent = "Subtotal: S/ " + subtotal.toFixed(2);
  });

  var totalInput = document.getElementById("total");
  totalInput.value = "Total: S/ " + total.toFixed(2);
}