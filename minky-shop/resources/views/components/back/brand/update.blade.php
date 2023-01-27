<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <form class="my-3" action="{{ $brand -> id }}" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên thương hiệu</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th colspan="2" class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->created_at }}</td>
                        <td>{{ $brand->updated_at }}</td>
                        <td class="text-center">
                            <a href="{{ $brand->id }}" class="btn btn-primary">Sửa</a>
                        </td>
                        <td class="text-center">
                            <form method="POST" action="brand/{{ $brand->id }}"
                                onsubmit="return ConfirmDelete( this )">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Xóa</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
