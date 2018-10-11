@extends('layout-frontend.default')
@section('content')
	<style type="text/css">
	    th {
	    	text-align: center;
	    }
	    td {
	    	font-size: 12px;
	    }
	    table {
	    	background-color: white;
	    }
	    .form-group {
	    	margin-right: 10px;
	    }
	</style>

	<hr>

	@if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/dashboard') }}"><input type="button" class="btn btn-success" value="Dashboard"></a>
            @else
                <a href="{{ route('login') }}"><input type="button" class="btn btn-success" value="Login"></a>
                <!-- <a href="{{ route('register') }}">Register</a> -->
            @endauth
        </div>
	@endif

	<div class="container">
		<div class="row">
		  	<div class="col-md-12">
		     	<div class="box-body">
		      		<form action="/filter-produk" method="POST" style="float: right">
			            <div class="form-inline">
			              	<div class="form-group">
			                	<div class="input-group">
				                	<div class="input-group-addon"><i class="fa fa-list"></i></div>
					                <select class="form-control" name="filter" style="width: 200px;" required>
					                  	<option value="" disabled selected>FILTER BY CATEGORY</option>
					                   	<option value="All">All Categories</option>
					                    @foreach($kategori as $data)
				                    		<option value='{{ $data->title }}'>{{ $data->title }}</option>
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
		        </div><!-- /.box-body -->
		    </div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
		        <div class="table-responsive">               
		          	<table id="example2" class="table table-hover" cellspacing="0" width="100%">
			            <thead>
			            	<tr style='background-color: #3c8dbc;color: white;'>
				                <th>PICTURE</th>
				                <th>NAME</th>
				                <th>MODEL</th>
				                <th>CATEGORY</th>
			              	</tr>
			            </thead>
		            	<tbody>

		            	@foreach($products as $no => $data)
			                <tr>
			                    <td style='text-align:center'>
			                    	<a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
			                    	<img src='{{ url('picture') }}/{{ $data->picture }}' width='200px' height='200px'></a></td>
			                    <td style='text-align:center'>{{ $data->nama }}</td>
			                    <td style='text-align:center'>{{ $data->model }}</td>
			                    <td style='text-align:center'>{{ $data->kategori }}</td>
			                </tr>
			            @endforeach

		            	</tbody>
		          	</table>
		        </div>        
			</div>
		</div>
	</div>

	<hr>

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