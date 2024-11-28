<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Cari Ambulance</title>
</head>

<body>
    <div class="row">
        <div class="col-lg-6">
            <div class="d-flex">
                <div class="m-auto">
                    <h2 class="text-orange-500">Ambulance online </h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="https://storage.googleapis.com/a1aa/image/nrpRIcN38io9Op5xzfzRYd9Cv9UOEbLeA3smVxoqCVSJoKrTA.jpg"
                alt="" style="width: 70%">
        </div>
    </div>
    <div class="container mb-4">
        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        c1
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        c2
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        c3
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        c4
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 50px">
            <div class="col-lg-6 text-center">
                <img src="{{ asset('img/search.svg') }}" alt="" srcset="" style="width: 60%">
                <p>Sedang membutuhkan ambulance? <a href="#">Cari disini</a></p>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('img/input.svg') }}" alt="" srcset="" style="width: 60%">
                <p>Anda pemilik ambulance? <a href="{{ url('login') }}">Masuk disini</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
