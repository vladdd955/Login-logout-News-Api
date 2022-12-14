<?php


namespace App\Services;



use Doctrine\DBAL\Connection;





class RegisterService
{
    private Connection $connection;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'news api',
            'user' => 'root',
            'password' => 'nishiki555',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }

        public function execute(RegisterServiceRequest $request)
    {


         $emailCheck = $request->getEmail();
        $emailToData = $this->connection->executeQuery("SELECT email FROM users WHERE email = '$emailCheck' " )->rowCount();
        if($emailToData == 1){
            die;
        }
                $this->connection->insert(
                    "users",
                    [
                        "name"=>$request->getName(),
                        "email"=>$request->getEmail(),
                        "password"=>$request->getPassword(),
                    ]
                );
    }
    
    public function checkInLogin(): Navigation
    {
        $email =   $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        $result = $this->connection->executeQuery('SELECT  id, name, email, password FROM news api.users WHERE email = ?', [$email]);
        $user = $result->fetchAssociative();

        if ($email == $user['email'] && $user['password'] == $password) {
            echo "hey from register";

            return new Navigation("/");
        } else {
            return new Navigation("/authorization");
        }
    }


}

