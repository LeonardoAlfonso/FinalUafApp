  <div class="col-xl-12">
    <h4><b>Costos de establecimiento</b></h4>
  </div>

  <div class="col-xl-12">
    <table class="tableStyle">
      <thead>
        <tr>
          <th>Costo</th>
          <th>Valor Unitario</th>
          <th>Cantidad Establecimiento</th>
          <th>Valor Establecimiento</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
          @foreach($costs as $cost)
            <tr>
                <td class="cell">{{ $cost->detail }}</td>
                <td class="cell">{{ $cost->unitaryCost }}</td>
                <td class="cell">{{ $cost->quantity }}</td>
                <td class="cell">{{ $cost->unitaryCost }}</td>
                <td class="cell">{{ $cost->total }}</td>
            </tr>
          @endforeach
            <tr>
                <td class="cell"></td>
                <td class="cell"></td>
                <td class="cell"></td>
                <td class="cell"><b>Total</b></td>
                <td class="cell">{{ $totalCost }}</td>
            </tr>
      </tbody>
    </table>
  </div>
