<?php
   $deptno=$_GET['q'];
   $type=$_GET['q1'];
   
     
         if($type="deptnoverify")
		         {
            if(strlen($deptno) < 11 || strlen($deptno) > 11 )
			 {
			    echo $response="<br><b>Suggestions</b>:Please check the Departure Number that you have entered.
                                       example:813106636 11";
				}
				 if (!is_numeric($deptno))	
   {
   echo $response="<b>Suggestions</b>: Departure Number can not contain letters or Special Characters";
   }
  if($deptno == "")
	   {
	    echo $response= "<b>Suggestions</b>:The Deptno field can not be empty";
}	
		}
						
			
								
			                                         
													 
													 

?>