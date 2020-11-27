<?php


class Mentees extends Database{


    public $table   = 'signup';
    public $pk      = 'user_id';
    public $oby     = "";
    public $tabrows = 0;

    public $mentee_id              = '';
    public $mentee_name            = '';
    public $mentee_email           = '';
    public $mentee_password        = '';
    public $mentee_dob             = '';

    public $Query;


    function setvalues($mentee_name, $mentee_email, $mentee_password, $mentee_dob){

      $this->mentee_name     = $mentee_name;
      $this->mentee_email    = $mentee_email;
      $this->mentee_password = $mentee_password;
      $this->mentee_dob      = $mentee_dob;
  }

  public function FetchAll($sql){
        return $this->Query = mysqli_query($this->connect(), $sql);
    }

    /*
        * fetch single row from specific table
    */ 

    public function Single(){
        return mysqli_fetch_row($this->Query);
    }


  public function Query($param){
    $sql = "SELECT * FROM mentees WHERE mentee_email='$param'";

     return $this->Query = mysqli_query($this->connect(), $sql);

    }


  public function CountRows(){
        return $rows = mysqli_num_rows($this->Query);
    }



    function insert(){

      $mentee_name     = $this->mentee_name;
      $mentee_email    = $this->mentee_email;
      $mentee_password = md5($this->mentee_password);
      $mentee_dob      = $this->mentee_dob;

      $sql = "INSERT INTO mentees (mentee_name,mentee_email,mentee_password,mentee_dob) VALUES ('$mentee_name','$mentee_email','$mentee_password','$mentee_dob')";
      return $results = mysqli_query($this->connect(), $sql);

      // return $results->execute([$mentee_name, $mentee_email, $mentee_password, $mentee_dob, $verify_token]);
      // $sql = "INSERT INTO `mentors` (mentors_name,mentors_email,mentors_password,mentors_dob) VALUES ( '$mentors_name', '$mentors_email', 'mentors_password', 'mentors_dob')";

      // return $this->Query = $this->connect()->query($sql);
  }



  function activate($token) {


    $this->Query("SELECT * FROM mentees WHERE verify_token = ?", [$token]);

    $counter = $this->CountRows();

    if($counter > 0) {

    $sql =  "UPDATE  mentees 
              SET
                status = 1,
                verify_token = ''

                          WHERE verify_token = ?";

    $results = $this->connect()->prepare($sql);

    $results->execute([$token]);

    return 1;

    }
    else
      {
          return 0;
      }
  }



}
?>