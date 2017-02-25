# Response Map

The response map is an LTI tool that allows students to respond to a question or give feedback and have the responses show up on a world map based on the location that they enter in. All the response are also processed and turned into a word cloud at the bottom of the map. Students can also upload an image along with their response.

## Requirements
You will need have an Apache HTTP server which is configured to serve PHP files and have a MySQL database configured to store student details and responses.

## Installation
First, you must edit config.example.php to contain the appropriate MySQL credentials and Google Maps API key and save the file as config.php.

Then, you must specify and LTI key and secret in lti.php.

Images are uploaded to the files folder which needs the following upload permissions:
```
chown apache:apache -R files/
chmod 755 -R files/
```

Within your course in edX Studio, the LTI module must be enabled in order to create LTI components. This can be done by going to Settings > Advanced Settings and adding ```"lti"``` to the array.

Also under Advanced Settings, the LTI Passports array must contain the LTI key and secret pair that is used by the tool. You must add it to the array in the following format: ```"passport_id:key:secret"```. The id is later used when configuring the LTI component to obtain the key and secret.

Next, create the LTI component within a course unit (under Add New Component > Advanced > LTI) and click on "Edit". Make sure to enter in the the LTI ID that you have previously set in LTI Passport. Specify the url to the tool (make sure you have a closing slash) and turn off opening in a new page for a seamless look. If you would like to give a student a partipation mark for responding to the response-map, then set the "Scored" attribute to true.

## Workflow
<img src="https://github.com/UQ-UQx/response-map/blob/master/README_WORKFLOW_IMAGE.png?raw=true">

##License
This project is licensed under the terms of the MIT license.

##Contact
The best contact point apart from opening github issues or comments is to email technical@uqx.uq.edu.au
