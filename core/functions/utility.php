<?php

require 'vendor/autoload.php';


function hash_password($password)
{
    $options = array('cost' => 12);
    return password_hash($password, PASSWORD_BCRYPT, $options);    
}
// If the data is for a post, then we want the second param set
function sanitize($string, $option = null)
{
    if($option) {
        $string = htmlentities($string);
        $string = str_replace(["&lt;i&gt;", "&lt;b&gt;", "&lt;p&gt;", "&lt;/i&gt;", "&lt;/b&gt;", "&lt;/p&gt;"], 
          ["<i>", "<b>", "<p>", "</i>", "</b>", "</p>"], $string);

        return $string;
    } else {
        if(!preg_match("/^[-_0-9a-z]{2,}$/i", $string)) {
            exit('Names must be alphanumeric including hyphen (-) and underscore (_) characters.');
        } else {
            $string = strtolower($string);
            return $string;  
        }    
    }
}

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function verify_password($password, $hash)
{
    if (password_verify($password, $hash)) {
        return true;
    } else {
        return false;
    }
}
// CSFR Token
function generate_token()
{
    return $_SESSION['token'] = md5(uniqid());
}

function check_token($token)
{
    if($_SESSION['token'] === $token) {
        unset($_SESSION['token']);
        return true;
    }
    return false;
}

function is_LoggedIn()
{
    $user = new User();

    if($user->is_LoggedIn()) {
        return true;
    }
}

function register()
{
    if(Input::exists()) {
    
        if(Token::check(Input::get('token'))) {
        
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
        
            'username'       => array(
                'required' => true,
                'min'      => 2,
                'max'      => 20,
                'unique'   => 'users'
              ),
            'password'       => array(
                'required' => true,
                'min'      => 6
              ),
            'password_again' => array(
                'required' => true,
                'matches'  => 'password'
              ),
            'name'           => array(
                'required' => true,
                'min'      => 2,
                'max'      => 50
              )
          ));
        
          if($validation->passed()) {
        
                $user = new User();
                $salt = Hash::salt(32);
            
                try {
            
                  $user->create(array(
                      'username' => Input::get('username'),
                      'password' => Hash::make(Input::get('password'), $salt),
                      'salt'     => $salt,
                      'name'     => Input::get('name'),
                      'joined'   => date('Y-m-d H:i:s'),
                      'group'    => 1
                  ));
            
                  Session::flash('home', 'You have been registered and can now log in!');
                  Redirect::to('index.php');
            
                } catch(Exception $e) {
            
                    die($e->getMessage());
                }
        
          } else {
              
              foreach($validation->errors() as $error) {
                echo $error, '<br>';
              }
          }
        }
    }
}