<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  @include('nav')
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="text-primary">Data Skills<h4>
                </div>
                <div>
                    <button class="btn btn-primary" onclick="window.location.href='{{ route('skills.create') }}'" type="button">Tambah Skill</button>
                </div>
                
            </div>
        </div>
    </br>
        <div class="row">
            <div class="col-lg-12">
              <div class="main-content">
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-block">
                      <strong>{{ $message }}</strong>
                  </div>
                 @endif
              <div class="table-container">
                <table id="table_produk" class="table table-striped table-bordered text-left">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Name</th>
                      <th>Skills</th>
                    </tr>
                  </thead>
                  <tbody>
                   @php $no = 1; @endphp
                   @foreach ($skill_set as $p)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $p->nama_kandidat }}</td>
                      <td>{{ $p->skill }}</td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>