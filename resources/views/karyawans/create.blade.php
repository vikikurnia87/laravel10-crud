<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('karyawans.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">NIP</label>
                                <input type="text" class="form-control @error('`nip`') is-invalid @enderror" name="nip" value="{{ old('nip') }}" placeholder="Masukkan Nip">

                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('`nama`') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">

                                <label class="font-weight-bold">Email</label>
                                <input type="text" class="form-control @error('`email`') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan Email">

                                <label class="font-weight-bold">Alamat</label>
                                <input type="text" class="form-control @error('`alamat`') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat">

                                <label class="font-weight-bold">Role</label>
                                <select class="form-control" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                    @endforeach
                                </select>

                            
                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

</body>
</html>