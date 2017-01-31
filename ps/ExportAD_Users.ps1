Import-Module ActiveDirectory
Get-ADUser -Filter * -SearchBase "OU=Usuarios Pia,OU=OU_Users,DC=pia,DC=com,DC=br" -Properties * |
 Select -Property sAMAccountName,Enabled,created,LastLogonDate,Company,department,homephone,Mail | 
 Export-CSV "C:\inetpub\wwwroot\sisti\ps\AD_Usuarios_PIA.csv" -NoTypeInformation -Encoding UTF8