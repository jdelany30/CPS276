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
      return getForm("<h1>Add Contact</h1>",$postArr);
    }
  }
  else {
      return getForm("<h1>Add Contact</h1>", $elementsArr);
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
    "value"=>"Scott",
		"regex"=>"name"
	],
    "address"=>[
      "action"=>"required",
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Adress cannot be blank.</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"123 Streetname",
    "regex"=>"address"
    ],
    "city"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>City cannot be blank</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"Somewhere",
    "regex"=>"city"
    ],
    "state"=>[
    "type"=>"select",
    "options"=>["MI"=>"Michigan","OH"=>"Ohio","PA"=>"Pennslyvania","TX"=>"Texas"],
    "selected"=>"oh",
    "regex"=>"state"
    ],
	  "phone"=>[
	  "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Must be a valid phone number and cannot be blank</span>",
    "errorOutput"=>"",
    "type"=>"text",
	  "value"=>"999.999.9999",
		"regex"=>"phone"
    ],
    "email"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Must be a valid email and cannot be blank</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"example@example.com",
    "regex"=>"email"
    ],
    "dob"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must use a valid date of birth</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"12/25/1999",
    "regex"=>"dob"
     ],

  "contact"=>[
    "type"=>"checkbox",
    "action"=>"notRequired",
    "status"=>["newsletter"=>"", "emailupdates"=>"", "textupdates"=>""]
  ],
  "age"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select age range</span>",
    "errorOutput"=>"",
    "action"=>"required",
    "type"=>"radio",
    "value"=>["10-18"=>"", "19-30"=>"", "31-50"=>"", "51+"=>""]
  ]
];

function addData($post){
  global $elementsArr;  
      require_once('classes/PdoMethods.php');

      $pdo = new PdoMethods();

      $sql = "INSERT INTO contactsTable (name, address, city, state, phone, email, dob, contact, age) VALUES (:name, :address, :city, :state, :phone, :email, :dob, :contact, :age)";
      $contact = "";
      if(isset($_POST['contact'])){
        foreach($post['contact'] as $v){
          $contact .= $v.",";
        }
        $contact = substr($contact, 0, -1);
      }
      if(isset($_POST['age'])){
        $age = $_POST['age'];
      }
      else {
        $age = "";
      }

      $bindings = [
        [':name',$post['name'],'str'],
        [':address',$post['address'],'str'],
        [':city',$post['city'],'str'],
        [':state',$post['state'],'str'],
        [':phone',$post['phone'],'str'],
        [':email',$post['email'],'str'],
        [':dob',$post['dob'],'str'],
        [':contact',$contact, 'str'],
        [':age',$age,'str']
      ];

      $result = $pdo->otherBinded($sql, $bindings);
      if($result == "error"){
        return getForm("<h1>Add Contact</h1><p>There was a problem processing your form</p>", $elementsArr);
      }
      else {
        return getForm("<h1>Add Contact</h1><p>Contact Information Added</p>", $elementsArr);
      }  
}

function getForm($acknowledgement, $elementsArr){

global $stickyForm;
$options = $stickyForm->createOptions($elementsArr['state']);
$form = <<<HTML
    <form method="post" action="index.php?page=addContact">
    <p><span style='color: red; margin-left: 15px;'>* Required</span></p>
    <div class="form-group">
      <label for="name">* Name (letters only) {$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="address">* Address (number and street name) {$elementsArr['address']['errorOutput']}</label>
      <input type="text" class="form-control" id="address" name="address" value="{$elementsArr['address']['value']}" >
    </div>
    <div class="form-group">
      <label for="city">* City {$elementsArr['city']['errorOutput']}</label>
      <input type="text" class="form-control" id="city" name="city" value="{$elementsArr['city']['value']}" >
    </div>       
    <div class="form-group">
      <label for="state">* State </label>
      <select class="form-control" id="state" name="state">
        $options
      </select>
    </div>
    <div class="form-group">
      <label for="phone">* Phone Number (Format 999.999.9999) {$elementsArr['phone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">* Email {$elementsArr['email']['errorOutput']}</label>
      <input type="email" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>
    <div class="form-group">
      <label for="dob">* Date of Birth {$elementsArr['dob']['errorOutput']}</label>
      <input type="text" class="form-control" id="dob" name="dob" value="{$elementsArr['dob']['value']}" >
    </div>
    <p>Please select contact options (optional):</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contact[]" id="contact1" value="Newsletter" {$elementsArr['contact']['status']['newsletter']}>
      <label class="form-check-label" for="contact1">Newsletter</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contact[]" id="contact2" value="Email Updates" {$elementsArr['contact']['status']['emailupdates']}>
      <label class="form-check-label" for="contact2">Email Updates</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contact[]" id="contact3" value="Text Updates" {$elementsArr['contact']['status']['textupdates']}>
      <label class="form-check-label" for="contact3">Text updates</label>
    </div>      
    <p>* Please select an age-group : {$elementsArr['age']['errorOutput']}</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age1" value="10-18"  {$elementsArr['age']['value']['10-18']}>
      <label class="form-check-label" for="age1">10-18</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age2" value="19-30"  {$elementsArr['age']['value']['19-30']}>
      <label class="form-check-label" for="age2">19-30</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age3" value="31-50"  {$elementsArr['age']['value']['31-50']}>
      <label class="form-check-label" for="age3">31-50</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="age" id="age4" value="51+"  {$elementsArr['age']['value']['51+']}>
      <label class="form-check-label" for="age4">51+</label>
    </div>
    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
HTML;

return [$acknowledgement, $form];
}
?>