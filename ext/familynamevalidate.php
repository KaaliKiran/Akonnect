<?php
 $fam=$_GET['q'];
 $type=$_GET['q1'];
   
if($type=="familyverify")
		         {
				 if(!ctype_alpha($fam))
                            {     
                             echo $response="<b>Suggestions</b>: Familyname can not contain numbers or Special Characters";
                            }
            	
		            }
						
		?>