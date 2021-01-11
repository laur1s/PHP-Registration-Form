#Create a ubuntu base image with python 3 installed.
FROM python:3

#Set the working directory
WORKDIR /usr/src/app

#Install the dependencies
RUN apt-get -y update
# RUN pip3 install Flask Flask-MySql PyMySQL Flask-cors

COPY . /usr/src/app

RUN pip install -r requirements.txt

#Expose the required port
EXPOSE 5000

CMD python main.py