@extends('layout-backend.default')
@section('content')
	<div class="container">
		<div class="col-md-8">
			@if ($errors->any())
		        <div class="alert alert-danger">
	                @foreach ($errors->all() as $error)
	                    {{ $error }}
	                @endforeach
		        </div>
		    @endif
		</div>

	    <div class="col-md-6">
	      	<div style="border: solid 1px blue;padding:10px;margin-bottom:5px;background-color:white"><label><b>Tambah Data Produk</b></label></div>

	      	<div class="box box-primary">
		        <div class="box-body">
		          	<form action="/product" name="modal_popup" enctype="multipart/form-data" method="POST">
			            <div class="form-group">
			              	<input type="text" name="nama" class="form-control" placeholder="NAMA PRODUK" value="{{ old('nama') }}" required/>
			            </div>
			            <div class="form-group">
			            	<input type="text" name="model" class="form-control" placeholder="MODEL PRODUK" value="{{ old('model') }}"/>
			            </div>
			            <div class="form-group">
			              	<div class="input-group">
				              	<label>Kategori Produk</label>
				              	<select class="form-control" name="kategori">
				                	<option value="-">-</option>
					                @foreach($kategori as $data)
					                    <option value='{{ $data->title }}'>{{ $data->title }}</option>
					                @endforeach
				              	</select>
				            </div><!-- /.input group -->
			           	</div>
			            <div class="form-group">
			            	<label>Photo Produk</label>
			              	<input type="file" id="picture" name="picture" class="form-control">
			            </div>
			            <div class="modal-footer">
			              	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			              	<button class="btn btn-success" type="submit" value="EDIT">SAVE</button>
			              	<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">RESET</button>
			            </div>
		          	</form>
		        </div>
	      	</div>
	    </div>
	</div>
@stop