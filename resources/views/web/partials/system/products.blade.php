  <div class="col-xl-12">
    <h4><b>Productos</b></h4>
  </div>

  <div class="col-xl-12">
    <table class="tableStyle">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio de Venta</th>
          <th>Fuente Precio</th>
          <th>Fecha Precio</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->unitaryPrice }}</td>
            <td>{{ $product->priceSource }}</td>
            <td>{{ $product->datePriceSource }}</td>
            <td>
                @include('web.partials.system.characteristicsModal')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
