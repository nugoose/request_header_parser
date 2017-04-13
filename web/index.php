<html>
    <head>
        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <!-- css -->
        <link type='text/css' rel='stylesheet' href='rhp.css'>
    </head>
    
    <body>
        <div id='mainBody'>
            <h2>request header parser</h2>
        
            <?php
            
                function get_ip() {
                    $ipaddress = '';
                    #all of the http ones could be set by a proxy and/or spoofed, so not the real ip
                    if (isset($_SERVER['HTTP_CLIENT_IP']))
                        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    else if(isset($_SERVER['HTTP_X_FORWARDED']))
                        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                    else if(isset($_SERVER['HTTP_FORWARDED']))
                        $ipaddress = $_SERVER['HTTP_FORWARDED'];
                    #remote_addr is the most reliable, thought not 100% certain to give the real ip
                    else if(isset($_SERVER['REMOTE_ADDR']))
                        $ipaddress = $_SERVER['REMOTE_ADDR'];
                    else
                        $ipaddress = 'UNKNOWN';
                    return $ipaddress;
                }
                
                function get_os(){
                    $browser_info = '';
                    $user_agent = $_SERVER['HTTP_USER_AGENT'];
                    
                    $os_platform = 'unknown OS platform';
                    $os_array = array(
                            '/windows nt 10.0/i'    =>  'Windows 10',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );
                    foreach($os_array as $regex => $val){
                        if(preg_match($regex, $user_agent)){
                            $os_platform = $val;
                        }
                    }
                    
                    return $os_platform;
                    
                }
            
                $ip = get_ip();
                $browser = get_os();
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                print("<h3>your ip seems to be: <span>$ip</span></h3>");
                print("<h3>OS info: <span>$browser</span></h3>");
                print("<h3>language: <span>$lang</span></h3>");
                #print_r($_SERVER);
        
            ?>
    
            <h2>made with php, hosted on cloud9 <3</h2>
        </div>
    </body>
</html>