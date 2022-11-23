<?php
class User {
    private int $id;
    private string $login;
    private mysqli $db;
    private string $password;
    private string $firstName;
    private string $lastName;
    

    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;   
        $this->firstName = "";
        $this->lastName = "";
        global $db;
        $this->db = &$db;

    }
    public function register() : bool{
        $passwordHash = password_hash($this->password, PASSWORD_ARGON2I);
        $q = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?)";
        $preparedQuery = $this->db->prepare($q);
        $preparedQuery->bind_param('ssss', $this->login, $passwordHash, $this->firstName, $this->lastName);
        $result = $preparedQuery->execute();
       
        return $result;
        
    }
    public function logowanie() :bool {
        $q = "SELECT * FROM user WHERE login = ? LIMIT 1";
        
        $preparedQuery = $this->db->prepare($q);
        $preparedQuery->bind_param('s', $this->login);
        $preparedQuery->execute();
        $result = $preparedQuery->get_result();
        if($result->num_rows == 1) {
        $row = $result->fetch_assoc();    
        $passwordHash = $row['password'];
        if(password_verify($this->password, $passwordHash)) {
           
            $this->id = $row['id'];
            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            return true;
        }
        else {
            echo "Błędny login lub hasło";
            return false;
        }
        }
        
        else {
            return false;
        }
        
    }
    public function setFirstName(string $firstName) {
         $this->firstName = $firstName;
    }
    public function setLastName(string $lastName) {
        $this->lastName = $lastName;
   }
   public function getName() : string {
    return $this->firstName . "" . $this->lastName;
   }
}

?>