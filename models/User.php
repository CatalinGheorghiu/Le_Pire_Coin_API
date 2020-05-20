<?php
class User
{
    //DB stuff
    private $conn;
    private $table = 'Users';

    //User Proprieties
    public $id;
    public $email;
    public $name;
    public $password;

    //Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get users
    public function read()
    {
        //Create query
        $query = "  SELECT
                        id,
                        email,
                        name
                    FROM
                        $this->table";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();
        return $stmt;
    }

    public function read_single()
    {
        //Create query
        $query = "  SELECT
                        id,
                        email,
                        name
                    FROM
                        $this->table
                    WHERE
                        id = :id";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindValue(':id', $this->id);

        //Execute query
        $stmt->execute();

        //Fetch
        $row = $stmt->fetch(PDo::FETCH_ASSOC);

        //Set proprieties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->email = $row['email'];
    }

    //Create User
    public function create()
    {
        //Create query
        $query = "  INSERT INTO $this->table
                        (name,
                        email,
                        password)
                    VALUES( 
                        :name,
                        :email,
                        :password)";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':password', password_hash($this->password, PASSWORD_BCRYPT));

        //Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %.\n", $stmt->error);
            return false;
        }
    }

    //Update user
    public function update()
    {
        //Create query
        $query = "  UPDATE
                        $this->table
                    SET
                        name = :name,
                        email = :email
                    WHERE
                        id = :id";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //Print error if something goes wrong
            printf("Error: %.\n", $stmt->error);
            return false;
        }
    }

    //Delete user
    public function delete()
    {
        //Create query
        $query = "  DELETE FROM
                        $this->table
                    WHERE
                        id = :id";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindValue(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %.\n", $stmt->error);
            return false;
        }
    }
}
