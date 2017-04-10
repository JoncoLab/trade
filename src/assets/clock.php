<?php
function get24hTime() {
    $time = null;
    if (date("a") === 'pm') {
        switch (date("h")) {
            case '01':
                $time = '13:' . date("i:s");
                break;
            case '02':
                $time = '14:' . date("i:s");
                break;
            case '03':
                $time = '15:' . date("i:s");
                break;
            case '04':
                $time = '16:' . date("i:s");
                break;
            case '05':
                $time = '17:' . date("i:s");
                break;
            case '06':
                $time = '18:' . date("i:s");
                break;
            case '07':
                $time = '19:' . date("i:s");
                break;
            case '08':
                $time = '20:' . date("i:s");
                break;
            case '09':
                $time = '21:' . date("i:s");
                break;
            case '10':
                $time = '22:' . date("i:s");
                break;
            case '11':
                $time = '23:' . date("i:s");
                break;
            default:
                $time = date("h:i:s");
        }
    } else {
        $time = date("h:i:s");
    }
    return $time;
}
$dateAndTime = get24hTime();
print $dateAndTime;
?>