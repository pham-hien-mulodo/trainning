<?php
	function valid_string($data, $minlength, $maxleng)
	{
	//	try{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_string($data))
				{
					return true;
				}//else { throw new Exception('data type string false'); return false;}
			}//else { throw new Exception('string length false'); return false;}
		}//else { throw new Exception('string empty'); return flase;}
	//	} catch(Exception $e)
	//	{
	//		$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
	//		echo $error;
	//		print_r($e->getTrace());
	//		echo 'Error happened in the process. Please try again.';
	//	}
		return false;
	}
	
	$name =  1 or sleep(50);
	
	$result = valid_string($name,10,30);
	var_dump($result);