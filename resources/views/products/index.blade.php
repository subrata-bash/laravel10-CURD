<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laravel Curd</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('products.index') }}">Products</a>
  </div>
</nav>
    <div class="container">
        <div class="d-flex justify-content-end">
            <a href="{{ route('products.create') }}" class="btn btn-outline-dark mt-2">New Product</a>
        </div>

        <table class="table table-hover mt-5">
            <thead>
              <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <img src="products/{{ $product->image }}" alt="{{ $loop->index }}" class="rounded-circle" width="40" height="40">
                    </td>
                    <td>
                        <a class="btn btn-dark" href="products/{{ $product->id }}/edit">Edit</a>
                        <form action="products/{{ $product->id }}/delete" method="POST" class="d-inline">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger" >Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</body>
</html>
