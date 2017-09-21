<h3>Umsatzstärkste Zimmer der letzten {{ $timeRange }} Tage</h3>
<table class="table table-striped table-responsive">
    <thead>
        <tr>
            <th>Platz</th>
            <th>Hotel</th>
            <th>Zimmernummer</th>
            <th>Zimmername und Kategorie</th>
            <th>Umsatz CHF</th>
        </tr>
    </thead>
    <tbody>
        <?php $statsProfitableRoomsRank=1 ?>
        @foreach($statsProfitableRooms as $roomId => $price)
        <tr>
                <td>{{ $statsProfitableRoomsRank++ }}</td>
                <td> {{ App\Room::find($roomId)->roomtype->hotel->name }}</td>
                <td>{{ App\Room::find($roomId)->room_number }}</td>
                <td>
                    {{ App\Room::find($roomId)->roomtype->title . ' (' . App\Room::find($roomId)->roomtype->category->name . ')' }}
                </td>
                <td>{{ $price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>