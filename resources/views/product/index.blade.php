@extends('layout-backend.default')
@section('content')

	@if(Session::has('message'))
		<div class="col-md-4">
			<div class="alert alert-success">
	        	{{ Session::get('message') }}
	        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    		<span aria-hidden="true">&times;</span>
		  		</button>
	    	</div>
    	</div>
    @endif
    
	<style type="text/css">
	    th {
	      text-align: center;
	    }
	    td {
	      /*text-align: center;*/
	      font-size: 12px;
	    }
	    table {
	      background-color: white;
	    }
	    .form-group {
	      margin-right: 10px;
	    }
	</style>

	<div class="container">
		<div class="row">
		  	<div class="col-md-10">
		     	<div class="box-body">
		      		<form action="/cari-produk" method="POST" style="float: right">
			            <div class="form-inline">
			              	<div class="form-group">
			                	<div class="input-group">
				                	<div class="input-group-addon"><i class="fa fa-list"></i></div>
					                <select class="form-control" name="filter" style="width: 200px;" required>
					                  <option value="" disabled selected>FILTER BY CATEGORY</option>
					                    <option value="All">All Categories</option>
					                    @foreach($kategori as $data)
				                    		<option value='{{ $data->id }}'>{{ $data->title }}</option>
				                		@endforeach
					                </select>
			              		</div><!-- /.input group -->
			            	</div><!-- /.form group -->
			              	<div class="form-group">
			                	<div class="input-group">
			                		<input type="hidden" name="_token" value="{{ csrf_token() }}">  
			                		<button type="submit" name="cari" class="btn btn-success">Tampilkan</button>
			                	</div>
			              	</div><!-- /.form group -->
			            </div>
			        </form>
			        <a href="/add-product"><input type="button" class="btn btn-success" value="Tambah Produk" style="margin:10px 0"></a>
		        </div><!-- /.box-body -->

		        <div class="table-responsive">               
		          	<table id="example" class="table table-hover" cellspacing="0" width="100%">
			            <thead>
			            	<tr style='background-color: #3c8dbc;color: white;'>
			                	<th>NO</th>
				                <th>PICTURE</th>
				                <th>NAME</th>
				                <th>MODEL</th>
				                <th>CATEGORY</th>
				                <th>ACTIONS</th>
			              	</tr>
			            </thead>
		            	<tbody>

		            	@foreach($products as $no => $data)
			                <tr>
			                    <td style='text-align:center'>{{ $no+1 }}</td>
			                    <td style='text-align:center'>
			                    	<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
			                    	<img src='{{ url('picture') }}/{{ $data->picture }}' width='200px' height='200px'></a></td>
			                    <td style='text-align:center'>{{ $data->nama }}</td>
			                    <td style='text-align:center'>{{ $data->model }}</td>
			                    <td style='text-align:center'>
			                    	@foreach($data->categories as $index => $category)
										{{ $category->title }}
										@if($index+1 < count($data->categories)),@endif
									@endforeach
			                    </td>
			                    <td width="15%">
			                      	<form class="" action="/product/{{ $data->id }}" method="POST">
			                          	<input type="hidden" name="_method" value="delete">
			                          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			                          	<button type="submit" name="name" class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='DELETE' style="float:left;margin-right: 5px;"><span class='glyphicon glyphicon-trash'></span></button>
			                      	</form>

			                        <a href='/product/{{ $data->id }}/edit' class='btn btn-info' data-toggle='tooltip' data-placement='top' title='EDIT' style="display: inline-block;margin-right: 5px;float:left"><span class='glyphicon glyphicon-edit'></span></a>
			                    </td>
			                </tr>
			            @endforeach

		            	</tbody>
		          	</table>
		        </div>        
			</div>
		</div>
	</div>

	<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
	        <div class="modal-content">
	            <div class="modal-body">
	                <img src="" alt="" />
	            </div>
	        </div>
	    </div>
	</div>

@stop