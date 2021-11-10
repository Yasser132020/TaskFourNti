

<?php

function clean($input){
  
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
if(!empty($_FILES['image']['name']))
{
    $file_temp = $_FILES['image']['tmp_name'];
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];

    $file_ex = explode('.',$file_name);
    $updated_ex = strtolower(end($file_ex));


    $allowed_ex = ["png","jpg"];

    if(in_array($updated_ex  ,  $allowed_ex ))
    {
        $finalName = rand().time().'.'.$updated_ex;

        $distPath = './uploads/'.$finalName;

        if(move_uploaded_file($file_temp,$distPath))
        {
            echo "Image Uploaded".'<br>';
        }
        else
        {
            echo "Error Try Again";
        }
    }
    else
    {
        echo "Invalid Extension";
    }
}
else
{
    echo "Image Failed Required".'<br>';
}


$errorMessages = [];

$name     = clean($_POST['name']) ;
$address  = clean($_POST['address']);
$url      = clean($_POST['url']);
$gender   = clean($_POST['gender']);
$mail     = clean($_POST['email']);
$password = clean($_POST['password']);


if(empty($name)){

    $errorMessages['Name'] = "Name Required";
}

if(empty($mail)){

    $errorMessages['Email'] = "Email Required";
}else {
    
    if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
        
        $errorMessages['EMAIL-validiate'] = "invalid EMAIL";

    }
}

if(empty($password) || strlen($password) < 6){

    $errorMessages['Password'] = " please write at least 6 characters";
}

if(empty($address) || strlen($address) < 10){
    $errorMessages['address'] = "please  write at least 10 characters";
}


if(empty($url)){
    $errorMessages['url'] = "url Required";
}else {
    
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        
        $errorMessages['url-validitate'] = "invalid url";

    }
    
}


if(empty($gender)){

    $errorMessages['Gender'] = "Gender Required";
}




if(count($errorMessages) > 0){

   foreach($errorMessages as $key => $value){

       echo $key.' : '.$value.'<br>';
   }


}else{

     echo 'Valid Data';

}


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Register</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"  enctype ="multipart/form-data">
  
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" name="name"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password"   class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">address</label>
    <input type="text" name="address"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="gender">Your gender is :</label>
    <select id="gender" name="gender">
        <option value="volvo">male</option>
        <option value="saab">female</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Linkedin url</label>
    <input type="text" name="url"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div> 
  <div class="form-group">
    <label for="exampleInputEmail1">Image :</label>
    <input type="file" name="image">
  </div>
 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>

