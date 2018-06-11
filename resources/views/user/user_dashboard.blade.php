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

        				<th> Date Received </th>

        				<th> Person Received </th>

        			</tr>

        		</thead>

        		<tbody>
        			
        			@foreach($received_document as $received_docs)

        			<tr>
        				
        				<td> {{$received_docs->tracking_id}} </td>

        				<td></td>

        				<td></td>

        				<td></td>

        			</tr>

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