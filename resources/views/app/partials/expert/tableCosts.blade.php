@foreach($listCost as $cost)
    <tr>
        <td>{{ $cost->detail }}</td>
        <td>{{ $cost->group }}</td>
        <td>{{ $cost->subGroup }}</td>
        <td>{{ $cost->unitaryCost }}</td>
        <td>{{ $cost->quantity0 }}</td>
        <td>{{ $cost->quantity1 }}</td>
        <td>{{ $cost->quantity2 }}</td>
        <td>{{ $cost->quantity3 }}</td>
        <td>{{ $cost->quantity4 }}</td>
        <td>{{ $cost->quantity5 }}</td>
        <td>{{ $cost->quantity6 }}</td>
        <td>{{ $cost->quantity7 }}</td>
        <td>{{ $cost->quantity8 }}</td>
        <td>{{ $cost->quantity9 }}</td>
        <td>{{ $cost->quantity10 }}</td>
        <td>{{ $cost->quantity11 }}</td>
        <td>{{ $cost->quantity12 }}</td>
        <td id="{{ $cost->id }}"><a href="#"><img src="{{ asset('images/app/editIcon.png') }}"></a></td>
        <td id="{{ $cost->id }}" onclick="deleteCost(this.id)"><a href="#"><img src="{{ asset('images/app/deleteIcon.png') }}"></a></td>
    </tr>
@endforeach
