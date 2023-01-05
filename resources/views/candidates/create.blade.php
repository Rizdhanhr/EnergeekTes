<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="text-primary">Tambah Data Kandidat<h4>
                </div>
                {{-- <div>
                    <button class="btn btn-primary" onclick="window.location.href='{{ route('pelanggan.create') }}'" type="button">Tambah Pelanggan</button>
                </div> --}}
                
            </div>
        </div>
    </br>
        <div class="row">
            <div class="col-lg-12">
              <div class="main-content">
                <form action="{{ route('kandidat.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Nama</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      <span style="color:red">@error('name') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Pekerjaan</label>
                    <select class="form-select" name="job" aria-label="Default select example">
                        @foreach ($jobs as $j)
                        <option value="{{ $j->id }}">{{ $j->name }}</option>
                        @endforeach
                      </select>
                      <span style="color:red">@error('job') {{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span style="color:red">@error('email') {{ $message }} @enderror</span>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Phone</label>
                        <input type="number" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span style="color:red">@error('phone') {{ $message }} @enderror</span>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Year</label>
                        <input type="number" name="year" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span style="color:red">@error('year') {{ $message }} @enderror</span>
                      </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Skill</label>
                    <select class="form-control" id="hobi" name="skill[]" multiple="multiple">
                        @foreach($skills as $s)
                        
                        <option   value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                      </select>
                      <span style="color:red">@error('skill') {{ $message }} @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
          </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#hobi').select2();
});
    </script>
</body>
</html>