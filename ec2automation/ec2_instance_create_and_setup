#!/bin/bash

# Authorize TCP, SSH & ICMP for default Security Group
#ec2-authorize default -P icmp -t -1:-1 -s 0.0.0.0/0
#ec2-authorize default -P tcp -p 22 -s 0.0.0.0/0

# The Static IP Address for this instance:
#IP_ADDRESS=$(cat ~/.ec2/ip_address)
IP_ADDRESS=54.247.179.244
EC2_INSTANCE_KEY=conversions
# Create new t1.micro instance using ami-cef405a7 (64 bit Ubuntu Server 10.10 Maverick Meerkat)
# using the default security group and a 16GB EBS datastore as /dev/sda1.
# EC2_INSTANCE_KEY is an environment variable containing the name of the instance key.
# --block-device-mapping ...:false to leave the disk image around after terminating instance
EC2_RUN_RESULT=$(ec2-run-instances --instance-type c1.medium --group default --region eu-west-1 --key $EC2_INSTANCE_KEY --block-device-mapping "/dev/sda1=:150:true" --instance-initiated-shutdown-behavior stop --user-data-file instance_installs ami-020f3d76)

INSTANCE_NAME=$(echo ${EC2_RUN_RESULT} | sed 's/RESERVATION.*INSTANCE //' | sed 's/ .*//')

times=0
echo
while [ 5 -gt $times ] && ! ec2-describe-instances $INSTANCE_NAME | grep -q "running"
do
  times=$(( $times + 1 ))
  echo Attempt $times at verifying $INSTANCE_NAME is running...
done

echo

if [ 5 -eq $times ]; then
  echo Instance $INSTANCE_NAME is not running. Exiting...
  exit
fi

ec2-associate-address $IP_ADDRESS -i $INSTANCE_NAME

#tag it
if [ $# -eq 1 ]
then
  ec2-create-tags $INSTANCE_NAME --tag node_number=$1
fi
echo
echo Instance $INSTANCE_NAME has been created and assigned static IP Address $IP_ADDRESS
echo
echo "Instance initialised and running"
# Since the server signature changes each time, remove the server's entry from ~/.ssh/known_hosts
# Maybe you don't need to do this if you're using a Reserved Instance?
ssh-keygen -R $IP_ADDRESS
# SSH into my BRAND NEW EC2 INSTANCE! WooHoo!!!
ssh -i $HOME/$EC2_INSTANCE_KEY.pem ubuntu@$IP_ADDRESS
# start the process!!!
#ssh ubuntu@$IP_ADDRESS "cd /home/ubuntu/convert/ec2automation/;./downloadandconvert &" 
