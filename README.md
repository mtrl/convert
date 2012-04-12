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
watch -n 1 du flvs to check is running in bg
Can now exit terminal

sudo resize2fs /dev/sda1
