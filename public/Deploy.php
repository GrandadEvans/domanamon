<?php

/**
 * GIT DEPLOYMENT SCRIPT
 *
 * Used for automatically deploying websites via github or bitbucket, more deets here:
 *
 *        https://gist.github.com/1809044
 */
// The commands
$commands = array(

);

// Run the commands for output
$command = 'cd /home/domanamo/public_html/john/domanamon && git status && git log -1 && git checkout stable && git pull && git status && git log -1';
$tmp = shell_exec($command);
$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
$output .= htmlentities(trim($tmp)) . "\n";
// Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
 .  ____  .   _____________________________
 |/      \|  |                             |
[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |] | Git Deployment Script v0.1  |
 |___==___|__/              &copy; oodavid 2012 |
          |________________________________|

<?php echo $output; ?>
</pre>
</body>
</html>
