<?php
security();

require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();

function init(){
  global $elementsArr, $stickyForm;

  if(isset($_POST['submit'])){
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    if($postArr['masterStatus']['status'] == "noerrors"){
      return addData($_POST);

    }
    else{
      return getForm("<h1>Add Admin</h1>",$postArr);
    }
    
  }
  else {
      return getForm("<h1>Add Admin</h1>", $elementsArr);
    } 
}
$elementsArr = [
  "masterStatus"=>[
  "status"=>"noerrors",
  "type"=>"masterStatus"
  ],
	"name"=>[
	"errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
  "errorOutput"=>"",
  "type"=>"text",
  "value"=>"First Last",
	"regex"=>"name"
	],
  "email"=>[
  "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a valid email.</span>",
  "errorOutput"=>"",
  "type"=>"text",
  "value"=>"example@staff.com",
  "regex"=>"email"
    ],

  "password"=>[
  "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password can not be blank and must be a valid password.</span>",
  "errorOutput"=>"",
  "type"=>"text",
  "value"=>"password",
  "regex"=>"password"
    ],
   
  "status"=>[
  "type"=>"select",
  "action"=>"required",
  "regex"=>"status"
  ],
];

function addData($post){
  global $elementsArr;
    require_once('classes/PdoMethods.php');

    $pdo = new PdoMethods();

    $sql = "SELECT email FROM admins where email = :email";
    $bindings = [
      [':email',$post['email'],'str']
    ];

    $records = $pdo->selectBinded($sql, $bindings);

    if(count($records) > 0){
      return getForm("<h1>Add Admin</h1><p>Someone exist with that email.</p>", $elementsArr);
    }

    $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";

    $password = password_hash($post['password'], PASSWORD_DEFAULT);

    $bindings = [
      [':name',$post['name'],'str'],
      [':email',$post['email'],'str'],
      [':password',$password,'str'],
      [':status',$_POST['status'],'str']
    ];

    $result = $pdo->otherBinded($sql, $bindings);
    if($result == "error"){
      return getForm("<h1>Add Admin</h1><p>There was a problem processing your form</p>", $elementsArr);
    }
    else {
      return getForm("<h1>Add Admin</h1><p>Admin Information Added</p>", $elementsArr);
    } 
}
function getForm($acknowledgement, $elementsArr){
global $stickyForm;
$form = <<<HTML
    <form method="post" action="index.php?page=addAdmin">
    <p><span style='color: red; margin-left: 15px;'>* Required</span></p>
    <div class="form-group">
      <label for="name">* Name (letters only){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">* Email {$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>
            
    <div class="form-group">
      <label for="password">* Password {$elementsArr['password']['errorOutput']}</label>
      <input type="password" class="form-control" id="password" name="password" value="{$elementsArr['password']['value']}" >
    </div>
    <p>* Status</p>
    <div class="form-check form-check-inline">
            <select id="status" name='status' class="form-select">
                <option selected>Staff</option>
                <option>Admin</option>
            </select>
    </div>
    <div class="form-group">
      <p> </p>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
HTML;
return [$acknowledgement, $form];

}

?>