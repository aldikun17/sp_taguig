var univ_validate = new function()
{

	this.required = function(html_id,name,alert)
	{

		if(!html_id == '')
	    {

	      return true;

	    }

	    var message_required = name + ' field is required ';

      	$(alert).show();

      	$(alert).html(message_required);


	}


}

var Input = new function()
{
	this.get = function(id)
    {
      return document.getElementById(id);
    }

}

$(document).ready(function(){

	$('.document_category').change(function(){

			$('.documents').html('');

			if( $('.filter_1').val() != '')
			{
				$('.documents').html('');

				if( $('.filter_2').val() != '')
				{

					$.ajax({

						type: 'GET',

						url : '/filter/document/'+$(this).val()+ '/' + $('.filter_1').val() + '/' + $('.filter_2').val() ,

						dataType: 'json',

						success: function(data){

							$.each(data.documents,function(key,value){

								var option = "<option value="+ value['document_no'] + " >" + value['document_content'] + "</option>";

								$('.documents').append(option);

							});

						}
					});

				}	else {


					$.ajax({

						type: 'GET',

						url : '/filter/document/'+$(this).val()+ '/' + $('.filter_1').val(),

						dataType: 'json',

						success: function(data){

							$.each(data.documents,function(key,value){

								var option = "<option value="+ value['document_no'] + " >" + value['document_content'] + "</option>";

								$('.documents').append(option);

							});

						}
					});


				}


				if( $('.filter_2').val() != '' && $('.filter_3').val() != '' )
				{

					$.ajax({

						type: 'GET',

						url : '/filters/document/'+$(this).val()+ '/' + $('.filter_1').val() + '/' + $('.filter_2').val() + '/' + $('.filter_3').val() ,

						dataType: 'json',

						success: function(data){

							$.each(data.documents,function(key,value){

								var option = "<option value="+ value['document_no'] + " >" + value['document_content'] + "</option>";

								$('.documents').append(option);

							});

						}
					});					

				}

			}	else if($('.filter_2').val() != ''){

				$('.documents').html('');

					$.ajax({

						type: 'GET',

						url : '/filter/document/content/'+ $(this).val() + '/' + $('.filter_2').val() ,

						dataType: 'json',

						success: function(data){

							$.each(data.documents,function(key,value){

								var option = "<option value="+ value['document_no'] + " >" + value['document_content'] + "</option>";

								$('.documents').append(option);

							});

						}
					});


			}	else if($('.filter_3').val() != ''){

				$('.documents').html('');


					$.ajax({

						type: 'GET',

						url : '/filter/document/date/'+ $(this).val() + '/' + $('.filter_3').val() ,

						dataType: 'json',

						success: function(data){

							$.each(data.documents,function(key,value){

								var option = "<option value="+ value['document_no'] + " >" + value['document_content'] + "</option>";

								$('.documents').append(option);

							});

						}
					});


			}	else {

				$.ajax({

						type: 'GET',

						url : '/filter/document/category/'+ $(this).val() ,

						dataType: 'json',

						success: function(data){

							console.log(data);

							$.each(data.documents,function(key,value){

								var option = "<option value="+ value['document_no'] + " >" + value['document_content'] + "</option>";

								$('.documents').append(option);

							});

						}
					});

			}
			
		});

});