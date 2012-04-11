#!/bin/sh
LOGFILE=encodemp4ize.log
#echo '' > $LOGFILE
for f in ./flvs/*
do
        echo "-----------" >> $LOGFILE
	echo $f >> $LOGFILE
	ffmpeg -i $f -b 800k ./mp4s/`basename $f .flv`.mp4
done
