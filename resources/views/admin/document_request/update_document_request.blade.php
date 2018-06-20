@extends('admin.extends')
@section('title','Update Request Document')
@section('content')

<section class="content-header">
    <h1>
        Update Request Documents
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{Route('admin/dashboard')}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Document </li>
      <li class="active"> Update Document Request </li>
    </ol>
</section>

<section class="content">

	<div class="box">

		<div class="box-body">

			<form id="update_request">
					
				{{csrf_field()}}

				<div class="alert alert-danger alert-dismissible" id="create_request_validate_errors" role="role" style="margin-top: 20px;display:none">

			    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			    </div>

			    <div class="alert alert-success alert-dismissible" id="create_request_validate_success" role="role" style="margin-top: 20px;display:none">

			    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			    </div>

			    <div class="row">

			        	<div class="col-md-3 form-group">

				        	<label> Document Category </label>

				        	<select class="form-control document_category">

				        		<option></option>
				        		
				        		@foreach($document_category as $document)

				        			<option value="{{$document->document_no}}">{{$document->document_category}}</option>

				        		@endforeach


				        	</select>
				        	
				        </div>

				        <div class="col-md-3 form-group">

				        	<label> Document # Filter </label>

				        	<input type="text" class="form-control filter_1">
				        	
				        </div>

				        <div class="col-md-3 form-group">

				        	<label> Office Filter </label>

				        	<input type="text" class="form-control filter_2">
				        	
				        </div>

				        <div class="col-md-3 form-group">

				        	<label> Date Created Filter </label>

				        	<input type="text" data-date-format='yyyy-mm-dd' class="form-control filter_3">
				        	
				        </div>
			        	
			        </div>

	

			        <div class="form-group">

			        	<div class="form-group">

			                <label> Request # </label>

			                <input type="text" name="request_no" class="form-control" id="request_no" data-inputmask='"mask": "Request_999-9999"' value="{{$request_no}}" data-mask>

			            </div>
			        	
			        </div>

			        <div class="form-group">

			        	<div class="form-group">

			                <label> Documents </label>

			                @if(!empty($request_documents->document_no))

			                <ul class="list list-inline">

			                	@foreach($request_document as $update_request)

			                		@foreach($update_request::find($update_request->id)->documents as $document)
										<li>
											
											<iframe src="{{storage::url('documents/'.$document->category_documents->document_category.'/'.$update_request->document_no.'/'.$document->document_path)}}" width="70%" height="100%">
											</iframe><br>

											<a href="{{storage::url('documents/'.$document->category_documents->document_category.'/'.$update_request->document_no.'/'.$document->document_path)}}">{{$document->document_path}}</a>
										</li>

			                		@endforeach

			                	@endforeach

			                	<a href="{{url('remove/document/request/'.$request_no)}}" class="btn btn-xs btn-danger"><span class="fa fa-remove"></span></a>

			                </ul>

			                @else

			                <select class="form-control documents" name="document_no[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;"></select>


			                @endif


			              </div>
			        	
			        </div>

			        <div class="form-group">

			        	<div class="form-group">

			                <label> Receiver </label>

			                <input type="text" name="receiver" value="{{$request_documents->receiver}}" class="form-control">

			            </div>
			        	
			        </div>

				    <div class="col-md-offset-5 col-md-4">
				    	
				    	<input type="submit" value="Submit" class="btn btn-primary">

				    </div>

		      </div>


			</form>
			
		</div>
		
	</div>


</section>

<script type="text/javascript">
	
	$(document).ready(function(){

		$('#request_document').DataTable();

		$('.sub-documents').addClass('active');

		$('#sub-request-document').addClass('active');

		$('.filter_3').datepicker();

		$('.documents').select2();

		$('#request_no').inputmask();

		$('#update_request').submit(function(e){

			var update_request 		= $(this).serialize(),
				update_error   		= Input.get('create_request_validate_errors'),
				update_success 		= Input.get('create_request_validate_success');

			$(update_error).html('');

			$.ajax({

				type: 'POST',

				url: "{{url('admin/update/request/validate/'.$request_no)}}",

				data: update_request,

				success:function(data)
				{

					if(data.errors)
					{

						$.each(data.errors, function(key,value){

							$(update_error).show();

							var error = "<ul class='list-unstyled'>"+
										"<li>"+ value +"</li>"+
										"</ul>";

							$(update_error).append(error);

						});
						

					}

					if(data.success)
					{

						$(update_error).html('');

						$(update_error).hide();

						$(update_success).show();

						$(update_success).html('<p></strong>' + data.success + '</strong></p>');

						window.location.href = '/admin/request/update/' + $('#request_no').val();

					}


				}

			});

			e.preventDefault();

		});

	});

</script>


@endsection