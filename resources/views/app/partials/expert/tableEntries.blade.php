@foreach($listEntries as $entry)
    <tr>
        <td>{{ $entry->name }}</td>
        <td>{{ $entry->measureUnity }}</td>
        <td>{{ $entry->priceSource }}</td>
        <td>{{ $entry->datePriceSource }}</td>
        <td>{{ $entry->unitaryPrice }}</td>
        <td>{{ $entry->quantity1 }}</td>
        <td>{{ $entry->quantity2 }}</td>
        <td>{{ $entry->quantity3 }}</td>
        <td>{{ $entry->quantity4 }}</td>
        <td>{{ $entry->quantity5 }}</td>
        <td>{{ $entry->quantity6 }}</td>
        <td>{{ $entry->quantity7 }}</td>
        <td>{{ $entry->quantity8 }}</td>
        <td>{{ $entry->quantity9 }}</td>
        <td>{{ $entry->quantity10 }}</td>
        <td>{{ $entry->quantity11 }}</td>
        <td>{{ $entry->quantity12 }}</td>
        <td id="{{ $entry->id }}" onclick="editEntry(this.id)"><a href="#"><img src="{{ asset('images/app/editIcon.png') }}"></a></td>
        <td id="{{ $entry->id }}" onclick="deleteEntry(this.id)"><a href="#"><img src="{{ asset('images/app/deleteIcon.png') }}"></a></td>
    </tr>
@endforeach
