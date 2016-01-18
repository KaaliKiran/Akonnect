<?php
$date=$_GET['q'];
$type=$_GET['q1'];

            if($type="bdateverify")
		         {
				 
				 
           $converted=str_replace('/','-',$date);
	       $date = explode("-", $converted);     
		   $mindate= "1990-01-01";
		   $min = explode("/", $mindate);
		   
		   $JD1 = GregorianToJD($min[1],$min[0],$min[2]);
		   $JD2 = GregorianToJD($date[1],$date[0],$date[2]);
							if($JD2 > $JD1)
									{
                                      echo $response="<br><b>Smartchecks</b>: The Entered Birthdate Can not be Greater than 1990-01-01";
									  }										 
		   
                          if($date[0]) <= 12 && $date[1] <= 31)			
			              {												  
						echo "";
							}
							 else
								{
							 echo $response="<br><b>Msg</b>:Invalid Date format as ".$date[0]." is not a valid month. <br> The Date Format Should be in <b>MM/DD/YY</b> format";
								}
						}
			
								
			                                         
													 
													 

?>