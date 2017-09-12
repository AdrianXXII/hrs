<h3>Meistbelegte Zimmer der letzten {{ $timeRange }} Tage</h3>
<table class="table table-striped table-responsive">
    <thead>
        <tr>
            <th>Platz</th>
            <th>Zimmernummer</th>
            <th>Zimmername und Kategorie</th>
            <th>Anzahl Übernachtungen</th>
        </tr>
    </thead>
    <tbody>
        <?php $statsRoomUsingRank=1 ?>
        @foreach($statsUsingRoom as $row)
        <tr>
            <td>{{ $statsRoomUsingRank++ }}</td>
            <td>{{ App\Room::find($row->room_id)->room_number }}</td>
            <td>
                {{ App\Room::find($row->room_id)->roomtype->title . ' (' . App\Room::find($row->room_id)->roomtype->category->name . ')' }}
            </td>
            <td>{{ $row->sum }}</td>
        </tr>
        @endforeach
    </tbody>
</table>