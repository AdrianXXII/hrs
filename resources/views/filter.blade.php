<?php

if(request()->get('ort')) {
    $ort = request()->get('ort');
}

if(request()->get('anreisedatum')) {
    $anreisedatum = new \Carbon\Carbon(request()->get('anreisedatum'));
}

if(request()->get('abreisedatum')) {
    $abreisedatum = new \Carbon\Carbon(request()->get('abreisedatum'));
}

if(isset($anreisedatum) && isset($abreisedatum) && $anreisedatum >= $abreisedatum) {
    unset($abreisedatum);
}

if(request()->get('anzahlPersonen')) {
    $anzahlPersonen = request()->get('anzahlPersonen');
}

if(request()->get('zimmerKategorie')) {
    $zimmerKategorie = request()->get('zimmerKategorie');
}

if(request()->get('anzahlPersonen')) {
    $anzahlPersonen = request()->get('anzahlPersonen');
}

if(request()->get('zusatzleistung')) {
    $zusatzleistung = request()->get('zusatzleistung');
}

?>

<form action="{{ route('search') }}" class="form-horizontal" method="GET">

    <div class="panel panel-primary">
        <div class="panel-heading">Hotel suchen</div>

        <div class="panel-body">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="ort" class="col-md-12 right control-label label-left">Ort</label>
                    <div class="col-md-12">
                        <input id="ort" type="text" class="form-control" name="ort" value="{{ isset($ort) ? $ort : '' }}">
                    </div>

                    <label for="anreisedatum" class="col-md-12 right control-label label-left">Anreisedatum</label>
                    <div class="col-md-12">
                        <div class="input-group date" id="datepicker_anreise">
                            <input id="anreisedatum" type="text" class="form-control" name="anreisedatum" value="{{ isset($anreisedatum) ? $anreisedatum->format('d.m.Y') : (new \Carbon\Carbon())->format('d.m.Y') }}"/>
                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                        </div>
                    </div>

                    <label for="abreisedatum" class="col-md-12 right control-label label-left">Abreisedatum</label>
                    <div class="col-md-12">
                        <div class="input-group date" id="datepicker_abreise">
                            <input id="abreisedatum" type="text" class="form-control" name="abreisedatum" value="{{ isset($abreisedatum) ? $abreisedatum->format('d.m.Y') : '' }}" />
                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                        </div>
                    </div>

                    <label for="anzahlPersonen" class="col-md-12 right control-label label-left">Anzahl Personen</label>
                    <div class="col-md-12">
                        <select class="form-control" name="anzahlPersonen" id="anzahlPersonen">
                            @for($i = 1; $i <= 30; $i++)
                                <option {{ isset($anzahlPersonen) && $anzahlPersonen == $i ? 'selected' : '' }}
                                        value="{{ $i }}">{{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <label for="zimmerkategorie" class="col-md-12 right control-label label-left">Zimmerkategorie</label>
                    <div class="col-md-12">
                        <select class="form-control" name="zimmerKategorie" id="zimmerKategorie">
                            @foreach($categories as $category)
                                <option {{ isset($zimmerKategorie) && $zimmerKategorie == $category->id ? 'selected' : '' }}
                                        data-numberofbeds="{{ $category->number_of_beds }}" value="{{ $category->id }}">
                                    {{ $category->name . ' (' . $category->number_of_beds . ' Betten)' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <label for="zusatzleistungen" class="col-md-12 right control-label label-left">Zusatzleistungen</label>
                    <div class="col-md-12">
                        <div class="button-group">
                            <button type="button" class="col-md-12 btn btn-default btn-sm dropdown-toggle"
                                    data-toggle="dropdown">
                                Auswählen
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($hotelAttributes as $attribute)
                                    <li>
                                        <a href="#" class="small" data-value="{{ $attribute->id }}" tabIndex="-1">
                                            <input {{ isset($zusatzleistung) && in_array($attribute->id, $zusatzleistung) ? 'checked' : '' }}
                                                    type="checkbox" name="zusatzleistung[]" value=" {{ $attribute->id }}">
                                            {{ ' ' . $attribute->description }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <label for="zusatzleistungen" class="col-md-12 right control-label label-left">Los!</label>
                    <div class="col-md-12">
                        <button id="filterButton" type="submit" class="col-md-12 btn btn-primary">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filtern
                        </button>
                    </div>
                </div>
        </div>
    </div>
</form>