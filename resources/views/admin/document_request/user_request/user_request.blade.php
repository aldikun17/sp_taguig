@extends('admin.extends')
@section('title','Update Request Document')
@section('content')

<section class="content-header">
    <h1>
        Update Request Documents
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{Route('admin/dashboard')}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Document </li>
      <li class="active"> Update Document Request </li>
    </ol>
</section>

<div class="content">

	<div class="box">

		<div class="box-header with-border">

			<h3 class="box-title"></h3>

          <div class="box-tools pull-right">

            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

              <i class="fa fa-minus"></i>

            </button>

          </div>

		</div>

		<div class="box-body">

			<form action="{{url('admin/user/document/request/'.$users->user_id)}}" method="POST">

				{{csrf_field()}}

				<div class="form-group">

					<label> Request # </label>

					<input type="text" class="form-control" name="request_no" id="request_no" data-inputmask='"mask": "Request_999-9999"' data-mask required />
					
				</div>

				<div class="form-group">
					
					<label> Requestor </label>

					<input type="text" value="{{$users->name}}" readonly  class="form-control">

				</div>

				<div class="form-group">

					<label> Documents </label>
					<br>

					@foreach($user_requests as $document_request)

						@foreach($document_request::find($document_request->id)->documents as $documents)

							<iframe src="{{storage::url('documents/'.$documents->category_documents->document_category.'/'.$document_request->document_no.'/'.$documents->document_path)}}" width="200px">
								
							</iframe>

							<a href="{{storage::url('documents/'.$documents->category_documents->document_category.'/'.$document_request->document_no.'/'.$documents->document_path)}}" style="margin-top: 10px;position: absolute;top:370px;margin-left: -190px">{{$documents->document_path}}</a>

						@endforeach

					@endforeach
					
				</div>		
			
		</div>

		<div class="box-footer">
			
			<center>
				
				<input type="submit" value="Submit" class="btn btn-primary">

			</center>
			
		</div>

		</form>
		
	</div>
	
</div>

<script type="text/javascript">
	
	$(document).ready(function(){

		$('#request_no').inputmask();

	});

</script>


@endsection