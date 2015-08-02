<?php
require 'db.php';
require 'vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/users','getUsers');
$app->get('/updates','getUserUpdates');
$app->post('/updates', 'insertUpdate');
$app->delete('/updates/delete/:update_id','deleteUpdate');
$app->get('/users/search/:query','getUserSearch');

$app->run();

// GET http://www.yourwebsite.com/api/users
function getUsers() {
$sql = "SELECT user_id,username,name,profile_pic FROM users ORDER BY user_id DESC";
try {
$db = getDB();
$stmt = $db->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_OBJ);
$db = null;
echo '{"users": ' . json_encode($users) . '}';
} catch(PDOException $e) {
//error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}

// GET http://www.yourwebsite.com/api/updates
function getUserUpdates() {
$sql = "SELECT A.user_id, A.username, A.name, A.profile_pic, B.update_id, B.user_update, B.created FROM users A, updates B WHERE A.user_id=B.user_id_fk  ORDER BY B.update_id DESC";
echo $sql;
die();
try {
$db = getDB();
$stmt = $db->prepare($sql);
$stmt->execute();
$updates = $stmt->fetchAll(PDO::FETCH_OBJ);
$db = null;
echo '{"updates": ' . json_encode($updates) . '}';
} catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}

// DELETE http://www.yourwebsite.com/api/updates/delete/10
function deleteUpdate($update_id)
{
$sql = "DELETE FROM updates WHERE update_id=:update_id";
try {
$db = getDB();
$stmt = $db->prepare($sql);
$stmt->bindParam("update_id", $update_id);
$stmt->execute();
$db = null;
echo true;
} catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}

// POST http://www.yourwebsite.com/api/updates
function insertUpdate() {
//....
//....
}

function getUserUpdate($update_id) {
//.....
//.....
}

// GET http://www.yourwebsite.com/api/users/search/sri
function getUserSearch($query) {
//.....
//....
}
?>