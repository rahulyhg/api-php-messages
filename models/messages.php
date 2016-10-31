<?php 
//utf8_encode
$app->get('/messages', function() use ($app) {
    $r = json_decode($app->request->getBody());
    $response = array();
    $db = new DbHandler();
   
    $messages = $db->getAllRecords("select _id,name,email,message from messages order by 1 desc");
    if ($messages != NULL) {
		$messages_array = array();
		foreach($messages as $message){
			$messages_array['_id']= $message[0];	
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
	
	$name=$r->name;
	$email=$r->email;
	$message=$r->message;

    $result = $db->insertRecord("insert into messages(_id,name,email,message) values (0,'$name','$email','$message')");
    if ($result != NULL) {
        $response["status"] = "success";
        $response["message"] = "message $result created successfully";            
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
    $result = $db->deleteRecord("delete from messages where _id=$id");
    if ($result == NULL) {
        $response["status"] = "success";
        $response["message"] = "message deleted successfully";            
        echoResponse(200, $response);
    } else {
        $response["status"] = "error";
        $response["message"] = "Failed to delete message. Please try again";
        echoResponse(201, $response);
    }         
});
?>