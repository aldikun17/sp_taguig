@extends('admin.extends')
@section('title','Dashboard')
@section('content')

<section class="content-header">
    <h1>
        Create Documents
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{Route('admin/dashboard')}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Document </li>
      <li class="active">  <span class="fa fa-plus"></span> Create Documents </li>
    </ol>
</section>

<section class="content">
		
		<div class="box">

			<div class="box-header with-border">

				<div class="box-tools pull-right">

					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

				</div>

				<h3 class="box-title"> Create Document </h3>

			</div>

			<div class="box-body">

				<form action="{{Route('document/create')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">

					{{csrf_field()}}

					<div class="row-fluid">

						<div class="form-group  {{$errors->has('document_category_id') ? 'has-error':''}}">

							<div class="col-md-4">
								
								<label> Document Name </label>

							</div>

							<div class="col-md-8">
								
								<input type="file" name="document_name" class="form-control">

								@if ($errors->has('document_name'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('document_name') }}</strong>
		                            </span>
		                        @endif

							</div>

						</div>
						
					</div>

					<div class="row-fluid">

						<div class="form-group  {{ $errors->has('document_category_id') ? ' has-error' : '' }}">

							<div class="col-md-4">
								
								<label> Document Category </label>

							</div>

							<div class="col-md-8">

								<select name="document_category_id" class="form-control" value="{{ old('document_category_id') }}">

									<option></option>

									@foreach($category_document as $cat_document)

										<option value="{{$cat_document->document_no}}">{{ucwords($cat_document->document_category)}}</option>

									@endforeach
								
								</select>

								@if ($errors->has('document_category_id'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('document_category_id') }}</strong>
		                            </span>
		                        @endif
								
							</div>

						</div>
	
					</div>

					<div class="row-fluid">

						<div class="form-group {{$errors->has('document_no') ? 'has-error': ''}}">

							<div class="col-md-4">
								
								<label> Document # </label>

							</div>

							<div class="col-md-8">
								
								<input type="text" name="document_no" class="form-control" value="{{ old('document_no') }}">

								@if ($errors->has('document_no'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('document_no') }}</strong>
		                            </span>
		                        @endif

							</div>

						</div>
						
					</div>

					<div class="row-fluid">

						<div class="form-group {{$errors->has('office') ? 'has-error' : ''}}">

							<div class="col-md-4">
								
								<label> Office </label>

							</div>

							<div class="col-md-8">
								
								<input type="text" name="office" class="form-control" value="{{ old('office') }}">

								@if ($errors->has('office'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('office') }}</strong>
		                            </span>
		                        @endif

							</div>

						</div>
						
					</div>

					<div class="row-fluid">

						<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">

							<div class="col-md-4">
								
								<label> Document Name </label>

							</div>

							<div class="col-md-8">
								
								<input type="text" name="name" class="form-control" value="{{ old('name') }}">

								@if ($errors->has('name'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('name') }}</strong>
		                            </span>
		                        @endif

							</div>

						</div>
						
					</div>

					<div class="row-fluid">

						<div class="form-group {{$errors->has('document_content') ? 'has-error' : ''}}">

							<div class="col-md-4">
								
								<label> Document Content </label>

							</div>

							<div class="col-md-8">
								
								<textarea name="document_content" class="form-control" value="{{ old('document_content') }}"></textarea>

								@if ($errors->has('document_content'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('document_content') }}</strong>
		                            </span>
		                        @endif

							</div>

						</div>
						
					</div>

					<div class="row-fluid">

						<div class="form-group">

							<div class="col-md-6 col-md-offset-5">
								
								<input type="submit" value="Submit" class="btn btn-primary">

							</div>

						</div>
						
					</div>



				</form>
				
			</div>

		</div>

</section>


<script type="text/javascript">
	
	$(document).ready(function(){

		$('#all_document').DataTable();

		$('.sub-documents').addClass('active');

		$('#sub-create-document').addClass('active');

	});

@endsection