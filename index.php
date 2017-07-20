<?php
/**
 * Created by PhpStorm.
 * User: Faridho
 * Date: 7/18/2017
 * Time: 6:41 AM
 */

require 'vendor/autoload.php';
include 'config.php';

$app = new Slim\App();

$app->post('/login', function($request, $response){
    try{
        $con   = getDB();
        $sql   = "SELECT * FROM users WHERE username = :username AND password=:password";
        $pre   = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        if($sql){
            $values = array(
                ':username' => $request->getParam('username'),
                ':password' => $request->getParam('password')
            );
            $pre->execute($values);
            $result = $pre->fetch();
            if($result){
                return $response->withJson(array('status' => 'true','result'=>$result),200);
            }else{
                return $response->withJson(array('status' => 'Not Login'),422);
            }
        }else{
            return $response->withJson(array('status' => 'Username & Password Not Match'),422);
        }
    }catch(\Exception $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
    }
});

$app->post('/signup', function($request, $response){
    try{
        $con    = getDB();
        $sql    = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $pre    = $con->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':username' => $request->getParam('username'),
            ':password' => $request->getParam('password')
        );
        $result = $pre->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Success'), 200);
        }else{
            return $response->withJson(array('status' => 'Failed'), 422);
        }
    }catch(\Exception $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
    }
});

$app->run();