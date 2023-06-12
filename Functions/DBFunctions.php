<?php

function select($conn, string $table, array $columns, string $condition = null, string $orderBy = null, int $limit = null)
{
    $columns = implode(", ", array_values($columns));

    $row = array();

    $query = "SELECT $columns FROM $table";
    is_null($condition) ? null : $query .= " WHERE $condition";
    is_null($orderBy)  ?  null : $query .=  " ORDER BY $orderBy";
    is_null($limit)    ?  null : $query .=  " LIMIT $limit";

    try {
        $result = $conn->query($query);

        if ($result == true) {

            if ($result->num_rows > 0 ) {
                for($i = 0; $row[$i] = $result->fetch_assoc(); $i++) ; // return data as an array
                array_pop($row); // Delete last empty one because  it will be null always
                return $row;
            } else {
                return $row;
            }

        } else {
            throw new Exception("Some Thing Wrong When To Get Data");
        }

    } catch (\Exception $exception) {
        return $exception->getMessage();
    }
}
// if you need to get first user in select function  don't forget array[0]

function selectAll($conn, string $table, string $orderBy = null, int $limit = null)
{
    $row = array();
    $query = "SELECT * FROM $table";
    is_null($orderBy) ? null : $query .=  " ORDER BY $orderBy";
    is_null($limit)   ? null : $query .=  " LIMIT $limit";

    try {
        $result = $conn->query($query);

        if ($result == true) {

            if ($result->num_rows > 0 ) {
                for($i = 0; $row[$i] = $result->fetch_assoc(); $i++) ; // return data as an array
                array_pop($row); // Delete last empty one because  it will be null always
                return $row;
            } else {
                return $row;
            }

        } else {
            throw new Exception("Some Thing Wrong When To Get Data");
        }

    } catch (\Exception $exception) {
        return $exception->getMessage();
    }

}

function findOrFail($conn, string $table, string $condition)
{
    $query = "SELECT 1 FROM $table WHERE $condition";

    try {
        $result = $conn->query($query);

        if ($result == true) {

            if (!empty($result->num_rows)) {
                return true;
            } else {
                throw new Exception("unfounded element");
            }

        } else {
            throw new Exception("Some Thing Wrong When To Get Data");
        }

    } catch (\Exception $exception) {
        return $exception->getMessage();
    }
}
// findOrFail($conn,"bitcoin_payments","status = 0 ");

function insert($conn, string $table, array $data)
{
    // prepare array to query and protect from sql injection
    $columns = implode(", ", array_keys($data));
    $escaped_values = array_map( array($conn, 'real_escape_string'), array_values($data) );
    $values  = implode("', '", $escaped_values);

    // insert query
    $query = "INSERT INTO `$table`($columns) VALUES ('$values')";

    try {
        $insert_data = $conn->query($query);
        if ($insert_data === true) {
            return true;
        } else {
            throw new Exception("Some Thing Go Wrong When Insert Data");
        }

    } catch (\Exception $exception) {
        return $exception->getMessage();
    }
}
//insert($conn,"bitcoin_payments",["txid" => "3e23423j4k4j4","address" => "dhfjhfkjsfhs", "value" => "43243","status" => "0"]);

function update($conn, string $table, array $data, string $condition)
{
    $check_element = findOrFail($conn, $table, $condition);

    if ($check_element === true) {
        // prepare array to query and protect from sql injection
        $query = "UPDATE $table SET ";
        $counter = 0;
        foreach ($data as $columns => $value) {
            $value = mysqli_real_escape_string($conn, $value);
            $query .= "$columns" . "=" . "'$value'";
            $counter++;
            if ($counter != count($data)) {
                $query .= ', ';
            }
        }
        $query .= " WHERE $condition";

        try {
            $update_data = $conn->query($query);
            if ($update_data === true) {
                return true;
            } else {
                throw new Exception("Some Thing Go Wrong When update Data");
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    } else {
        return false ;
    }
}
// update($conn,"bitcoin_payments",["txid" => "4264756657","address" => "dffsf","status" => "0"], "id = 402");

function delete($conn, string $table, string $condition)
{
    $check_element = findOrFail($conn, $table, $condition);

    if ($check_element === true) {
        $query = "DELETE FROM $table WHERE $condition";
        try {
            $delete_data = $conn->query($query);

            if ($delete_data === false) {
                throw new Exception("Some Thing Go Wrong When Delete Data");
            }
            return true;
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    } else {
        return false ;
    }
}
// delete($conn,"bitcoin_payments","id = 402");
