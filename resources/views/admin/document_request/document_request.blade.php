@extends('admin.extends')
@section('title','Request Document')
@section('content')

<section class="content-header">
    <h1>
        Request a Documents
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{Route('admin/dashboard')}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Document </li>
      <li class="active"> Request </li>
    </ol>
</section>

<section class="content">

	<div class="box">

		<div class="box-body">

			@if(Session('update_request'))

				<div class="box-header with-border">
					
					<div class="alert alert-success alert-dismissible" role="alert">

						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						{{Session('update_request')}}
						
					</div>

				</div>

			@endif

			@if(Session('document_success'))

				<div class="box-header with-border">
					
					<div class="alert alert-success alert-dismissible" role="alert">

						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						{{Session('document_success')}}
						
					</div>

				</div>

			@endif

			@if(Session('soft_delete'))

				<div class="box-header with-border">
					
					<div class="alert alert-danger alert-dismissible" role="alert">

						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						{{Session('soft_delete')}}
						
					</div>

				</div>

			@endif


			<table id="request_document" class="table table-hovered table-stripped table-bordered">

				<thead>
					
					<tr>
						
						<th> Request No </th>

						<th> Document No </th>

						<th> Requestor </th>

						<th> Status </th>

						<th> Action </th>


					</tr>

				</thead>

				<tbody>

					@foreach($request_document as $request)

					@if($request->soft_delete == 0)

						<tr style="background: red">
							
							<td><a>{{$request->request_no}}</a></td>

							<td>{{$request->document_no}}</td>

							<td>{{$request->receiver}}</td>

							<td>{{Helpers::request_status($request->status)}}</td>

							<td>
								<a href="{{url('request/document/recover/'.$request->request_no)}}" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure you want to recover this item')"><span class="fa fa-link"></span></a>
								<a href="" class="btn btn-danger btn-xs"><span class="fa fa-remove"></span></a>
							</td>


						</tr>

					@else


						<tr>
							
							<td><a>{{$request->request_no}}</a></td>

							<td>{{$request->document_no}}</td>

							<td>{{$request->receiver}}</td>

							<td>{{Helpers::request_status($request->status)}}</td>

							<td>

								@if($request->status == 0)

									<a  data-toggle="modal" data-target="#myModal_{{$request->request_no}}" class="btn btn-success btn-xs">

										<span class="fa fa-check"></span>

									</a>

									@if(empty($request->request_no))

										<a href="{{Url('admin/request/user/'.$request->user_id)}}" class="btn btn-primary btn-xs">

											<span class="fa fa-edit"></span>

										</a>

									@else

										<a href="{{Url('admin/request/update/'.$request->request_no)}}" class="btn btn-primary btn-xs">

											<span class="fa fa-edit"></span>

										</a>

									@endif

									<a href="{{url('request/document/delete/'.$request->request_no)}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to temporarily delete this item')" >

										<span class="fa fa-remove"></span>

									</a>

								@else

								<a  data-toggle="modal" data-target="#myModal_{{$request->request_no}}" class="btn btn-primary btn-xs"><span class="fa fa-file"></span></a>

								@endif
								
							</td>

						</tr>

					<div class="modal fade" id="myModal_{{$request->request_no}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

					  <div class="modal-dialog" role="document">

					  	<form id="document_tracking_{{$request->request_no}}">

					  		{{csrf_field()}}

						    <div class="modal-content">

						      <div class="modal-header">

						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

						        	<span aria-hidden="true">&times;</span>

						        </button>

						        <h4 class="modal-title" id="myModalLabel">Document For Approval</h4>

						        <div class="alert alert-danger alert-dismissible" id="tracking_validate_{{$request->request_no}}" role="role" style="margin-top: 20_{{$request->request_no}}px;
						        display: none">

						        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						        </div>

						        <div class="alert alert-success alert-dismissible" id="tracking_success_{{$request->request_no}}" role="role" style="margin-top: 20px;display:none">

						        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						        </div>


						      </div>

						      <div class="modal-body">
						       
							      	<div class="form-group">

							      		<div class="form-group">
							      			
							      			<label> Request # </label>

							      				<input type="text" name="request_no" class="form-control" placeholder="Enter Request No" value="{{$request->request_no}}" readonly >

							      		</div>
							      		
							      	</div>

							      	@if(!empty($request::find($request->id)->document_tracking))

							      		<div class="form-group">

								      		<div class="form-group">
								      			
								      			<label> Tracking # </label>

								      				<input type="text" name="tracking_id" class="form-control" id="tracking_no_{{$request->request_no}}"  data-inputmask='"mask": "tr_#{{$year}}-{{$month}}-99999"' data-mask class=""
								      				value="{{$request::find($request->id)->document_tracking->tracking_id}}" readonly>

								      		</div>
								      		
								      	</div>

								    @else

								    	<div class="form-group">

								      		<div class="form-group">
								      			
								      			<label> Tracking # </label>

								      				<input type="text" name="tracking_id" class="form-control" id="tracking_no_{{$request->request_no}}"  data-inputmask='"mask": "tr_#{{$year}}-{{$month}}-99999"' data-mask class="" >

								      		</div>
								      		
								      	</div>

							      	@endif

							      	<div class="form-group">

							      		<div class="form-group">
							      		
							      			<ul class="list list-unstyled">

							      				@foreach($request::where('request_no',$request->request_no)->groupBy('request_no')->first()->documents as $document_categories)

							      				<li> <label> Document Category </label> </li>

							      					<li style="margin-bottom:15px;">
							      						<select class="form-control">
							      							
							      							<option>

							      								{{$document_categories->category_documents->document_category}}
							      								

							      							</option>

							      						</select>

							      					</li>

							      				@endforeach

							      				@foreach($request::where('request_no',$request->request_no)->get() as $documents)

							      					@foreach($documents::find($documents->id)->documents as $document_approved)

							      					<li> <label> Document Requested </label> </li>

							      					<li style="margin-bottom:15px;">
							      					
							      						<input value="{{$document_approved->document_content}}" disabled class="form-control" >

							      					</li>


							      					@endforeach


							      				@endforeach



							      			</ul>

							      		</div>
							      		
							      	</div>


						      </div>

						      @if(empty($request::find($request->id)->document_tracking))

						      <div class="modal-footer">

						        <button type="submit" class="btn btn-primary">Save changes</button>

						      </div>

						      @endif

						    </div>

					    </form>

					  </div>

					</div>

					<script type="text/javascript">
						
						$(document).ready(function(){

							$('#tracking_no_{{$request->request_no}}').inputmask();

							$("#document_tracking_{{$request->request_no}}").submit(function(e){

								var tracking_form 	 = $(this).serialize();

								$.ajax({

									type: 'POST',

									url:      "{{url('admin/document/request/tracking/'.$request->request_no)}}",

									dataType: 'json',

									data: 	  tracking_form,

									success: function(data){

										var tracking_error   = Input.get('tracking_validate_{{$request->request_no}}'),
											tracking_success = Input.get('tracking_success_{{$request->request_no}}');

										$(tracking_error).html('')

										if(data.errors)
										{

											$.each(data.errors,function(key,value){

												var tracking_errors = "<ul class='list list-unstyled'>"+
															 			"<li>"+ value + "</li>"+
															 		  "</ul>";

												$(tracking_error).show();

												$(tracking_error).append(tracking_errors);

											})


										}

										if(data.success)
										{

											$(tracking_error).html('');
											
											$(tracking_error).hide();

											$(tracking_success).show()

											$(tracking_success).html("<label><strong>" + data.success + "</strong></label>");

											setTimeout(function(){

												window.location.reload(1);

											}, 1000);

										}


									}



								});

								e.preventDefault();

							});

						});

					</script>


					@endif

					@endforeach

				</tbody>
				
			</table>
			
		</div>


		<div class="modal fade bs-example-modal-lg" id="myRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog modal-lg" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		        <h4 class="modal-title" id="myModalLabel">Request Document</h4>

		      </div>

		      <div class="modal-body">

		      	<form id="document_request">

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

			                <input type="text" name="request_no" class="form-control" id="request_no" data-inputmask='"mask": "Request_999-9999"' data-mask>

			            </div>
			        	
			        </div>

			        <div class="form-group">

			        	<div class="form-group">

			                <label> Documents </label>

			                <select class="form-control documents" name="document_no[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
			                  
			                </select>

			              </div>
			        	
			        </div>

			        <div class="form-group">

			        	<div class="form-group">

			                <label> Receiver </label>

			                <input type="text" name="receiver" class="form-control">

			            </div>
			        	
			        </div>

		      </div>

		      <div class="modal-footer">

		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

		        <button  type="submit" class="btn btn-primary">Save changes</button>

		        </form>

		      </div>

		    </div>

		  </div>

		</div>


		<div class="box-footer">

			<div class="col-xs-2">
				
				<a data-toggle="modal" data-target="#myRequest"

							   class="btn btn-primary pull-right request_document">

								<span class="fa fa-plus"></span>

								 Request a Document

							</a>

			</div>
			
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

		$('#document_request').submit(function(e){

			var request_form = $(this).serialize();

			$.ajax({

				type: 'POST',

				url: "{{Route('request/document')}}",

				dataType: 'json',

				data: request_form,

				success: function(data)
				{

					var request_errors   = Input.get('create_request_validate_errors'),
						request_success  = Input.get('create_request_validate_success');

					$(request_errors).html('');

					if(data.errors)
					{

						$.each(data.errors,function(key,value){

							var errors = "<ul class='list list-unstyled'>"+
										 "<li>"+ value + "</li>"+
										 "</ul>";

							$(request_errors).show();
							$(request_errors).append(errors);

						});

					}

					if(data.Success)
					{

						$(request_errors).html('');

						$(request_errors).hide('');

						$(request_success).show();

						$(request_success).html('<p><strong>' + data.Success + '</strong></p>');

						setTimeout(function(){

							window.location.reload(1);

						}, 2000);

						Input.get('document_request').reset();

					}
				}
			});

			e.preventDefault();

		});


	});

</script>


@endsection