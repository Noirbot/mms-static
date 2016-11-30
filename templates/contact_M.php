<?php include('deps/m_header.php');
/*Data will  be received via POST, and therefore is in the $_POST variable. e.g. <input name="Comments"> will store data in $_POST['Comments'] */

$message='';
$fields=array('name','email','phone','company','message');
foreach ($fields as $fieldName){
		$message.=$fieldName.' = '.$_POST[$fieldName]."\n";
}

$empty_message = FALSE;
$correct_submission = FALSE;
$num_submissions = 0;

if ($_POST['submit']!='') { //if the form was submitted
    if (strlen($_POST['message'])==0) { //and the message was not filled
        $empty_message = TRUE;
    }
    else{ //and there was a message attached
        $correct_submission = TRUE;
    }
}

if ($_POST['submit']==NULL){ //if submission hasn't happen yet
	include('deps/contact_mainText.php');
     include('deps/contact_form.html');
}

else{ //submission has happened but...
    if ($empty_message) { //there was an empty message field
		/*include('m_header.php');*/
	    include('deps/contact_mainText.php');
		echo '<p> <span style="color: red">The message field was empty. Margaret will not receive your email. </span> </p>';
        include('deps/contact_form.html');
        }
    else{ //submission has happened AND  message was not empty
			/*include('m_header.php');*/
		    include('deps/contact_mainText.php');
			echo '<p> <span style="color: red">Thank you for sending a message to Margaret! </span> </p>';

           if ($num_submissions < 1){
               mail('margaret@margaretshuman.com','New Message from Website',$message);
               }
            $num_submissioins = $num_submissions + 1;

          /* include ('contact_info.html');*/
    }
}

     include('deps/contact_info.html');


 include('deps/footer.php'); ?>
