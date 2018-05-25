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
			
			<table id="document_tracking" class="table table-hovered table-bordered table-stripped">
				
				<thead>
					
						<tr>
							
							<th> Tracking Id </th>

							<th> Request No </th>

							<th> Date Received </th>

							<th> Confirmed </th>


						</tr>


				</thead>

				<tbody>

					<tr>
						
						<td></td>

						<td></td>

						<td></td>

						<td></td>


					</tr>

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