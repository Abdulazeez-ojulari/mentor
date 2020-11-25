<?php


class Mentors extends Database{


    public $table   = 'signup';
    public $pk      = 'user_id';
    public $oby     = "";
    public $tabrows = 0;

    public $mentors_id              = '';
    public $mentors_name            = '';
    public $mentors_email           = '';
    public $mentors_password        = '';
    public $mentors_dob             = '';

    public $Query;


    function setvalues($mentors_name, $mentors_email, $mentors_password, $mentors_dob){

      $this->mentors_name     = $mentors_name;
      $this->mentors_email    = $mentors_email;
      $this->mentors_password = $mentors_password;
      $this->mentors_dob      = $mentors_dob;
  }

  public function FetchAll($row){
        return $this->Query = mysqli_fetch_assoc($row);
    }

    /*
        * fetch single row from specific table
    */ 

    public function Single(){
        return mysqli_fetch_row($this->Query);
    }


  public function Query($param){
    $sql = "SELECT * FROM mentors WHERE mentors_email='$param'";

     return $this->Query = mysqli_query($this->connect(), $sql);

    }

    public function getMenteesMentors($id){
    $sql = "SELECT * FROM mentorsMentee WHERE mentee_id='$id'";

     return $this->Query = mysqli_query($this->connect(), $sql);

    }

    public function getMentors(){
    $sql = "SELECT * FROM mentors";

     return $this->Query = mysqli_query($this->connect(), $sql);

    }

    public function getMentorsbById($id){
    $sql = "SELECT * FROM mentors WHERE mentors_id='$id'";

     return $this->Query = mysqli_query($this->connect(), $sql);

    }

    public function insert_mentor($mentee_id,$mentors_id,$mentors_name,$mentors_email,$mentors_dob){

    $sql = "INSERT INTO mentorsmentee (mentee_id,mentor_id,mentor_name,mentor_email,mentor_dob) VALUES ('$mentee_id','$mentors_id', '$mentors_name', '$mentors_email', '$mentors_dob')";

      return $results = mysqli_query($this->connect(), $sql);

    }


  public function CountRows(){
        return $rows = mysqli_num_rows($this->Query);

    }



    public function insert(){

      $mentors_name     = $this->mentors_name;
      $mentors_email    = $this->mentors_email;
      $mentors_password = md5($this->mentors_password);
      $mentors_dob      = $this->mentors_dob;

      $sql = "INSERT INTO mentors (mentors_name,mentors_email,mentors_password,mentors_dob) VALUES ( '$mentors_name', '$mentors_email', '$mentors_password', '$mentors_dob')";

      return $results = mysqli_query($this->connect(), $sql);
      // $this->Query->bind_param('ssss',$mentors_name,$mentors_email,$mentors_password,$mentors_dob);
      // // $this->Query->bind_param(':mentors_email', $mentors_email);
      // // $this->Query->bind_param(':mentors_password', $mentors_password);
      // // $this->Query->bind_param(':mentors_dob', $mentors_dob);
      // $this->Query->execute();
      // echo $this->errorCode();
  }



  function activate($token) {


    $this->Query("SELECT * FROM mentors WHERE verify_token = ?", [$token]);

    $counter = $this->CountRows();

    if($counter > 0) {

    $sql =  "UPDATE  mentors 
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