<?php 

class User extends DbConnect {

private function checkIsRegistrationFormEmpty( $name , $username , $email , $password , $password_confirmation , $featured_image ){
	if( !empty($name) &&  !empty($username) &&  !empty($email) &&  !empty($password) &&  !empty($password_confirmation) &&  !empty($featured_image)  ){
		return true;

	} else {
		return false;
	}

}// checkIsRegistrationFormEmpty

private function checkIsEmailValid($email){



if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  return true;
} else {
	return false;
}

}// 

private function checkIsEmailRegistered($email ){
	$sql = 'select email from users where email = ? ';
	$query = $this -> connect() -> prepare ($sql );

	$query -> execute([ $email ]);
$emails = $query -> fetchAll();
	if( count($emails ) == 0 ){
		return true;
	} else {
		return false;
	}

}// checkIsEmailRegistered

private function checkIsUsernameRegisted( $username ){
	$sql = 'select username from users where username = ? ';
	$query = $this -> connect() -> prepare ($sql );

	$query -> execute([ $username ]);
$results = $query -> fetchAll();
	if( count($results ) == 0 ){
		return true;
	} else {
		return false;
	}


}

private function checkIsPasswordsSame ($password , $password_confirmation ){

if( $password != $password_confirmation ){

	return false;
} else {
	return true;
}

}// checkIsPasswordsSame 


public function userRegistration( $name , $username , $email , $password , $password_confirmation , $featured_image ){

if( $this -> checkIsRegistrationFormEmpty( $name , $username , $email , $password , $password_confirmation , $featured_image)){

if( $this ->  checkIsEmailValid($email)){

if( $this -> checkIsEmailRegistered($email )){

if( $this ->  checkIsUsernameRegisted( $username )){

if( $this -> checkIsPasswordsSame($password   , $password_confirmation )){


$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$created_at = date('Y-m-d H:i:s'); 
$updated_at = date('Y-m-d H:i:s'); 
$sql = 'insert into users ( name , username , email , password , featured_image , created_at , updated_at ) values ( ? , ? , ? , ? , ? , ? , ? ) ';

$query = $this -> connect () -> prepare($sql );

$query -> execute( [ $name , $username , $email , $hashed_password ,$featured_image , $created_at , $updated_at  ]);
echo 'You are registered on site.';
header('Location:index.php');
exit();
} else {

	echo 'Your passwords are not same.';
}





}else {
echo 'Username is already taken.';

}// checkIsUsernameRegisted
} else {

echo 'Email address is already registered.';
}// checkIsEmailRegistered
}else {
 echo 'Please , enter valid email address.';
}// checkIsEmailValid

} else {

	echo 'Please fill all fields in registration form.';
}// checkIsRegistrationFormEmpty





}// userRegistration







}// User
