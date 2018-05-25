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

							<th> Date Received </th>

							<th> Person Received </th>

							<th> Action </th>

						</tr>

					</thead>

					<tbody>

						@foreach($document_tracking as $tracking)
						
						<tr>
							
							<td>{{$tracking->tracking_id}}</td>

							<td>{{$tracking->request_no}}</td>

							<td>{{ empty($tracking->date_received) ? 'Not Yet Recieved' : ''}}</td>

							<td> Not Yet Received </td>

							<td>
								
								<a href="#" class="btn btn-primary btn-xs"><span class="fa fa-check"></span></a>

							</td>

						</tr>

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