@extends('receiver.receiver_extends')
@section('title','Receiver Dashboard')
@section('content')

	<section class="content-header">
	    <h1>
	        Dashboard
	        <small>Control panel</small>
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{Route('receiver/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active">Dashboard</li>
	    </ol>
	</section>

	<!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <h3 class="box-title">Document Received</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>

        </div>

        <div class="box-body">
		
			<table id="document_tracking_table" class="table table-stripped table-bordered">
							
				<thead>
								
					<tr>
									
						<th> Tracking # </th>

						<th> Request  # </th>

						<th> Requested </th>

						<th> Date Received </th>

						<th> Person Received </th>

						<th> Status </th>

					</tr>

				</thead>

				<tbody>
				
					@foreach($received_documents as $received_document)

					<tr>
									
						<td>
							<a data-toggle="modal" data-target="#approvedDocument_{{$received_document::find($received_document->id)->document_tracking->request_no}}" >
							{{$received_document->tracking_id}}
							</a>
						</td>

						<td>{{$received_document::find($received_document->id)->document_tracking->request_no}}</td>

						<td>
							<label>

								({{$received_document::where('tracking_id',$received_document->tracking_id)->count('count_tracking')}}) times	

							</label>

						</td>

						<td>
							
							{{$received_document::find($received_document->id)->document_tracking->date_received}}

						</td>

						<td>
							
							{{$received_document->person_received}}

						</td>

						<td>
							
							{{Helpers::request_status($received_document->status)}}

						</td>

					</tr>

				</tbody>

				<!-- Modal -->
				<div id="approvedDocument_{{$received_document::find($received_document->id)->document_tracking->request_no}}" class="modal fade" role="dialog">

				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">

				      <div class="modal-header">

				        <h4 class="modal-title">
				        		
				        	{{$received_document->tracking_id}}

				        	<label class="pull-right">

							    {{Helpers::request_status($received_document->status)}}

							</label>

				        </h4>

				      </div>

				      <div class="modal-body">

				      	<!-- modal body -->

				      	<label> Documents Received By </label>

						<label class="pull-right"> Received Date </label>

						<hr>

						<div class="row-fluid">

							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

								@foreach($received_document::where('tracking_id',$received_document->tracking_id)->get() as $receiver_document)

								<div class="panel panel-default">

									<div class="panel-heading" role="tab" id="headingOne">

										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$receiver_document::find($receiver_document->id)->document_tracking->request_no}}_{{$receiver_document->count_tracking}}" aria-expanded="true" aria-controls="collapseOne">
											{{$receiver_document->person_received}}

												<label class="pull-right">

													{{$receiver_document::find($receiver_document->id)->document_tracking->date_received}}

												</label>

											</a>
										</h4>

								    </div>

								    <div id="#collapse_{{$receiver_document::find($receiver_document->id)->document_tracking->request_no}}_{{$receiver_document->count_tracking}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

								    	<div class="panel-body">

								    		<label> Reason for Requesting: </label>

												<p class="pull-right"> {{$receiver_document->reason_requesting}} </p>

											<hr>


											<ul class="list list-unstyled">

											   	<li>

											      	<label> Document Category: </label>

											    	<label class="pull-right">

												   		{{$receiver_document::find($receiver_document->id)->document_tracking->request_document->documents->last()->category_documents->document_category}}
															      				
												   	</label>

												</li>

												<hr>

												<li style="margin-top: 20px;">

															      			<label> Documents Requested: </label>

												@foreach($receiver_document::find($receiver_document->id)->document_tracking->request_documents as $request_docs)

													@foreach($request_docs::find($request_docs->id)->documents as $received_docs)

														<label class="pull-right">
															      				
															{{$received_docs->document_content}}

														</label>  		

													@endforeach

												@endforeach

												</li>


											</ul>
								    		
								    	</div>
								    	
								    </div>

								</div>


								@endforeach

							</div>

						</div>

						<!-- modal body -->

				      </div>

				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>

				    </div>

				  </div>

				</div>
				<!-- End Modal -->

				@endforeach

		</table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        	What

        </div>
        <!-- /.box-footer-->

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->



<script type="text/javascript">
	$(document).ready(function(){

		$('#document_tracking_table').DataTable();

		$('.main-dashboard').addClass('active');
		
	});
</script>

@endsection