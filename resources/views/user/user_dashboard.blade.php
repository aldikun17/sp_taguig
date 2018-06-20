@extends('user.user_extends')
@section('title','User Dashboard')
@section('content')

<section class="content-header">
	    <h1>
	        Dashboard
	        <small>Control panel</small>
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{Route('user/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active">Dashboard</li>
	    </ol>
	</section>

<section class="content">

	<div class="box">

        <div class="box-header with-border">

          <h3 class="box-title"> My Document Received</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>

        </div>

        <div class="box-body">

        	<table id="myReceivedDocuments" class="table table-striped table-bordered table-bordered">
        		
        		<thead>
        			
        			<tr>
        				
        				<th> Tracking # </th>

        				<th> Request # </th>

                        <th> Person Received </th>

        				<th> Date Received </th>

        			</tr>

        		</thead>

        		<tbody>
        			
        			@foreach($received_document as $received_docs)

        			<tr>
        				
        				<td> <a data-toggle="modal" data-target="#myModal_{{$received_docs->user_id}}"> {{$received_docs->tracking_id}} </a> </td>

        				<td> {{$received_docs->document_tracking->request_document->request_no}} </td>

        				<td> {{$received_docs->person_received}} </td>

        				<td> {{$received_docs->created_at}} </td>

                        <!-- <td> <a href="{{url('user/document/request/'.$received_docs->user_id)}}" class="btn btn-xs btn-default"><i class="fa fa-download" aria-hidden="true" ></i> download </a> </td> -->

        			</tr>

                    <div id="myModal_{{$received_docs->user_id}}" class="modal fade" role="dialog">

                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">

                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"> Downloads </h4>
                          </div>

                          <div class="modal-body">


                                @foreach($received_docs::find($received_docs->id)->document_trackings->request_documents as $document_request)

                                    @foreach($document_request::find($document_request->id)->documents as $docs)

                                    <div class="form-group well">

                                        <label>{{$docs->document_content}}</label>

                                        <div class="pull-right">
                                            
                                            <a href="{{url('user/document/downloads/'.$received_docs->user_id.'/'.$docs->document_no)}}"><i class="fa fa-download" aria-hidden="true"></i>Download</a>

                                        </div>
                                        
                                    </div>


                                    @endforeach

                                @endforeach

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

    </div>
	
</section>

<script type="text/javascript">

	$(document).ready(function(){

		$('#myReceivedDocuments').DataTable();

		$('.main-dashboard').addClass('active');

	});
	
</script>
@endsection