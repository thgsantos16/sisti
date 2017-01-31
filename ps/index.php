<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Testing PowerShell</title>
</head>
<body>
<?php

$psScriptPath = 'C:\inetpub\wwwroot\sisti\ps\ExportAD_Users.ps1';

$query = shell_exec("powershell -command $psScriptPath -username 'thiago.santos'< NUL");
echo $query;    

?>
</body>
</html>