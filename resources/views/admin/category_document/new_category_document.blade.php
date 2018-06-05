@extends('admin.extends')
@section('title','Dashboard')
@section('content')

<section class="content-header">
    <h1>
        New Document Categories
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{Route('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> New Document Category </li>
    </ol>
</section>

<section class="content">

	<div class="box">
		
		<div class="box-body">

			<form method="POST">

				{{csrf_field()}}

				<div class="form-group">

                  <label>Text</label>

                  <input type="text" class="form-control" placeholder="Enter ...">
                  
                </div>

			</form>
			
		</div>


	</div>
	
</section>


@endsection