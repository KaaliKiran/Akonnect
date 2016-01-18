<?php
 $fname=$_GET['q'];
   $type=$_GET['q1'];
   
            if($type="fnameverify")
		         {
				 if(!ctype_alpha($fname))
                            {     
                             echo $response="<b>Suggestions</b>: Firstname can not contain numbers or Special Characters";
                            }
            	
		            } 
						
		?>