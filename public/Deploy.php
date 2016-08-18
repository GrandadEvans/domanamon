<pre>
<?php
if (array_key_exists('branch', $_GET) && $_GET['branch'] === 'stable') {
    echo shell_exec('
        cd ../
        echo "git log -1"
        echo "=========="
        git log -1 
        echo
    
        echo "git checkout stable"
        echo "==================="
        git checkout stable
        echo
    
        echo "git pull"
        echo "========"
        git pull
        echo
    
        echo "git log -1"
        echo "=========="
        git log -1
    ');
}
?>
</pre>
