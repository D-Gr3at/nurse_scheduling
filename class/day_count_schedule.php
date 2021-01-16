<?php
include_once('C:\xampp\htdocs\nurse\assets\lib\dbcxn.inc.php');

class DayCountSchedule extends DataBase
{
    private $conn;

    /**
     * DayCountSchedule constructor.
     */
    public function __construct()
    {
        $this->conn = $this->getInstance();
    }

    public function countDay(){
        $nurses = $this->conn->query('SELECT status, day_count, id FROM nurse_tracker');
        $nurses = $nurses->fetch_all(MYSQLI_ASSOC);
        foreach ($nurses as $nurse){
            $dayCount = floatval($nurse['day_count']) + 1;
            $this->conn->query("UPDATE nurse_tracker SET day_count = $dayCount, status = 'ACTIVE' WHERE id = ".$nurse['id']);
        }
    }

    public function activeDays(){
        $nurses = $this->conn->query('SELECT status, day_count, id FROM nurse_tracker');
        $nurses = $nurses->fetch_all(MYSQLI_ASSOC);
        foreach ($nurses as $nurse){
            $dayCount = floatval($nurse['day_count']);
            if ($dayCount > 3){
                $this->conn->query("UPDATE nurse_tracker SET day_count = 0, status = 'OFF_DAY' WHERE id = ".$nurse['id']);
            }else{
                continue;
            }

        }
    }

}