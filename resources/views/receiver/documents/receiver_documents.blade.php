@extends('receiver.receiver_extends')
@section('title','Documents')
@section('content')

	<section class="content-header">
	    <h1>
	        Documents
	        <small>Control panel</small>
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{Route('receiver/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active"> <span class="fa fa-file"></span> Document</li>
	    </ol>
	</section>

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

        	<form id="document_search">

        		{{csrf_field()}}

        	<div class="row">

        		<div class="col-md-6">
        			
        			<div class="form-group">
        				
        				<label> Category: </label>

        				<select name="document_category" id="document_category" class="form-control">
        					
        					<option></option>

        					@foreach($category_document as $category)

        						<option value="{{$category->document_no}}">{{$category->document_category}}</option>

        					@endforeach


        				</select>	


        			</div>

        		</div>

        		<div class="col-md-6" >
        			
        			<div class="form-group">

        				<label> Filter </label>
        				
        				<input type="text" name="search_filter" id="search_filter" class="form-control" />

        			</div>

        		</div>
        		
        	</div>

        	</form>

        	<div>

        		<table class="table table-bordered table-striped table-hover">

        			<thead>
        				
        				<tr>
        					
        					<th> Document # </th>

        					<th> Name </th>

        					<th> Office </th>

        					<th> Document Content </th>

        				</tr>

        			</thead>

        			<tbody id="results">
        				
        			</tbody>
        			

        		</table>
        		

        	</div>
		
			

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        	

        </div>
        <!-- /.box-footer-->

      </div>
      <!-- /.box -->

    </section>

    <script type="text/javascript">

		$('.sub-documents').addClass('active');

		$('#sub-create-document').addClass('active');
    	
    	$('#document_receiver').dataTable();

    	$('#document_search').submit(function(e){

    		var document_form 	  = $(this).serialize(),
    			search_filter 	  = Input.get('search_filter').value,
    			document_category = $('#document_category').val();

    		if(search_filter != '')
    		{

    			$('#results').html('');

    			$.ajax({

	    			type: 'POST',

	    			dataType: 'json',

	    			url: '/receiver/document/get/'+ document_category + '/' + search_filter,

	    			data: document_form,

	    			success: function(response)
	    			{

	    				$.each(response.documents, function(key,value){

	    					var response_result = "<tr>"+
			    									"<td>"+ value['document_no'] +"</td>"+
			    									"<td>"+ value['name'] +"</td>"+
			    									"<td>"+ value['office'] +"</td>"+
			    									"<td>"+ value['document_content'] +"</td>"+
			    								   "</tr>";

		    				$('#results').append(response_result);

	    				});

	    			}

	    			

	    		});

    		}	else {

    			$('#results').html('');

    			$.ajax({

	    			type: 'POST',

	    			dataType: 'json',

	    			url: '/receiver/document/get/'+ document_category,

	    			data: document_form,

	    			success: function(response)
	    			{
	    				
	    				$.each(response.documents, function(key,value){

	    					var response_result =   "<tr>"+
			    										"<td>"+ value['document_no'] +"</td>"+
			    										"<td>"+ value['name'] +"</td>"+
			    										"<td>"+ value['office'] +"</td>"+
			    										"<td>"+ value['document_content'] +"</td>"+
			    									"</tr>";

		    				$('#results').append(response_result);

	    				});

	    			}

	    		});

    		}

    	e.preventDefault();

    	});

    </script>

@endsection