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


}

