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

/**
 * @todo Change to switch/case but I'm in a rush and just need something to push in the new staging branch
 */
if (array_key_exists('branch', $_GET) && $_GET['branch'] === 'staging') {
    echo 'Nothing to see here! Move along please!!!';
}
?>
</pre>
