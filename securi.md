# Steps to Check and Remove Malicious Cron Jobs

## 1. Check Cron Jobs
Review the system and user-specific cron jobs for any unauthorized entries:
```
bash
crontab -l
sudo crontab -l
```
## 2. Check File Permissions
Verify file and directory permissions to ensure there are no misconfiguration:
```
ls -l
```
## 3. Check Recently Created/Updated Files
Find PHP files created or modified in the last day:
```
sudo find . -name '*.php' -mtime -1 -type f -printf '%TY-%Tm-%Td %TH:%TM %p\n' | sort -r
```
## 4. Check Recently Created/Updated Files
Look for specific patterns that may indicate malicious code:
```
sudo grep -r '$fpn = "f"."o"."p"."e"."n";' .
```
## 4. Monitor Processes
Look for suspicious processes, especially ones involving network connections or backdoors.
```
ps aux | grep 'nc'
```
