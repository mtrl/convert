# Notes

cd to ec2automation
Run ./ec2_startup... 

## Download
ssh to new instance
run "nohup ./downloadflvs [number] &"
ps -e | grep wget to watch for running wget processes, when all complete next step

## Convert
delete all wget-log in flvs dir
nohup ./convertflvs&
to monitor > watch -n 1 du -h mp4s --max-depth=0
Can now exit terminal

sudo resize2fs /dev/sda1
