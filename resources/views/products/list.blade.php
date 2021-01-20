@extends('layouts.adminlte')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-success float-right">
            <span class="fa fa-plus-circle"> Add New Product</span></a>
        </div>
        <div class="card-body">

            @if($message = Session::get('success'))
              <div class="alert alert-success">
                <p align="center">{{$message}}</p>
              </div>
            @endif

            @if($message = Session::get('error'))
              <div class="alert alert-danger">
                <p align="center">{{$message}}</p>
              </div>
            @endif

            <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>        
            <tbody>
                <tr>   
                @foreach($data as $product)                         
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td><img src="{{ URL::to('/') }}/images/{{ $product->file }}" width="60" /></td>
                    <td width="25%">
                    <!-- here is the button action side where you can edit . view and delete the employee record -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-warning"><span class="fa fa-eye"></span> Detail</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span> Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Delete</button>
                        </form>
                                    <!-- ends here -->
                    </td>            
                </tr>
                @endforeach
            </tbody>        
            </table>
        </div>
    </div>
      <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection