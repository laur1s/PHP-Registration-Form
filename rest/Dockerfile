#Create a ubuntu base image with python 3 installed.
FROM python:3

#Set the working directory
WORKDIR /usr/src/app

#Install the dependencies
RUN apt-get -y update
RUN pip3 install -r Flask

#Expose the required port
EXPOSE 8081

#Run the command
# CMD ["python3", "./api/app.py"]