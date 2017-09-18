<nav class="backend navbar navbar-inverse navbar-static-top">
    <div class="container">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="{{ route('users.index') }}">Benutzer</a>
            </li>
            <li>
                <a href="{{ route('attributes.index') }}">Zusatzleistung</a>
            </li>
            <li>
                <a href="{{ route('backend.categories.index') }}">Kategorie</a>
            </li>
            <li>
                <a href="{{ route('backend.hotels.index') }}">Hotel</a>
            </li>
        </ul>
    </div>
</nav>