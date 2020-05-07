<?php
set_time_limit(0);
include 'Instagram.class.php';
clear();
echo "
 *  DK BotZ Patch [v 1.2020]   *
 *  DAILY 50-100 Followers     *
 *  Credits :- B4D_30Y,        *
 *  Don't use for Re-sale      * 
 *  RECOMMENDED SLEEP 100s     *
  
    •••••••••••••••••••••••••••••••••••••••••
    
 * Only one MAC address can use this script.
 * Make sure Sleep Time is 65s -75s Minimum
 * I am not responsible if action block issue for your account using this tool.
 * Make sure your account 2Step factor is Off.(Notice).
 
";
$username    = getUsername();
$password    = getPassword();

echo '•••••••••••••••••••••••••••••••••••••••••' . PHP_EOL . PHP_EOL;
$login = login($username, $password);
if ($login['status'] == 'success') {
    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
    $data_login = array(
        'username' => $login['username'],
        'csrftoken' => $login['csrftoken'],
        'sessionid' => $login['sessionid']
    );

    $slee = getComment('[?]  Sleep in Seconds ( RECOMMENDED 100s ) : ');
  
    while (true) {

        if (n8off() == true):
       $sleep = $slee + rand(0,10);
        $profile    = getHome($data_login);
        $data_array = json_decode($profile);
        $result     = $data_array->user->edge_web_feed_timeline;
        foreach ($result->edges as $items) {
            $id       = $items->node->id;
            $username = $items->node->owner->username;
            $like     = like($id, $data_login);
            if ($like['status'] == 'error') {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Error Like' . PHP_EOL;
                logout($data_login);
                $login = login($username, $password);
                if ($login['status'] == 'success') {
                    echo '[*] Login as ' . $login['username'] . ' Success!' . PHP_EOL;
                    $data_login = array(
                        'username' => $login['username'],
                        'csrftoken' => $login['csrftoken'],
                        'sessionid' => $login['sessionid']
                    );
                }else{

                    die("Something went wrong");

                }
            } else {
                echo '[+] Username: ' . $username . ' | Media_id: ' . $id . ' | Like Success' . PHP_EOL;
            }
            break;
        }
        echo '[+] [' . date("H:i:s") . '] Sleep for ' . $sleep . ' seconds [+]' . PHP_EOL;
        sleep( $sleep);
        echo '•••••••••••••••••••••••••••••••••••••••••' . PHP_EOL . PHP_EOL;
        else:

            echo "Today Service is over next Run time is 11 AM".PHP_EOL.PHP_EOL;

        sleep(rand(100,600));

        endif;

    }




} else

    echo json_encode($login);
