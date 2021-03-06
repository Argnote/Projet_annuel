<?php $inputData = $GLOBALS["_".strtoupper($data["config"]["method"])]; ?>

<form 
method="<?= $data["config"]["method"]?>" 
action="<?= $data["config"]["action"]?>"
id="<?= $data["config"]["id"]?>"
class="<?= $data["config"]["class"]?>">



    


      <?php foreach ($data["fields"] as $name => $configField):?>
        <div class="form-group row">
          <div class="col-sm-12">


            <?php if($configField["type"] == "captcha"):?>
                <img src="script/captcha.php" width="300px">
            <?php endif;?>
            <?php if($configField["type"] == "hidden"):?>
              <input
              value="<?= $configField["value"]?>"
              type="hidden"
              name="<?= $name??'' ?>"
              >
            <?php endif;?>
            <input 
                value="<?= (isset($inputData[$name]) && $configField["type"]!="password")?$inputData[$name]:'' ?>"
                type="<?= $configField["type"]??'' ?>"
                name="<?= $name??'' ?>"
                placeholder="<?= $configField["placeholder"]??'' ?>"
                class="<?= $configField["class"]??'' ?>"
                id="<?= $configField["id"]??'' ?>"
                <?=(!empty($configField["required"]))?"required='required'":""?> >
        </div>
      </div>
      <?php endforeach;?>



  <button class="btn btn-primary"><?= $data["config"]["submit"];?></button>
</form>





<!--
  <form class="user">
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
      </div>
      <div class="col-sm-6">
        <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
      </div>
    </div>
    <div class="form-group">
      <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
    </div>
    <div class="form-group row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
      </div>
      <div class="col-sm-6">
        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
      </div>
    </div>
    <a href="login.html" class="btn btn-primary btn-user btn-block">
      Register Account
    </a>
    <hr>
    <a href="index.html" class="btn btn-google btn-user btn-block">
      <i class="fab fa-google fa-fw"></i> Register with Google
    </a>
    <a href="index.html" class="btn btn-facebook btn-user btn-block">
      <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
    </a>
  </form>
  -->