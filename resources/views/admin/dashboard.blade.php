@extends('admin.extends')
@section('title','Dashboard')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
	    <h1>
	        Dashboard
	        <small>Control panel</small>
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active">Dashboard</li>
	    </ol>
	</section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">

          <h3 class="box-title">Document Tracking</h3>

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

						<th> Request # </th>

						<th> Document </th>

						<th> Date Received </th>

						<th> Name </th>

						<th> Title And Content </th>

					</tr>


				</thead>

				<tbody>
				
					@foreach($document_tracking as $tracking)

					<tr>
									
						<td></td>

						<td></td>

						<td></td>

						<td></td>

						<td></td>

					</tr>

					@endforeach

				</tbody>

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