<h3>Ladenhüter der letzten {{ $timeRange }} Tage</h3>
<table class="table table-striped table-responsive">
    <thead>
        <tr>
            <th>#</th>
            <th>Hotel</th>
            <th>Zimmernummer</th>
            <th>Zimmername und Kategorie</th>
            <th>Umsatz CHF</th>
        </tr>
    </thead>
    <tbody>
        <?php $statsNonSellerRank=1 ?>
        @foreach($statsNonSeller as $roomId => $price)
        <tr>
                <td>{{ $statsNonSellerRank++ }}</td>
                <td>{{ App\Room::find($roomId)->roomtype->hotel->name }}</td>
                <td>{{ App\Room::find($roomId)->room_number }}</td>
                <td>
                    {{ App\Room::find($roomId)->roomtype->title . ' (' . App\Room::find($roomId)->roomtype->category->name . ')' }}
                </td>
                <td>{{ $price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>