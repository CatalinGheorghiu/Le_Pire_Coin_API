<?php
class Post
{
    //DB stuff
    private $conn;
    private $table = 'Posts';

    //Post Proprieties
    public $id;
    public $name;
    public $title;
    public $body;
    public $user_id;
    public $created_at;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Posts
    public function read()
    {
        //Create query
        $query = "  SELECT 
                        u.name,
                        p.id,
                        p.title,
                        p.body,
                        p.user_id,
                        p.created_at as creation_time
                    FROM
                        $this->table p
                    LEFT JOIN
                        Users u ON p.user_id = u.id
                    ORDER BY 
                        p.created_at
                    DESC
                    ";
        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();
        return $stmt;
    }

    //Get single post
    public function read_single()
    {
        //Create query
        $query = "  SELECT 
                        u.name,
                        p.id,
                        p.title,
                        p.body,
                        p.user_id,
                        p.created_at as creation_time
                    FROM
                        $this->table p
                    LEFT JOIN
                        Users u ON p.user_id = u.id
                    WHERE
                        p.id = ?
                    LIMIT 0,1
                    ";
        //Prepare Statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);
        //Execute query
        $stmt->execute();
        //Fetch
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        $this->name = $row['name'];
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->user_id = $row['user_id'];
        $this->creation_time = $row['creation_time'];

        // return $stmt;
    }

    //Create Post
    public function create()
    {
        //Create query
        $query = "  INSERT INTO 
                        $this->table
                    SET
                        title = :title,
                        body = :body,
                        user_id = :user_id";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        //Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':user_id', $this->user_id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //Print error if something goes wrong
            printf("Error: %.\n", $stmt->error);
            return false;
        }
    }

    //Update Post
    public function update()
    {
        //Create query
        $query = "  UPDATE
                        $this->table
                    SET
                        title = :title,
                        body = :body,
                        user_id = :user_id
                    WHERE
                        id = :id";


        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->id = htmlspecialchars(strip_tags($this->id));


        //Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //Print error if something goes wrong
            printf("Error: %.\n", $stmt->error);
            return false;
        }
    }

    //Delete Post
    public function delete()
    {
        //Create Query
        $query = "  DELETE FROM
                        $this->table
                    WHERE
                        id = :id";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':id', $this->id);

        //Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            //Print error if something goes wrong
            printf("Error: %.\n", $stmt->error);
            return false;
        }
    }
}
