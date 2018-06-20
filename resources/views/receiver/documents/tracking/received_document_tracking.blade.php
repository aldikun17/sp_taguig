@extends('receiver.receiver_extends')
@section('title','Documents Received')
@section('content')

	<section class="content-header">
	    <h1>
	        Received Documents
	        <small>Control panel</small>
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{Route('receiver/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active"> Document </li>
	      <li class="active"> <span class="fa fa-file"></span> Recevied </li>
	    </ol>
	</section>

	<section class="content" >

		<div class="box">

			<div class="box-header with-border">
				
				<h3 class="box-title">Document Received</h3>

				<div class="box-tools pull-right">

	            	<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                    	title="Collapse">
	              		<i class="fa fa-minus"></i>
	              	</button>

	          	</div>


			</div>

			<div class="box-body">
				
				<table class="table table-bordered table-striped table-hovered" id="to_received_document">
					
					<thead>
						
						<tr>
							
							<th> Tracking # </th>

							<th> Request  # </th>

							<th> Requested </th>

							<th> Date Received </th>

							<th> Person Received </th>

							<th> Confirmed </th>

							<th> Action </th>

						</tr>

					</thead>

					<tbody>

						@foreach($document_tracking as $tracking)
						
						<tr>
							
							<td>{{$tracking->tracking_id}}</td>

							<td>{{$tracking->request_no}}</td>

							<td> <label> 

									{{empty($tracking::find($tracking->id)->received_documents->where('tracking_id',$tracking->tracking_id)
												  ->count('tracking_id'))
									? '(1)' :
										 $tracking::find($tracking->id)->received_documents->where('tracking_id',$tracking->tracking_id)
												  ->count('tracking_id')}} times

								</label>

							</td>

							<td> {{ empty($tracking->date_received) ? 'Not yet received' : $tracking->date_received }} </td>

							<td> {{ empty($tracking::find($tracking->id)->received_document->person_received) ? 'No receiver' :  $tracking::find($tracking->id)->received_document->person_received}} </td>

							<td>{{Helpers::request_status($tracking->confirmed)}} </td>

							<td>
								
								@if(empty($tracking::find($tracking->id)->received_document->person_received))

									<a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal_{{$tracking->request_no}}"><span class="fa fa-check"></span></a>

									

								@else

									<a class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myReceived_{{$tracking->request_no}}"><span class="fa fa-file"></span></a>

									<a data-toggle="modal" data-target="#myAddNew_{{$tracking->request_no}}" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></a>

								@endif


							</td>

						</tr>

						<!-- Add New Receiver -->

						<div id="myAddNew_{{$tracking->request_no}}" class="modal fade" role="dialog">

							<form id="add_received_document_{{$tracking->request_no}}" method="POST">

							{{csrf_field()}}

							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">

							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>

							        <h4 class="modal-title"> Receiver Documents </h4>

							      </div>

							      <div class="modal-body">

							      	
							      	<div id="received_document_success_{{$tracking->request_no}}" class="alert alert-success alert-dismissible" role="alert" style="display: none">

										<button type="button" class="close" data-dismiss="alert" aria-label="Close">

											<span aria-hidden="true">&times;</span>

										</button>

											
									</div>

									<div id="received_document_warning_{{$tracking->request_no}}" class="alert alert-danger alert-dismissible" role="alert" style="display: none">

										<button type="button" class="close" data-dismiss="alert" aria-label="Close">

											<span aria-hidden="true">&times;</span>
											
										</button>

											
									</div>


							      	<div class="form-group">
							      		
							      		<label> Tracking # </label>

							      		<input type="text" class="form-control" name="tracking_id" value="{{$tracking->tracking_id}}" readonly>

							      	</div>

							      	<div class="form-group">
							      		
							      		<label> Request # </label>

							      		<input type="text" class="form-control" value="{{$tracking->request_no}}" readonly>

							      	</div>

							      	<div class="form-group">
							      		
							      		<label> Person Received </label>

							      		<input type="text" name="person_received" class="form-control">

							      	</div>

							      	<div class="form-group">
							      		
							      		<label> Reason For Requesting </label>

							      		<textarea name="reason_requesting" class="form-control"></textarea>

							      	</div>

							      </div>

							      <div class="modal-footer">

							        <input type="submit" value="Received" class="btn btn-default">

							      </div>

							    </div>

							  </div>

							  </form>

							</div>

						<!-- End Add New Receiver -->

						<!-- Accept Received Document -->

							<div id="myModal_{{$tracking->request_no}}" class="modal fade" role="dialog">

							<form id="received_document_{{$tracking->request_no}}" method="POST">

							{{csrf_field()}}

							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">

							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>

							        <h4 class="modal-title"> Receiver Documents </h4>

							      </div>

							      <div class="modal-body">
							      	
							      	<div id="accept_document_success_{{$tracking->request_no}}" class="alert alert-success alert-dismissible" role="alert" style="display: none">

										<button type="button" class="close" data-dismiss="alert" aria-label="Close">

											<span aria-hidden="true">&times;</span>

										</button>

											
									</div>

									<div id="accept_document_warning_{{$tracking->request_no}}" class="alert alert-danger alert-dismissible" role="alert" style="display: none">

										<button type="button" class="close" data-dismiss="alert" aria-label="Close">

											<span aria-hidden="true">&times;</span>
											
										</button>

											
									</div>


							      	<div class="form-group">
							      		
							      		<label> Tracking # </label>

							      		<input type="text" class="form-control" name="tracking_id" value="{{$tracking->tracking_id}}" readonly>

							      	</div>

							      	<div class="form-group">
							      		
							      		<label> Request # </label>

							      		<input type="text" class="form-control" value="{{$tracking->request_no}}" readonly>

							      	</div>

							      	@if(!empty($tracking::find($tracking->id)->request_document->users))

							      		<div class="form-group">
							      		
								      		<label> Person Received </label>

								      		<input type="text" name="person_received" class="form-control" value="{{$tracking::find($tracking->id)->request_document->users->name}}">

								      		<input type="hidden" name="user_id" value="{{$tracking::find($tracking->id)->request_document->users->user_id}}">

								      	</div>

							      	@else

							      		<div class="form-group">
							      		
								      		<label> Person Received </label>

								      		<input type="text" name="person_received" class="form-control">

								      	</div>

							      	@endif

							      	

							      	<div class="form-group">
							      		
							      		<label> Reason For Requesting </label>

							      		<textarea name="reason_requesting" class="form-control"></textarea>

							      	</div>

							      </div>

							      <div class="modal-footer">

							        <input type="submit" value="Received" class="btn btn-default">

							      </div>

							    </div>

							  </div>

							  </form>

							</div>


						<!-- Ending Accept Received Document -->



						<!-- Received Document -->

						<div id="myReceived_{{$tracking->request_no}}" class="modal fade" role="dialog">

							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">

							      <div class="modal-header">

							        <h4 class="modal-title">

							        	{{$tracking->tracking_id}}

							        	<label class="pull-right">

							        		@if(!empty($tracking::find($tracking->id)->received_document->status))

							        			{{Helpers::request_status($tracking::find($tracking->id)->received_document->status)}}


							        		@endif

							        	</label>

							        </h4>

							      </div>

							      <div class="modal-body">
							      
							      	<label> Documents Received By </label>

							      	<label class="pull-right"> Received Date </label>

							      	<hr>
							      		<div class="row-fluid">

									      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

										      	@foreach($tracking::find($tracking->id)->received_documents as $received_documents)

										      		<div class="panel panel-default">
													    <div class="panel-heading" role="tab" id="headingOne">
													      <h4 class="panel-title">
													        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$tracking->request_no}}_{{$received_documents->count_tracking}}" aria-expanded="true" aria-controls="collapseOne">
													          {{$received_documents->person_received}}
													          <label class="pull-right"> {{$received_documents::find($received_documents->id)->document_tracking->date_received}}</label>
													        </a>
													      </h4>
													    </div>
													    <div id="collapse_{{$tracking->request_no}}_{{$received_documents->count_tracking}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
													      <div class="panel-body">
													        
													      	<label> Reason for Requesting: </label>

													      	<p class="pull-right"> {{$received_documents->reason_requesting}} </p>

													      	<hr>

														      	<ul class="list list-unstyled">

														      	<li>

															      	<label> Document Category: </label>

															    	<label class="pull-right">

															    		{{ucwords($received_documents::find($received_documents->id)->document_tracking->request_document->documents->last()->category_documents->document_category)}}
															      				
															    	</label>

															     </li>

															     <hr>

														      	@foreach($received_documents::find($received_documents->id)->document_tracking->request_documents as $request_docs)

														      	
														      		@foreach($request_docs::find($request_docs->id)->documents as $received_docs)

														      			

															      		<li style="margin-top: 20px;">

															      			<label> Documents Requested: </label>

															      			<label class="pull-right">
															      				
															      				{{$received_docs->document_content}}

															      			</label>

															      		</li>


														      		@endforeach

														      		

														      		

														      	@endforeach

														      	</ul>

													      </div>

													    </div>

													  </div>

										      	@endforeach

									      </div>

									    </div>
							      </div>

							      

							    </div>

							  </div>

							</div>

							<!-- End Display Received Document -->

							<script type="text/javascript">
								
								$("#received_document_{{$tracking->request_no}}").submit(function(e){

									var receive_form 	= $(this).serialize();

									$.ajax({

										type: "POST",

										url: "{{url('receiver/document/received/'.$tracking->request_no)}}",

										data: receive_form,

										dataType: 'json',

										success:function(response){

											var	receive_warning = Input.get("accept_document_warning_{{$tracking->request_no}}"),
												receive_success = Input.get("accept_document_success_{{$tracking->request_no}}");

											$(receive_warning).html('');

											if(response.errors)
											{

												$.each(response.errors,function(key,value){

													var received_error = "<ul class='list list-unstyled'>"+
																			"<li style='margin-top:5px;'>"+ value + "<li>"+
																		 "</ul>";

													$(receive_warning).show();

													$(receive_warning).append(received_error);

												});

											}

											if(response.success)
											{

												$(receive_warning).html('');

												$(receive_warning).hide();

												$(receive_success).show();

												$(receive_success).append("<p>" + response.success + "</p>");

												setTimeout(function(){

												   window.location.reload(1);

												}, 2000);

											}

										}


									});

									e.preventDefault();

								});

								$("#add_received_document_{{$tracking->request_no}}").submit(function(e){

									var add_receive_form 	= $(this).serialize(),
										receive_warning 	= Input.get("received_document_warning_{{$tracking->request_no}}"),
										receive_success 	= Input.get("received_document_success_{{$tracking->request_no}}");


									$.ajax({

										type: "POST",

										url: "{{url('receiver/document/received/'.$tracking->request_no)}}",

										data: add_receive_form,

										dataType: 'json',

										success:function(response){

											$(receive_warning).html('');

											if(response.errors)
											{

												$.each(response.errors,function(key,value){

													var received_error = "<ul class='list list-unstyled'>"+
																			"<li style='margin-top:5px;'>"+ value + "<li>"+
																		 "</ul>";

													$(receive_warning).show();

													$(receive_warning).append(received_error);

												});

											}

											if(response.success)
											{

												$(receive_warning).html('');

												$(receive_warning).hide();

												$(receive_success).show();

												$(receive_success).append("<p>" + response.success + "</p>");

												setTimeout(function(){

												   window.location.reload(1);

												}, 2000);

											}

										}


									});

									e.preventDefault();

								});

							</script>



						@endforeach

					</tbody>

				</table>

			</div>
			
		</div>
		
	</section>

<script type="text/javascript">
	
	$('#to_received_document').dataTable();

	$('.sub-documents').addClass('active');

	$('#sub-document-tracking').addClass('active');
    	


</script>

@endsection