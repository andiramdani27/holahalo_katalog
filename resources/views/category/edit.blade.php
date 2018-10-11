@extends('layout-backend.default')
@section('content')

<div class="container">
    <div class="col-md-6">
      	<div style="border: solid 1px blue;padding:10px;margin-bottom:5px;background-color:white"><label><b>Edit Data kategori Produk</b></label></div>
      	<div class="box box-primary">
	        <div class="box-body">
	          	<form action="/category/{{ $category->id }}" name="modal_popup" enctype="multipart/form-data" method="POST">
		            <div class="form-group">
		              	<input type="text" name="title" class="form-control" placeholder="NAMA KATEGORI PRODUK" value="{{ $category->title }}" required/>
		            </div>
		            <div class="form-group">
		              	<input type="text" name="description" class="form-control" placeholder="DESKRIPSI PRODUK" value="{{ $category->description }}" required/>
		            </div>
		            <div class="modal-footer">
		              	<input type="hidden" name="_method" value="put">
		              	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		              	<button class="btn btn-success" type="submit" value="EDIT">UPDATE</button>
		              	<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">RESET</button>
		            </div>
	          	</form>
	        </div>
      	</div>
    </div>
</div>

@stop