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
      	<div style="border: solid 1px blue;padding:10px;margin-bottom:5px;background-color:white"><label><b>Edit Data Produk</b></label></div>
      	<div class="box box-primary">
	        <div class="box-body">
	          	<form action="/product/{{ $products->id }}" name="modal_popup" enctype="multipart/form-data" method="POST">
		            <div class="form-group">
		              	<input type="text" name="nama" class="form-control" placeholder="NAMA PRODUK" value="{{ $products->nama }}" required/>
		            </div>
		            <div class="form-group">
		              	<input type="text" name="model" class="form-control" placeholder="MODEL PRODUK" value="{{ $products->model }}"/>
		            </div>
		            <div class="form-group">
		              	<!-- VERSi MANY TO MANY -->
		              	<select class="multi-select" id="category_id" name="category_id[]" data-placeholder="Please select category" multiple="multiple">
			                @foreach($products->categories as $category)
								<option value="{{ $category->id }}" selected>{{ $category->title }}</option>
			                @endforeach

							<option>---------------------</option>

			                @foreach($kategori as $data)
								<option value="{{ $data->id }}">{{ $data->title }}</option>
			                @endforeach
		                </select>
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