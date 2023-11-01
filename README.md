
### Auto search by Google API
- First create laravel project 

- Set up Google API's
    - Go to console cloud platform
    - Go to product library where you see lots of services
    - Then enable `Maps javascript Api` and `Places API`
    - Create you google maps api key
        - Go to google maps cloud platform and generate your api key
        - But if you are getting any issue while manage google maps api then need to save you payment information waht you see 

- Created a resource full controller 

- I have created a virtual host URL as `auto-search`,  because I am running Docker on my laptop. 
    - if not in your system then remove from .env file and user `localhost` url


- Create a Index file to display 

- Create 2 route for auto search and save data but home ('/') is working 
    - and 2nd to `save-location` is not implemented I have left `dd()` here please check care fully

- Then implement code to auto search functionlity 
    - These is 2 function I have implemented
    - 1st is single search then set value in self input field
    - 2nd is auto search as per task details to set/append value into these input fields:
        - address, city, state, country, and postal_code (zip)
        - If postal_code is not coming in data object then I have set static "123456" into the input field, and if postal_code comes then it will be set automatically please charefully
