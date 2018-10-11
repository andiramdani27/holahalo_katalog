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
		  	<div class="col-md-11">
		  		<a href="/add-category"><input type="button" class="btn btn-success" value="Tambah Kategori" style="margin:10px 0"></a>

		        <div class="table-responsive">               
		          	<table id="example" class="table table-hover" cellspacing="0" width="100%">
			            <thead>
			            	<tr style='background-color: #3c8dbc;color: white;'>
			                	<th>NO</th>
				                <th>CATEGORY NAME</th>
				                <th>DESCRIPTION</th>
				                <th>ACTIONS</th>
			              	</tr>
			            </thead>
		            	<tbody>

		            	@foreach($categories as $no => $data)
			                <tr>
			                    <td style='text-align:center'>{{ $no+1 }}</td>
			                    <td style='text-align:center'>{{ $data->title }}</td>
			                    <td style='text-align:center'>{{ $data->description }}</td>
			                    <td width="15%">
			                      	<form class="" action="/category/{{ $data->id }}" method="POST">
			                          	<input type="hidden" name="_method" value="delete">
			                          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			                          	<button type="submit" name="name" class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='DELETE' style="float:left;margin-right: 5px;"><span class='glyphicon glyphicon-trash'></span></button>
			                      	</form>

			                        <a href='/category/{{ $data->id }}/edit' class='btn btn-info' data-toggle='tooltip' data-placement='top' title='EDIT' style="display: inline-block;margin-right: 5px;float:left"><span class='glyphicon glyphicon-edit'></span></a>
			                    </td>
			                </tr>
			            @endforeach

		            	</tbody>
		          	</table>
		        </div>        
			</div>
		</div>
	</div>

@stop