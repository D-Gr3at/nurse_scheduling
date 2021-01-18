<?php


class NursesList extends DataBase
{

    private $conn;

    /**
     * NursesList constructor.
     */
    public function __construct()
    {
        $this->conn = $this->getInstance();
    }

    public function activeList($data){
        $sql = "SELECT first_name, last_name, nd.position, nd.ward, phone_number, created, na.id FROM nurse_account na
                INNER JOIN nurse_details nd ON nd.nurse_id = na.id INNER  JOIN nurse_tracker nt ON nt.nurse_id = na.id WHERE nt.status = 'ACTIVE'";

        if (!empty($data['search']['value'])){
            $query = $data['search']['value'];
            $sql .= " AND ( na.first_name LIKE '%".$query."%'";
            $sql .= " OR na.last_name LIKE '%".$query."%'";
            $sql .= " OR nd.position LIKE '%".$query."%'";
            $sql .= " OR nd.ward LIKE '%".$query."%'";
            $sql .= " OR phone_number LIKE '%".$query."%')";
        }

        //order
        $col = array(
            0 => 'first_name',
            1 => 'last_name',
            2 => 'nd.position',
            3 => 'nd.ward',
            4 => 'phone_number',
            5 => 'created',
            6 => 'na.id',
        );
        $sql .= " ORDER BY ".$col[$data['order'][0]['column']]. " ".$data['order'][0]['dir']." LIMIT ".$data['start'].", ".$data['length']."";
//                echo $sql.'\n';
        file_put_contents('file.txt', $sql);
        $result = $this->conn->query($sql);

        $totalData = $result->num_rows;
        $totalFilter = $totalData;
        $arr = $result->fetch_all(MYSQLI_NUM);

        $dat = array();

        foreach ($arr as $row){
            $subData = array();
            $subData[] = $row[0];
            $subData[] = $row[1];
            $subData[] = $row[2];
            $subData[] = $row[3];
            $subData[] = $row[4];
            $subData[] = $row[5];
            $subData[] = '<div class="btn-group">
                            <button type="button" class="btn btn-warning btn-flat">Action</button>
                            <button type="button" class="btn btn-warning btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="javascript:Void(0)" onclick="viewProfile('.$row[6].')">View Profile</a>
                            </div>
                          </div>';
            $dat[] = $subData;
        }
//        <div class="dropdown-divider"></div>


        $response = array(
            'draw' => intval($data['draw']),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFilter),
            'data' => $dat,
        );
        file_put_contents('res.txt', json_encode($response));
        echo json_encode($response);
    }

    public function nonActive($data){
        $sql = "SELECT first_name, last_name, nd.position, nd.ward, phone_number, created, na.id FROM nurse_account na
                INNER JOIN nurse_details nd ON nd.nurse_id = na.id INNER JOIN nurse_tracker nt ON nt.nurse_id = na.id WHERE nt.status = 'OFF_DAY'";

        if (!empty($data['search']['value'])){
            $query = $data['search']['value'];
            $sql .= " AND ( na.first_name LIKE '%".$query."%'";
            $sql .= " OR na.last_name LIKE '%".$query."%'";
            $sql .= " OR nd.position LIKE '%".$query."%'";
            $sql .= " OR nd.ward LIKE '%".$query."%'";
            $sql .= " OR phone_number LIKE '%".$query."%')";
        }
        //order
        $col = array(
            0 => 'first_name',
            1 => 'last_name',
            2 => 'nd.position',
            3 => 'nd.ward',
            4 => 'phone_number',
            5 => 'created',
            6 => 'na.id',
        );
        $sql .= " ORDER BY ".$col[$data['order'][0]['column']]. " ".$data['order'][0]['dir']." LIMIT ".$data['start'].", ".$data['length']."";
//                echo $sql.'\n';
        file_put_contents('file.txt', $sql);
        $result = $this->conn->query($sql);

        $totalData = $result->num_rows;
        $totalFilter = $totalData;
        $arr = $result->fetch_all(MYSQLI_NUM);

        $dat = array();

        foreach ($arr as $row){
            $subData = array();
            $subData[] = $row[0];
            $subData[] = $row[1];
            $subData[] = $row[2];
            $subData[] = $row[3];
            $subData[] = $row[4];
            $subData[] = $row[5];
            $subData[] = '<div class="btn-group">
                            <button type="button" class="btn btn-warning btn-flat">Action</button>
                            <button type="button" class="btn btn-warning btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="javascript:Void(0)" onclick="viewProfile('.$row[6].')">View Profile</a>
                            </div>
                          </div>';
            $dat[] = $subData;
        }

        $response = array(
            'draw' => intval($data['draw']),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFilter),
            'data' => $dat,
        );
        file_put_contents('res.txt', json_encode($response));
        echo json_encode($response);
    }

    public function onLeave($data){
        $sql = "SELECT first_name, last_name, nd.position, nd.ward, phone_number, created, na.id FROM nurse_account na
                INNER JOIN nurse_details nd ON nd.nurse_id = na.id INNER JOIN nurse_tracker nt ON nt.nurse_id = na.id WHERE nt.status = 'LEAVE'";

        if (!empty($data['search']['value'])){
            $query = $data['search']['value'];
            $sql .= " AND ( na.first_name LIKE '%".$query."%'";
            $sql .= " OR na.last_name LIKE '%".$query."%'";
            $sql .= " OR nd.position LIKE '%".$query."%'";
            $sql .= " OR nd.ward LIKE '%".$query."%'";
            $sql .= " OR phone_number LIKE '%".$query."%')";
        }
        //order
        $col = array(
            0 => 'first_name',
            1 => 'last_name',
            2 => 'nd.position',
            3 => 'nd.ward',
            4 => 'phone_number',
            5 => 'created',
            6 => 'na.id',
        );
        $sql .= " ORDER BY ".$col[$data['order'][0]['column']]. " ".$data['order'][0]['dir']." LIMIT ".$data['start'].", ".$data['length']."";
//                echo $sql.'\n';
        file_put_contents('file.txt', $sql);
        $result = $this->conn->query($sql);

        $totalData = $result->num_rows;
        $totalFilter = $totalData;
        $arr = $result->fetch_all(MYSQLI_NUM);

        $dat = array();

        foreach ($arr as $row){
            $subData = array();
            $subData[] = $row[0];
            $subData[] = $row[1];
            $subData[] = $row[2];
            $subData[] = $row[3];
            $subData[] = $row[4];
            $subData[] = $row[5];
            $subData[] = '<div class="btn-group">
                            <button type="button" class="btn btn-warning btn-flat">Action</button>
                            <button type="button" class="btn btn-warning btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="javascript:Void(0)" onclick="viewProfile('.$row[6].')">View Profile</a>
                            </div>
                          </div>';
            $dat[] = $subData;
        }

//        <a class="dropdown-item" href="javascript:Void(0)" onclick="deleteNurse('.$row[6].')">Delete</a>

        $response = array(
            'draw' => intval($data['draw']),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFilter),
            'data' => $dat,
        );
        file_put_contents('res.txt', json_encode($response));
        echo json_encode($response);
    }

    public function allNurses($data){
        $sql = "SELECT first_name, last_name, nd.position, nd.ward, phone_number, created, na.id FROM nurse_account na
                INNER JOIN nurse_details nd ON nd.nurse_id = na.id INNER  JOIN nurse_tracker nt ON nt.nurse_id = na.id WHERE na.verified = 1";

        if (!empty($data['search']['value'])){
            $query = $data['search']['value'];
            $sql .= " AND ( na.first_name LIKE '%".$query."%'";
            $sql .= " OR na.last_name LIKE '%".$query."%'";
            $sql .= " OR nd.position LIKE '%".$query."%'";
            $sql .= " OR nd.ward LIKE '%".$query."%'";
            $sql .= " OR phone_number LIKE '%".$query."%')";
        }

        //order
        $col = array(
            0 => 'first_name',
            1 => 'last_name',
            2 => 'nd.position',
            3 => 'nd.ward',
            4 => 'phone_number',
            5 => 'created',
            6 => 'na.id',
        );
        $sql .= " ORDER BY ".$col[$data['order'][0]['column']]. " ".$data['order'][0]['dir']." LIMIT ".$data['start'].", ".$data['length']."";
//                echo $sql.'\n';
        file_put_contents('file.txt', $sql);
        $result = $this->conn->query($sql);

        $totalData = $result->num_rows;
        $totalFilter = $totalData;
        $arr = $result->fetch_all(MYSQLI_NUM);

        $dat = array();

        foreach ($arr as $row){
            $subData = array();
            $subData[] = $row[0];
            $subData[] = $row[1];
            $subData[] = $row[2];
            $subData[] = $row[3];
            $subData[] = $row[4];
            $subData[] = $row[5];
            $subData[] = '<div class="btn-group">
                            <button type="button" class="btn btn-warning btn-flat">Action</button>
                            <button type="button" class="btn btn-warning btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                              <a class="dropdown-item" href="javascript:Void(0)" onclick="viewProfile('.$row[6].')">View Profile</a>
                            </div>
                          </div>';
            $dat[] = $subData;
        }
//        <div class="dropdown-divider"></div>


        $response = array(
            'draw' => intval($data['draw']),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFilter),
            'data' => $dat,
        );
        file_put_contents('res.txt', json_encode($response));
        echo json_encode($response);
    }
}