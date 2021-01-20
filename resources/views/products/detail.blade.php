@extends('layouts.adminlte')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
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
            <h4>Product Detail</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" value="{{ $data->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea class="form-control" rows="3" disabled>{{ $data->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" class="form-control" value="{{ $data->price }}" disabled>
            </div>
            <div class="form-group">
                <label for="category_id">Product Category</label>
                <input type="number" class="form-control" value="{{ $data->category_id }}" disabled>
            </div>
            <div class="form-group">
                <label for="file">Product Image</label><br>
                <img src="{{ URL::to('/') }}/images/{{ $data->file }}" width='100' />
            </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection