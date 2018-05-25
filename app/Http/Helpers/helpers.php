<?php

class Helpers 
{
	
	public static function request_status($status)
	{

		switch ($status) {

			case 1:
				return 'Approved';
				break;

			case 0:
				return 'Pending';
				break;
			
			default:
				# code...
				break;
		}

	
	}

}

?>