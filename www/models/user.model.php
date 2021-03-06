<?php
namespace HotelFactory\Models;
use HotelFactory\Core\helpers;

class User extends Model
{
    protected $id;
    protected $email;
    protected $password;
    protected $name;
    protected $firstname;
    protected $birthdate;
    protected $creation_date;
    protected $id_hf_role;
    protected $id_hf_company;


    public function __construct()
    {
        //parent::__construct(Model::class, 'Models');
    }

    public function setId($id)
    {
        $this->id=$id;
    }
    public function setFirstname($firstname)
    {
        $this->firstname=ucwords(strtolower(trim($firstname)));
    }
    public function setName($name)
    {
        $this->name=strtoupper(trim($name));
    }
    public function setEmail($email)
    {
        $this->email=strtolower(trim($email));
    }
    public function setPassword($password)
    {
        $this->password=$password;
    }
    public function setBirthdate($birthdate)
    {
        $this->birthdate=$birthdate;
    }
    public function setCreation_date($creation_date)
    {
        $this->creation_date=$creation_date;
    }
    public function setDd_hf_role($id_hf_role)
    {
        $this->id_hf_role=$id_hf_role;
    }
    public function setid_hf_company($id_hf_company)
    {
        $this->id_hf_company=$id_hf_company;
    }

    public static function getRegisterForm(){
        return [
                    "config"=>[
                        "method"=>"POST", 
                        "action"=>Helpers::getUrl("user", "register"),
                        "class"=>"user",
                        "id"=>"formRegisterUser",
                        "submit"=>"S'inscrire"
                        ],

                    "fields"=>[
                        "firstname"=>[
                            "type"=>"text",
                            "placeholder"=>"Votre prénom",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "min-length"=>2,
                            "max-length"=>50,
                            "errorMsg"=>"Votre prénom doit faire entre 2 et 50 caractères"
                            ],
                        "name"=>[
                            "type"=>"text",
                            "placeholder"=>"Votre nom",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "min-length"=>2,
                            "max-length"=>100,
                            "errorMsg"=>"Votre nom doit faire entre 2 et 100 caractères"
                            ],
                        "email"=>[
                            "type"=>"email",
                            "placeholder"=>"Votre email",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "uniq"=>["table"=>"users","column"=>"email"],
                            "errorMsg"=>"Le format de votre email ne correspond pas"
                            ],
                        "password"=>[
                            "type"=>"password",
                            "placeholder"=>"Votre mot de passe",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "errorMsg"=>"Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule et une majuscule"
                            ],
                        "passwordConfirm"=>[
                            "type"=>"password",
                            "placeholder"=>"Confirmation",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "confirmWith"=>"pwd",
                            "errorMsg"=>"Votre mot de passe de confirmation ne correspond pas"
                            ],
                        "captcha"=>[
                            "type"=>"captcha",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "placeholder"=>"Veuillez saisir les caractères",
                            "errorMsg"=>"Captcha incorrect"
                        ],
                        "birthdate"=>[
                            "type"=>"date",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "errorMsg"=>"Date invalide"
                        ]
                    ]
                ];
    }

    public static function getLoginForm(){
        return [

                ];
    }


}












