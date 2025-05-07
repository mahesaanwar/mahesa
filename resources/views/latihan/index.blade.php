<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Latihan Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray;">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Tutorial Latihan Laravel</h3>
                    <hr>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('latihan.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">GAMBAR</th>
                                    <th scope="col">JUDUL</th>
                                    <th scope="col">CONTENT</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latihans as $latihan)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('/storage/latihans/'.$latihan->image) }}" class="rounded" style="width: 150px;">
                                        </td>
                                        <td>{{ $latihan->title }}</td>
                                        <td>{!! $latihan->content !!}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('latihan.destroy', $latihan->id) }}" method="POST">
                                                <a href="{{ route('latihan.show', $latihan->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('latihan.edit', $latihan->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <div class="alert alert-danger">Data Post belum Tersedia.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $latihans->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(session()->has('success'))

        toastr.success('{{ session('success') }}', 'BERHASIL!');

        @else(session()->has ('error'))

        toastr.error('{{ session('error')}}', 'GAGAL!');
        @endif
    </script>

</body>
</html>