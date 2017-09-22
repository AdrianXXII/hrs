<div class="col-lg-12 col-sm-12">
    <h3>Neu</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Hotel</th>
            <th>Zimmerart</th>
            <th>Zimmer</th>
            <th>Kunde</th>
            <th>Datum</th>
            <th>Status</th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            @if($reservation->status != App\Reservation::STATUS_NEW)
                @continue
            @endif
            <tr>
                <td>{{ $reservation->roomtype->hotel->name }}</td>
                <td>{{ $reservation->roomtype->title }}</td>
                <td>{{ $reservation->room->room_number }}</td>
                <td>{{ $reservation->name }}</td>
                <td>{{ (new \Carbon\Carbon($reservation->reservation_start))->format('d.m.Y') }} - {{ (new \Carbon\Carbon($reservation->reservation_end))->format('d.m.Y') }}</td>
                <td>{{ $reservation->getStatusText() }}</td>
                <td>
                    <a href="{{ route('manager.reservations.edit', ['id' => $reservation->id]) }}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                    <form method="post" class="deleteBtn" action="{{ route('manager.reservations.delete', ['id' => $reservation->id]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger center-block deleteBtn">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>