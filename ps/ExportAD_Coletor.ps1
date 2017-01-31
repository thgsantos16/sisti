Import-Module ActiveDirectory
Get-ADUser -Filter * -SearchBase "OU=Usuarios Coletores,OU=OU_Users,DC=pia,DC=com,DC=br" -Properties * |
 Select -Property sAMAccountName,Enabled,created,LastLogonDate,Company,department,homephone | 
 Export-CSV "C:\inetpub\wwwroot\sisti\ps\AD_Usuarios_Col.csv" -NoTypeInformation -Encoding UTF8