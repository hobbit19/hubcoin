<?php






$id=1;

if ($id)
    print 'ok';

die();



//$_REQUEST['action']='update';
//$_REQUEST['id']='10';
//$_REQUEST['quantity']='10000';

// изменение количества товара в корзине
switch (isset($_REQUEST['action']) && $_REQUEST['action'] == 'update') {
    case 'update':
        $id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 1
                )
            )
        ) : false;

        $quantity = isset($_REQUEST['quantity']) ? filter_var($_REQUEST['quantity'], FILTER_VALIDATE_INT,
            array(
                'options' => array(
                    'min_range' => 1,
                    'max_range' => 1000
                )
            )
        ) : false;

        if ($id !== false && $quantity !== false) {
            print "$id, $quantity";
        } else {
            echo json_encode(array('result' => 'error', 'desc' => 'parameters "id" or "quantity" not valid'));
        }

        break;

    default:
        echo json_encode(array('result' => 'error', 'desc' => 'action not found'));
}


?>