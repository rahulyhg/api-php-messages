<?php 
//utf8_encode
$app->get('/messages', function() use ($app) {
    $r = json_decode($app->request->getBody());
    $response = array();
    $db = new DbHandler();
   
    $messages = $db->getAllRecords("select id,name,email,message from messages order by name");
    if ($messages != NULL) {
		$messages_array = array();
		foreach($messages as $message){
			$messages_array['id']= $message[0];	
			$messages_array['name']= $message[1];	
			$messages_array['email']= $message[2];
			$messages_array['message']= $message[3];		
			$response[] =$messages_array;
		}		
    }
	echoResponse(200, $response);
}); 
$app->post('/messages', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    $db = new DbHandler();
	
	$message= array();
	$message['name']=$r->message->name;
	$message['email']=$r->message->email;
	$message['message']=$r->message->message;

    $column_names = array('name', 'email', 'message');
	
    $tabble_name = "messages";
    $result = $db->insertRecord($message, $column_names, $tabble_name);
    if ($result != NULL) {
        $response["status"] = "success";
        $response["message"] = "message created successfully";            
        echoResponse(200, $response);
    } else {
        $response["status"] = "error";
        $response["message"] = "Failed to create message. Please try again";
        echoResponse(201, $response);
    }         
});
$app->delete('/messages/:id', function($id) use ($app) {
    $response = array();
    $db = new DbHandler();
    $result = $db->deleteRecord("delete from messages where id=$id");
    if ($result != NULL) {
        $response["status"] = "success";
        $response["message"] = "message deleted successfully";            
        echoResponse(200, $response);
    } else {
        $response["status"] = "error";
        $response["message"] = "Failed to delete message. Please try again";
        echoResponse(201, $response);
    }         
});
$app->put('/messages/:id', function($id) use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    $db = new DbHandler();
	 
	$name=$r->message->name;
	$email=$r->message->email;
	$message=$r->message->message;

	
    $tabble_name = "messages";
    $result = $db->updateRecord("update messages set name='$name', email='$email', message='$message' where id=$id");
    if ($result != NULL) {
        $response["status"] = "success";
        $response["message"] = "message created successfully";            
        echoResponse(200, $response);
    } else {
        $response["status"] = "error";
        $response["message"] = "Failed to create message. Please try again";
        echoResponse(201, $response);
    }         
});
?>