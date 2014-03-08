<?php
	$email = "dustindiep0@gmail.com";
	$grade = $_POST['grade'];
	$feedback = $_POST['feedback'];
	$e_subject = "Feedback";
	$e_content = "Grade: $grade\n\nFeedback: $feedback";
	$mail = mail($email, $e_subject, $e_content);
	header('Location: http://www.fhsapp.com');
?>