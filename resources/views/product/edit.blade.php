@extends('layout-backend.default')
@section('content')

<div class="container">
    <div class="col-md-6">
      	<div style="border: solid 1px blue;padding:10px;margin-bottom:5px;background-color:white"><label><b>Edit Data Produk</b></label></div>
      	<div class="box box-primary">
	        <div class="box-body">
	          	<form action="/products/{{ $products->id }}" name="modal_popup" enctype="multipart/form-data" method="POST">
		            <div class="form-group">
		              	<input type="text" name="nama" class="form-control" placeholder="NAMA PRODUK" value="{{ $products->nama }}" required/>
		            </div>
		            <div class="form-group">
		              	<input type="text" name="model" class="form-control" placeholder="MODEL PRODUK" value="{{ $products->model }}"/>
		            </div>
		            <div class="form-group">
		            	<div class="input-group">
			              	<label>Kategori Produk</label>
			              	<select class="form-control" name="kategori">
			                	<option value='{{ $products->kategori }}' selected >{{ $products->kategori }}</option>
			                	<option value="-">-----------------------------</option>
				                @foreach($kategori as $data)
				                    <option value='{{ $data->title }}'>{{ $data->title }}</option>
				                @endforeach
			              	</select>
			            </div><!-- /.input group -->
					</div>
					<div class="form-group">
		              	<input type="file" id="picture" name="picture" class="form-control">
						@if(isset($products))
							<img src="{{ !empty($products->picture) ? asset('picture/'.$products->picture) : asset('img/not_available.png') }}" width="250" class="img-responsive img-rounded" alt="{{ $products->nama }}" style="margin-top: 15px;">
						@endif
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