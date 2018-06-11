@extends('admin.extends')
@section('title','Dashboard')
@section('content')


<section class="content-header">
    <h1>
        Document Tracking
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{Route('admin/dashboard')}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Document </li>
      <li class="active"> Document Tracking </li>
    </ol>
</section>



<section class="content">
	
	<div class="box">

		<div class="box-body">

			@if(Session('approved_success'))

				<div class="alert alert-success alert-dismissible" role="alert">

					<button type="button" class="close" data-dismiss="alert" aria-label="Close">

						<span aria-hidden="true">&times;</span>

					</button>
					
					<p> {{Session('approved_success')}} </p>

				</div>

			@endif
			
			<table id="document_tracking" class="table table-hovered table-bordered table-stripped">
				
				<thead>
					
						<tr>
							
							<th> Tracking # </th>

							<th> Request # </th>

							<th> Date Received </th>

							<th> Person Receiving </th>

							<th> Status </th>

							<th> Action </th>


						</tr>


				</thead>

				<tbody>

					@foreach($received_document as $received)

					<tr>
						
						<td><a data-toggle="modal" data-target="#iReceived_{{$received::find($received->id)->document_tracking->request_no}}_{{$received->count_tracking}}">{{$received->tracking_id}}</a></td>

						<td>{{$received::find($received->id)->document_tracking->request_no}}</td>

						<td>{{$received::find($received->id)->document_tracking->date_received}}</td>

						<td>{{$received->person_received}}</td>

						<td>{{Helpers::request_status($received->status)}}</td>

						<td>
							
							<a href="{{url('receiver/approved/document/received/'. $received::find($received->id)->document_tracking->request_no .'/'. $received->count_tracking )}}" onclick="return confirm('Are you sure you want to approved this {{$received->tracking_id}}')" class="btn btn-default btn-xs"><span class="fa fa-check"></span></a>

							<a href="{{url('received/delete/document/received/'. $received::find($received->id)->document_tracking->request_no  .'/'. $received->count_tracking)}}" onclick="return confirm('Are you sure you want to reject this {{$received->tracking_id}}')" class="btn btn-danger btn-xs"> <span class="fa fa-remove"></span> </a>

						</td>


					</tr>

					<div id="iReceived_{{$received::find($received->id)->document_tracking->request_no}}_{{$received->count_tracking}}" class="modal fade" role="dialog">

					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">

					      <div class="modal-header">

					        <h4 class="modal-title">

					        	{{$received->tracking_id}}

					        	<p class="pull-right">

								    {{Helpers::request_status($received->status)}}

								</p>

					        </h4>

					      </div>

					      <div class="modal-body">

					        <label> Documents Received By </label>

					        <label class="pull-right"> Received Date </label>

							<hr>

							<div class="row-fluid">

								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

									<div class="panel panel-default">

										<div class="panel-heading" role="tab" id="headingOne">
										    <h4 class="panel-title">
											    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$received->count_tracking}}" aria-expanded="true" aria-controls="collapseOne">
											    {{$received->person_received}}
											    <label class="pull-right"> {{$received::find($received->id)->document_tracking->date_received}}</label>
											    </a>
											</h4>
										</div>

										<div id="collapse_{{$received->count_tracking}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

											<div class="panel-body">

												<label> Reason for Requesting: </label>

												<p class="pull-right"> {{$received->reason_requesting}} </p>

												<hr>

												<ul class="list list-unstyled">

													@foreach($received->document_tracking->request_document->documents as $documents)

													<li>

														<label> Document Category </label>

															<label class="pull-right">

																{{$documents->category_documents->document_category}}
															    
															</label>

													</li>

													<li style="margin-top: 20px;">

														<label> Documents Requested: </label>

														<label class="pull-right">

														      {{$documents->document_content}}

														</label>

													</li>

													@endforeach

												</ul>

											</div>

										</div>



									</div>

								</div>

							</div>

					      </div>

					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>

					    </div>

					  </div>

					</div>

					@endforeach

				</tbody>


			</table>

		</div>

		<div class="box-footer">
			asdasd
		</div>

		
	</div>


</section>


<script type="text/javascript">
	
	$(document).ready(function(){

		$('#document_tracking').DataTable();

		$('.sub-documents').addClass('active');

		$('#sub-document-tracking').addClass('active');

	});

</script>

@endsection