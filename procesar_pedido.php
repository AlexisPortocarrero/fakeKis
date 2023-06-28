<!DOCTYPE html>
<html>
<head>
  <title>Resumen del Pedido</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
    }
    
    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    h2 {
      text-align: center;
    }
    
    table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
    }
    
    table th,
    table td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
  </style>
</head>
<body>
<div class="container">
    <h2>Resumen del Pedido</h2>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $dni = isset($_POST['dni']) ? $_POST['dni'] : '';
      $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
      $tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : '';
      $nombreEmpresa = isset($_POST['nombreEmpresa']) ? $_POST['nombreEmpresa'] : '';
      $numIdentificacion = isset($_POST['numIdentificacion']) ? $_POST['numIdentificacion'] : '';
      $codigoPostal = isset($_POST['codigoPostal']) ? $_POST['codigoPostal'] : '';
      $domicilioFiscal = isset($_POST['domicilioFiscal']) ? $_POST['domicilioFiscal'] : '';
      $productos = isset($_POST['producto']) && is_array($_POST['producto']) ? $_POST['producto'] : array();
      $cantidades = array();
      $precios = array();
      $preciosTotales = array();

      // Precios de los productos
      $precios['1/4 de pollo'] = 17.99;
      $precios['1/2 pollo'] = 35.99;
      $precios['1 pollo entero'] = 65.99;
      $precios['hamburguesa de carne'] = 12.99;

      // Obtener las cantidades de los productos seleccionados
      foreach ($productos as $producto) {
        $cantidad = isset($_POST['cantidad_' . str_replace(' ', '_', $producto)]) ? $_POST['cantidad_' . str_replace(' ', '_', $producto)] : 0;
        $cantidades[$producto] = $cantidad;

        // Calcular el precio total del producto
        $precioTotal = $precios[$producto] * $cantidad;
        $preciosTotales[$producto] = $precioTotal;
      }

      if ($tipoDocumento === 'factura') {
        echo '<h3>Datos del Cliente</h3>';
        echo '<table>';
        echo '<tr><th>DNI:</th><td>' . $dni . '</td></tr>';
        echo '<tr><th>Teléfono:</th><td>' . $telefono . '</td></tr>';
        echo '<tr><th>Nombre:</th><td>' . $nombre . '</td></tr>';
        echo '</table>';

        echo '<h3>Datos de Facturación</h3>';
        echo '<table>';
        echo '<tr><th>Nombre de la Empresa:</th><td>' . $nombreEmpresa . '</td></tr>';
        echo '<tr><th>Número de Identificación:</th><td>' . $numIdentificacion . '</td></tr>';
        echo '<tr><th>Código Postal:</th><td>' . $codigoPostal . '</td></tr>';
        echo '<tr><th>Domicilio Fiscal:</th><td>' . $domicilioFiscal . '</td></tr>';
        echo '</table>';
      } else {
        echo '<h3>Datos del Cliente</h3>';
        echo '<table>';
        echo '<tr><th>DNI:</th><td>' . $dni . '</td></tr>';
        echo '<tr><th>Teléfono:</th><td>' . $telefono . '</td></tr>';
        echo '<tr><th>Nombre:</th><td>' . $nombre . '</td></tr>';
        echo '</table>';
      }

      echo '<h3>Productos Seleccionados</h3>';
      echo '<table>';
      echo '<tr><th>Producto</th><th>Cantidad</th><th>Precio Unitario</th><th>Precio Total</th></tr>';
      $totalPedido = 0;
      if (!empty($productos) && !empty($cantidades) && count($productos) === count($cantidades)) {
        foreach ($productos as $producto) {
          $cantidad = $cantidades[$producto];
          $precioUnitario = $precios[$producto];
          $precioTotal = $preciosTotales[$producto];
          $totalPedido += $precioTotal;

          echo '<tr><td>' . $producto . '</td><td>' . $cantidad . '</td><td>' . $precioUnitario . '</td><td>' . $precioTotal . '</td></tr>';
        }
        echo '<tr><td colspan="3"><strong>Total del Pedido:</strong></td><td><strong>' . $totalPedido . '</strong></td></tr>';
      } else {
        echo '<tr><td colspan="4">No se seleccionaron productos</td></tr>';
      }
      echo '</table>';
    } else {
      echo '<p>No se recibieron los datos del formulario</p>';
    }
    ?>
  </div>
</body>
</html>