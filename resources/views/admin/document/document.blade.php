@extends('admin.extends')
@section('title','Dashboard')
@section('content')

<section class="content-header">
    <h1>
        Documents
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{Route('admin/dashboard')}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Document </li>
      <li class="active"> Documents </li>
    </ol>
</section>


<section class="content">

	<div class="box">

		<div class="box-body">

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
			
			<table id="all_document" class="table table-bordered table-stripped table-hovered">
				
				<thead>

					<tr>
						
						<th colspan="6"> <a  href="{{Route('document_create')}}" class="btn btn-primary pull-right"> Create Document </a> </th>

					</tr>
					
					<tr>
						
						<th> Document Category </th>

						<th> Document No </th>

						<th> Office </th>

						<th> Name </th>

						<th> Document Content </th>

						<th> Action </th>

					</tr>

				</thead>

				<tbody>
					
					@foreach($documents as $document)

					@if($document->soft_delete == 0)

						<tr style="background: red">
							
							<td> {{$document::find($document->id)->category_documents->document_category}} </td>

							<td> {{$document->document_no}} </td>

							<td> {{$document->office}} </td>

							<td> {{$document->name}} </td>

							<td> {{$document->document_content}} </td>

							<td>

								<a href="{{url('document/recover/'.$document->document_no)}}" class="btn btn-xs btn-primary"><span class="fa fa-link" ></span></a>

							</td>


						</tr>

					@else

						<tr>
							
							<td> {{$document::find($document->id)->category_documents->document_category}} </td>

							<td> {{$document->document_no}} </td>

							<td> {{$document->office}} </td>

							<td> {{$document->name}} </td>

							<td> {{$document->document_content}} </td>

							<td>

								<a data-toggle="modal" data-target="#myUpdateDocuments_{{$document->document_no}}"
									class="btn btn-xs btn-primary update_document_{{$document->document_no}}"> <i class="fa fa-edit"></i></a>

								<a href="{{url('document/delete/'.$document->document_no)}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to temporarily delete this item')"><span class="fa fa-remove"></span></a>

							</td>


						</tr>


					@endif

					<script type="text/javascript">
						
						$(document).ready(function(){

							$(".update_document_{{$document->document_no}}").click(function(){

								$.ajax({
									type: "GET",
									dataType : "json",
									url: "{{url('update/created/document/'.$document->document_no)}}",
									success:function(data){

										$('#document_no_{{$document->document_no}}').val(data.document_no);

										$('#office_{{$document->document_no}}').val(data.office);

										$('#name_{{$document->document_no}}').val(data.name);

										$('#document_content_{{$document->document_no}}').val(data.document_content);

									}
								});

							});


							$("#update_created_document_{{$document->document_no}}").submit(function(e){

								var update_create_document = $(this).serialize(),

									update_create_error	   = Input.get('update_document_validate_error'),

									update_create_success  = Input.get('update_document_validate_success');

								$.ajax({

									type: 'POST',

									url: "{{url('update/created/document/'.$document->document_no)}}",

									dataType: 'json',

									data: update_create_document,

									success: function(data){

										$(update_create_error).html('');

										if(data.errors)
										{

											$.each(data.errors,function(key,value){

												var errors = "<ul class='list list-inline'>"+
															 "<li>"+ value + "</li>"+
															 "</ul>";

												$(update_create_error).show();

												$(update_create_error).append(errors);


											});

										}

										if(data.success)
										{

											$(update_create_error).html('');

											$(update_create_error).hide();

											$(update_create_success).show();

											$(update_create_success).html('<p>' + data.success + '</p>');

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

						<div class="modal fade" id="myUpdateDocuments_{{$document->document_no}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

						<form id="update_created_document_{{$document->document_no}}" method="POST">

						  <div class="modal-dialog" role="update_document">

						    <div class="modal-content">

						      <div class="modal-header">

						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						        <h4 class="modal-title" id="myModalLabel">New Document Category</h4>

						      </div>

						      <div class="modal-body">

									{{csrf_field()}}

									<div class="alert alert-danger alert-dismissible" id="update_document_validate_error" role="role" style="margin-top: 20px;display:none">

							        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

							        </div>

							        <div class="alert alert-success alert-dismissible" id="update_document_validate_success" role="role" style="margin-top: 20px;display:none">

							        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

							        </div>

							        <div class="form-group">

					                  <label> Document Category </label>

					                  <select name="document_category_id" class="form-control">

					                  	<option></option>

					                  	@foreach($category_document as $documents)


					                  		<option value="{{$documents->document_no}}"> {{$documents->document_category}}   </option>


					                  	@endforeach

					                  </select>
					                  
					                </div>

									<div class="form-group">

					                  <label> Document No: </label>

					                  <input type="text" name="document_no" class="form-control" id="document_no_{{$document->document_no}}" placeholder="Enter Document No">
					                  
					                </div>


									<div class="form-group">

					                  <label> Office </label>

					                  <input type="text" name="office" class="form-control" id="office_{{$document->document_no}}" placeholder="Enter Office From">
					                  
					                </div>

					                <div class="form-group">

					                  <label> Name </label>

					                  <input type="text" name="name" class="form-control" id="name_{{$document->document_no}}" placeholder="Enter Receiver Name">
					                  
					                </div>

					                <div class="form-group">

					                  <label>Document Content </label>

					                  <textarea name="document_content" class="form-control" id="document_content_{{$document->document_no}}" rows="3" placeholder="Document Content ..."></textarea>

					                </div>

						      </div>

						      <div class="modal-footer">
						        <button  type="submit" class="btn btn-primary">Save changes</button>
						      </div>

						    </div>

						  </div>

						</form>

						</div>


					@endforeach


				</tbody>


			</table>

		</div>

		<form id="CreateDocuments" method="POST" >

		<div class="modal fade" id="myDocuments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		        <h4 class="modal-title" id="myModalLabel">New Document Category</h4>

		      </div>

		      <div class="modal-body">

					{{csrf_field()}}

					<div class="alert alert-danger alert-dismissible" id="create_document_validate_error" role="role" style="margin-top: 20px;display:none">

			        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			        </div>

			        <div class="alert alert-success alert-dismissible" id="create_document_validate_success" role="role" style="margin-top: 20px;display:none">

			        	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			        </div>

			        <div class="form-group">

	                  <label> Document Category </label>

	                  <select name="document_category_id" class="form-control">

	                  	<option></option>

	                  	@foreach($category_document as $documents)

	                  		<option value="{{$documents->document_no}}"> {{$documents->document_category}}   </option>


	                  	@endforeach

	                  </select>
	                  
	                </div>

					<div class="form-group">

	                  <label> Document No: </label>

	                  <input type="text" name="document_no" class="form-control" id="document_no" placeholder="Enter Document No">
	                  
	                </div>


					<div class="form-group">

	                  <label> Office </label>

	                  <input type="text" name="office" class="form-control" id="category_name" placeholder="Enter Office From">
	                  
	                </div>

	                <div class="form-group">

	                  <label> Name </label>

	                  <input type="text" name="name" class="form-control" id="category_name" placeholder="Enter Receiver Name">
	                  
	                </div>

	                <div class="form-group">

	                  <label>Document Content </label>

	                  <textarea name="document_content" class="form-control" rows="3" placeholder="Document Content ..."></textarea>

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

	</div>

</section>




<script type="text/javascript">
	
	$(document).ready(function(){

		$('#all_document').DataTable();

		$('.sub-documents').addClass('active');

		$('#sub-create-document').addClass('active');

		$('#CreateDocuments').submit(function(e){

			var create_document_form = $(this).serialize(),

				create_error 		 = Input.get('create_document_validate_error'),

				create_success 		 = Input.get('create_document_validate_success');

				$.ajax({

					type: 'POST',

					url:  "{{Route('document/create')}}",

					dataType: 'json',

					data: create_document_form,

					success: function(data)
					{

						$(create_error).html('');

						if(data.errors)
						{

							$.each(data.errors,function(key,value){

								var value = "<ul class='list list-unstyled'>"+
											"<li>"+ value + "</li>"+
											"</ul>";

								$(create_error).show();

								$(create_error).append(value);


							});

						}

						if(data.success)
						{


							$(create_error).html('');

							$(create_error).hide();

							$(create_success).show();

							$(create_success).html('<p>' + data.success + '</p>');

							setTimeout(function(){

							   window.location.reload(1);

							}, 2000);

							Input.get('CreateDocuments').reset();	

						}

					}


				});

			e.preventDefault();

		});


	});


</script>

@endsection