Import-Module ActiveDirectory
Get-ADUser -Filter 'Company -like "*Nova*"' -Properties * |
  Select -Property sAMAccountName,Enabled,Company,department,homephone,Mail,LastLogonDate | 
  Export-CSV "C:\inetpub\wwwroot\sisti\ps\AD_Users_Filtro.csv" -NoTypeInformation -Encoding UTF8