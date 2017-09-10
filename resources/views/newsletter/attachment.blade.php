<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block text-nowrap">
                        <h2>Hallo {{ $person->firstname . ' ' . $person->name }}</h2>
                        <h3>{{ $subject }}</h3>
                        <p> {{ $body }}</p>
                        <hr>
                        <img alt="star" src="data:image/png;base64,
                            <?php echo base64_encode(file_get_contents("../public/img/newslettersample.png")) ?>
                        "/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>