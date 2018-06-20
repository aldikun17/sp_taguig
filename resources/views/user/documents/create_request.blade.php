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
	    <li class="active">Document</li>
	    <li class="active">Request</li>
	</ol>
</section>

<section class="content">
	
	<div class="box">

		<div class="box-header with-border">

			<h3 class="box-title"> Documents</h3>

	          	<div class="box-tools pull-right">
	            	<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
	                    title="Collapse">
	              	<i class="fa fa-minus"></i></button>

	          	</div>


		</div>

		<div class="box-body">

				<form id="documents">

					{{csrf_field()}}

					<div class="col-md-6">
						
						<input type="text" id="filter" class="form-control" placeholder="Search Filter">

					</div>

					<div class="col-md-6 pull-right">

						<select name="categories" class="form-control" id="get_documents">

							<option></option>

							@foreach($category_document as $cat_document)

								<option value="{{$cat_document->document_no}}">{{ucwords($cat_document->document_category)}}</option>

							@endforeach
							
						</select>

					</div>

					

				</form>

				<div class="col-md-12">

					<div class="alert alert-danger alert-dismissible" id="document_error" role="alert" style="margin-top: 10px;display: none">
						
					</div>

					<div class="alert alert-success alert-dismissible" id="success_document" role="alert" style="margin-top: 10px;display: none">
						
					</div>

					<form id="document_get">
							
						{{csrf_field()}}
					
						<table id="table_append" class="table table-striped table-bordered table-hovered" style="margin-top: 20px;">

							

						
						</table>

					</form>
				
				</div>
			
		</div>

		
	</div>

</section>


<script type="text/javascript">
	
	$(document).ready(function(){

		var select = Input.get('get_documents'),

			document_form = Input.get('document_get');

		$(select).change(function(){

			$('#table_append').html('');

			$.ajax({

				type: 'GET',

				dataType: 'json',

				url: "{{url('documents/user')}}/"+ $('#get_documents').val() +'/'+ $('#filter').val() ,

				success: function(response){

						var content = "<thead>"+

										"<tr>"+

											"<th> </th>"+
										
											"<th> Document # </th>"+

											"<th> Office </th>"+

											"<th> Name </th>"+

											"<th> Document Content </th>"+

										"</tr>"+

									"</thead>"+

									"<tbody>";

							$.each(response.documents,function(key,value){

								content += "<tr>"+

												"<td> <label> <input type='checkbox' name='document_no[]' id='display_documents' value="+ value['document_no'] +" class='check_documents'> </label> </td>"+

												"<td>"+ value['document_no']  + "</td>"+

												"<td>"+ value['office'] +"</td>"+

												"<td>"+ value['name'] +"</td>"+

												"<td>"+ value['document_content'] +"</td>"+

											"</tr>";
							
							});

						content +=  "<tr>"+

										"<td colspan=5> <input type='submit' value='submit' class='btn btn-primary pull-right' /> </td>"+

									"</tbody>"+

									"</form>";

						$('#document_count').change(function(){

							alert('what');

						});

						$('#table_append').append(content);

						$('#document_count').val

				}


			});

		});


		$(document_form).submit(function(e){

			var form_document_get = $(this).serialize(),

				checked_documents = $('input[type=checkbox]:checked').length,

				document_error	  = Input.get('document_error'),

				success_error 	  = Input.get('success_document'),

				limit			  = 5;


			$(document_error).hide();

			$(document_error).html('');


			if(checked_documents <= limit || checked_documents != null)
			{

				$.ajax({

					type: "POST",

					dataType: 'json',

					data: form_document_get,

					url: "{{Route('user/request/document')}}",

					success: function(response){

						$(document_error).html('');

						if(response.errors)
						{

							$(document_error).show();

							$(document_error).append("<p><strong>" + response.errors + "</strong></p>");

						}

						if(response.success)
						{

							$(document_error).hide();

							$(success_error).show();

							$(success_error).html("<p><strong>" + response.success + "</strong></p>");

							setTimeout(function(){

								window.location.reload(1);

							}, 2000);



						}


					}

				});
								

			}	else {

				$(document_error).show();

				$(document_error).append("<p><strong> Documents must have atleast " + limit + " selected </strong></p>");

			}


			e.preventDefault();

		});

	});

</script>

@endsection