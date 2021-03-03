<?php 

class User extends DbConnect {


public function checkIsUserLoggedIn(){

	if( isset($_SESSION['logged'])){
		return true;
	}else {
		return false;
	}
}




public function userLogout(){

			if( isset($_SESSION['logged'])){
				
				session_destroy();
				header('Location:index.php');
			}
			
}// userLogout

private function checkIsRegistrationFormEmpty( $name , $username , $email , $password , $password_confirmation ){
	if( !empty($name) &&  !empty($username) &&  !empty($email) &&  !empty($password) &&  !empty($password_confirmation)){
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


public function userRegistration( $name , $username , $email , $password , $password_confirmation  ){

if( $this -> checkIsRegistrationFormEmpty( $name , $username , $email , $password , $password_confirmation)){

if( $this ->  checkIsEmailValid($email)){

if( $this -> checkIsEmailRegistered($email )){

if( $this ->  checkIsUsernameRegisted( $username )){

if( $this -> checkIsPasswordsSame($password   , $password_confirmation )){


$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$created_at = date('Y-m-d H:i:s'); 
$updated_at = date('Y-m-d H:i:s'); 
$sql = 'insert into users ( name , username , email , password , is_admin , created_at , updated_at ) values ( ? , ? , ? , ? , ? , ? , ? ) ';

$query = $this -> connect () -> prepare($sql );

$query -> execute( [ $name , $username , $email , $hashed_password   , 0 , $created_at , $updated_at  ]);
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

protected function checkIsLoginFormEmpty($email , $password ){
if( !empty($email ) && !empty($password )){

	return true;
} else {
	return false;
}


}// checkIsLoginFormEmpty
public function userLogin($email  , $password ){

if( $this -> checkIsLoginFormEmpty($email , $password )) {


			$sql = 'select * from users where email = ? ';
			
			$query = $this -> connect() -> prepare( $sql );
			
			$query -> execute( [$email]);
			
			$results = $query -> fetchAll();


if( count($results ) > 0 ){
foreach ($results as $result) {
	$hashed_password = $result['password'];

	if( password_verify($password , $hashed_password )){

						$_SESSION['logged'] = 1;
						$_SESSION['user_id'] = $result['id'];
						$_SESSION['name'] = $result['name'];
						$_SESSION['email'] = $result['email'];
						$_SESSION['is_admin'] = $result['is_admin'];
						$_SESSION['featured_image'] = $result['featured_image'];
						
header('Location:index.php');
exit();
	} else {

		echo 'Wrong email or password.';
	}


}


} else {

	echo 'Wrong email or password.';
}




} else {

	echo 'Please , fill all fields in form.';
} // checkIsLoginFormEmpty

}// userLogin





}// User
