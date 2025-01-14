#1 check cron
#2 check permission ```ls -l```
#3 check latest file created/update ```sudo find . -name '*.php' -mtime -1 -type f -printf '%TY-%Tm-%Td %TH:%TM %p\n' | sort -r```
#4 find malware code: ```sudo grep -r '$fpn = "f"."o"."p"."e"."n";' . ```
