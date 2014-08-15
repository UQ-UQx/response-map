<?php
	$postBody = file_get_contents('php://input');

	require_once('config.php');

	if ($body = json_decode($postBody)) {
		if (!empty($body->sessid)) {
			$session_id = $body->sessid;
			session_id($body->sessid);
			session_start();
		}
		else {
			session_start();
			$session_id = session_id();
		}

		if ($lti_session = $_SESSION[$body->sourcedid]) {
			$select_vote_query = mysqli_query($conn, 'SELECT vote FROM feedback WHERE response_id = ' . $body->respid . ' AND user_id = "' . $_SESSION[$body->sourcedid]['user_id'] . '"');
			$vote_row = mysqli_fetch_row($select_vote_query);
			$vote_resp = new stdClass();

			if (empty($vote_row)) {
				$insert_vote_query = mysqli_query($conn, 'INSERT INTO feedback (response_id, user_id, vote, create_time) VALUES (' . $body->respid . ', "' . $_SESSION[$body->sourcedid]['user_id'] . '", 1, NOW())');

				if (!$insert_vote_query) {
					http_response_code(500);
					echo 'Vote was not succesfully inserted into database';
					die();
				}

				$vote_resp->vote = 1;
				$update_response_query = mysqli_query($conn, 'UPDATE response SET vote_count = vote_count + 1 WHERE response_id = ' . $body->respid);
			}
			else {
				$current_vote = 0;

				if (intval($vote_row[0]) === 0) {
					$current_vote = 1;
					$vote_resp->vote = 1;
					$update_response_query = mysqli_query($conn, 'UPDATE response SET vote_count = vote_count + 1 WHERE response_id = ' . $body->respid);
				}
				else {
					$current_vote = 0;
					$vote_resp->vote = 0;
					$update_response_query = mysqli_query($conn, 'UPDATE response SET vote_count = vote_count - 1 WHERE response_id = ' . $body->respid);
				}

				$update_vote_query = mysqli_query($conn, 'UPDATE feedback SET vote = ' . $current_vote . ' WHERE response_id = ' . $body->respid . ' AND user_id = "' . $_SESSION[$body->sourcedid]['user_id'] . '"');
				
				if (!$update_vote_query) {
					http_response_code(500);
					echo 'Vote was not successfully updated on database';
					die();
				}
			}

			echo json_encode($vote_resp);
		}
	}
	else {
		http_reponse_code(400);
		echo 'lis_result_sourcedid is required in the body';
	}

	//$lti_session = $_SESSION[$_POST['lis_result_sourcedid']];

/*	if (!empty($lti_session)) {
		print_r($lti_session);
	} */
?>