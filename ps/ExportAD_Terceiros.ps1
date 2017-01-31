Import-Module ActiveDirectory
Get-ADUser -Filter * -SearchBase "OU=Terceiros,OU=OU_Users,DC=pia,DC=com,DC=br" -Properties * |
 Select -Property sAMAccountName,Enabled,created,LastLogonDate,DisplayName,Company,department,Mail | 
 Export-CSV "C:\inetpub\wwwroot\sisti\ps\AD_Usuarios_Terceiros.csv" -NoTypeInformation -Encoding UTF8