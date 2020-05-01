<?php

function mongoSearchGet ( $type ) {
    try {

        $mng = new MongoDB\Driver\Manager("mongodb://mongodb:27017");
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = [ 'type' => 'search' ]; 
        $query = new MongoDB\Driver\Query($filter);

        $res = $mng->executeQuery('pageperformance.cache', $query);
        $result = current($res->toArray());
    
        if ( !empty($result) ) {
            return $result->$type;
        } else {
            return null;
        }

    }  catch (MongoDB\Driver\Exception\Exception $e) {

        $filename = basename(__FILE__);
        
        $arr = array('error' => "The " . $filename . " script has experienced an error and has failed with the following exception\nException:" . $e->getMessage() . "\n
            In file:" . $e->getFile() . "\n
            On line:" . $e->getLine() . "\n" );
        return (json_encode( $arr ));      
    }

}

?>