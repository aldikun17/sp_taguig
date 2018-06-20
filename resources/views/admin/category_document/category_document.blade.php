@extends('admin.extends')
@section('title','Dashboard')
@section('content')

<script type="text/javascript">

$(document).ready(function(){

	$('#document_posting').submit(function(e){

		var document_form = $(this).serialize(),
			alert 		  = Input.get('document_validate_error'),
			success 	  = Input.get('document_validate_success');

		$.ajax({
			type: 'POST',
			url:  "{{Route('register/document')}}",
			dataType:"json",
			data: document_form,
			success: function(data){

				$(alert).html('');

				if(data.errors)
				{

					$.each(data.errors,function(key,value){

						var html = "<ul class='list list-unstyled'>"+
								   "<li>" + value + "</li>"+
								   "</ul>";

						$(alert).show();
						$(alert).append(html);

					});

				}

				if(data.success)
				{
					$(alert).html('');
					$(alert).hide();

					$(success).show();
					$(success).html('<p>' + data.success  + '</p>');

					setTimeout(function(){
					   window.location.reload(1);
					}, 2000);

					Input.get('document_posting').reset();
				}

			}

		});

		e.preventDefault();

	});

});

</script>

<section class="content-header">
    <h1>
        Document Categories
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Document </li>
      <li class="active"> Document Category </li>
    </ol>
</section>

<section class="content">
	
	<div class="box">

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

		<div class="box-body">

			<table class="table table-stripped table-bordered table-hover" id="category_document_table">

				<thead>

					<tr>
						
						<th colspan="3">

							<a data-toggle="modal" data-target="#myModal" class="btn btn-primary pull-right"> Add New Category </a>

						</th>

					</tr>
					
					<tr>
						
						<th> Document No </th>

						<th> Document Category </th>

						<th> Action </th>

					</tr>

				</thead>

				<tbody>

				@foreach($category_document as $documents)

						<tr>
							
							@if($documents->soft_delete == 0)
						
								<td style="background: red">{{$documents->document_no}}</td>

								<td style="background: red">{{ucwords($documents->document_category)}}</td>

								<td style="background: red">

									<a href="{{url('document/category/recover/'.$documents->document_no)}}" class="btn btn-primary btn-xs"><span class="fa fa-link"></span></a>

								</td>

							@else

								<td>{{$documents->document_no}}</td>

								<td>{{ucwords($documents->document_category)}}</td>

								<td>
										
									<a  data-toggle="modal" data-target="#myModal_{{$documents->document_no}}" class="btn btn-xs btn-primary document_{{$documents->document_no}}"><span class="fa fa-edit"></span></a>
									<a href="{{url('document/category/delete/'.$documents->document_no)}}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to temporarily delete this item')"><span class="fa fa-remove"></span></a>

								</td>

							@endif

						</tr>

						<div class="modal fade" id="myModal_{{$documents->document_no}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

						<script type="text/javascript">
							
							$(document).ready(function(){

								$(".document_{{$documents->document_no}}").click(function(){

									$.ajax({
										type: 'GET',
										url : "{{url('admin/document/'.$documents->document_no)}}",
										dataType: 'json',
										success: function(data)
										{
										
											$("#update_document_category_{{$documents->document_no}}").val(data.document_category);

											$("#update_document_no_{{$documents->document_no}}").val(data.document_no);
										}

									});

								});

								$("#document_category_update_{{$documents->document_no}}").submit(function(e){

									var update_document_form = $(this).serialize(),
										update_alert		 = Input.get("update_document_validate_error_{{$documents->document_no}}"),
										update_sucess 		 = Input.get("update_document_validate_success_{{$documents->document_no}}");

									$.ajax({
										type: 'POST',
										url : "{{url('admin/document/update/'.$documents->document_no)}}",
										dataType: 'json',
										data: update_document_form,
										success:function(data){

											$(update_alert).html('');

											console.log(data.errors);

											if(data.errors)
											{

												$.each(data.errors,function(key,value){

													var html = "<ul class='list list-unstyled'>"+
															   "<li>" + value + "</li>"+
															   "</ul>";

													$(update_alert).show();
													$(update_alert).append(html);

												});

											}

											if(data.success)
											{
												$(update_alert).html('');
												$(update_alert).hide();

												$(update_sucess).show();
												$(update_sucess).html('<p>' + data.success  + '</p>');

												setTimeout(function(){
												   window.location.reload(1);
												}, 2000);

											}


										}

									});

									e.preventDefault();

								});
							});

						</script>

						<form id="document_category_update_{{$documents->document_no}}" method="POST">

						  <div class="modal-dialog" role="update_document">

						    <div class="modal-content">

						      <div class="modal-header">

						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel"> Update Document Category</h4>

						      </div>

						      <div class="modal-body">

									{{csrf_field()}}

									<div class="alert alert-danger alert-dismissible" id="update_document_validate_error_{{$documents->document_no}}" role="role" style="margin-top: 20px;display:none">
							        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        </div>

							        <div class="alert alert-success alert-dismissible" id="update_document_validate_success_{{$documents->document_no}}" role="role" style="margin-top: 20px;display:none">
							        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        </div>

									<div class="form-group">

					                  <label> Document No: </label>

					                  <input type="text" name="document_no" class="form-control update_document_no_{{$documents->document_id}}" id="update_document_no_{{$documents->document_no}}" placeholder="Enter Document No">
					                  
					                </div>


									<div class="form-group">

					                  <label> Category Name </label>

					                  <input type="text" name="document_category" class="form-control update_document_category_{{$documents->document_no}}" id="update_document_category_{{$documents->document_no}}" placeholder="Enter Document Category">
					                  
					                </div>


						      </div>

						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button  type="submit" class="btn btn-primary">Save changes</button>
						      </div>

						    </div>

						  </div>

						</div>

						</form>


				@endforeach
					
					
				</tbody>
				
			</table>
			
		</div>
		
	</div>

	<form id="document_posting" method="POST">

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	  <div class="modal-dialog" role="document">

	    <div class="modal-content">

	      <div class="modal-header">

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">New Document Category</h4>

	      </div>

	      <div class="modal-body">

				{{csrf_field()}}

				<div class="alert alert-danger alert-dismissible" id="document_validate_error" role="role" style="margin-top: 20px;display:none">
		        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        </div>

		        <div class="alert alert-success alert-dismissible" id="document_validate_success" role="role" style="margin-top: 20px;display:none">
		        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        </div>

				<div class="form-group">

                  <label> Document No: </label>

                  <input type="text" name="document_no" class="form-control" id="document_no" placeholder="Enter Document No">
                  
                </div>


				<div class="form-group">

                  <label> Category Name </label>

                  <input type="text" name="document_category" class="form-control" id="category_name" placeholder="Enter Document Category">
                  
                </div>


	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button  type="submit" class="btn btn-primary">Save changes</button>
	      </div>

	    </div>

	  </div>

	</div>

	</form>

</section>

<script type="text/javascript">
	
	$(function(){

		$('#category_document_table').DataTable();

		$('.sub-documents').addClass('active');

		$('#sub-create-category-document').addClass('active');

	});

</script>

@endsection