Add-Type -AssemblyName System.Drawing
$filePath = Join-Path (Get-Location) 'public/images/icon_rpl.png'
$bmp = New-Object System.Drawing.Bitmap $filePath
Write-Output "icon_rpl.png: Width=$($bmp.Width), Height=$($bmp.Height)"
$bmp.Dispose()
