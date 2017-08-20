@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Backend Bereich</h1>

        <div class="col-lg-4 jumbotron">
            <h2>Benutzerverwaltung</h2>
            <p>Benutzer erstellen, bearbeiten und löschen. </p>
            <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Zur Benutzerverwaltung</a>
        </div>

        <div class="col-lg-4 jumbotron">
            <h2>Hotelverwaltung</h2>
            <p>Hotels erstellen, bearbeiten und löschen. </p>
            <a href="{{ route('backend.hotels.index') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Zur Hotelverwaltung</a>
        </div>

        <div class="col-lg-4 jumbotron">
            <h2>Kategorieverwaltung</h2>
            <p>Hotelkategorien erstellen, bearbeiten und löschen. </p>
            <a href="{{ route('backend.categories.index') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">zur Kategorieverwaltung</a>
        </div>

    </div>
</div>
@endsection

