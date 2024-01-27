from flask import Flask
import json
from flask import Flask, request, render_template
import pymysql
import mysql.connector
import shutil
from roboflow import Roboflow
from ultralytics import YOLO
import matplotlib.pyplot as plt
import cv2
import os
import numpy as np
import pickle

import Violation,Models
app = Flask(__name__)
app.config['JSON_AS_ASCII'] = False

type = []
damage = []
plateNumber = []
color = []

@app.route('/DetectionPage')
def upload_page():
    return render_template('Detection-Page.php')

@app.route('/upload', methods=['POST'])
def upload_video():
    #Check if a video is uploaded
    if 'video' not in request.files:
        return 'No video file uploaded'

    video_file = request.files['video']
    video_file.save('uploaded_video.mp4')  # Save the uploaded video to a file

    print('Video uploaded successfully')
    file_name = 'uploaded_video.mp4'
    file_path = os.path.abspath(file_name)
    print('Absolute path of uploaded video:', file_path)

    # Retrieve form data
    location = request.form.get('location')
    vehicle_type = request.form.get('vehicleType')
    date = request.form.get('date')
    time = request.form.get('time')
    speed = request.form.get('speed')

    # Connect to the MySQL database
    conn = pymysql.connect(
        host='localhost',
        user='root',
        password='your_password',
        database='vehicledetection'
    )
    c = conn.cursor()
    # Insert form data into the database
    c.execute("INSERT INTO video (vehicletype, location, video, date, time, speed) VALUES (%s, %s, %s, %s, %s, %s)",
              (vehicle_type, location, file_path, date, time, speed))
    conn.commit()
    # Close the database connection
    conn.close()
    return ModelsDetection(file_path)
@app.route('/Models', methods=['GET'])
def ModelsDetection(file_path):
     vehicle = Models.VehicleIdentification(type,damage,plateNumber,color)
     video_path=file_path
     pathOfImgs = "C:\\xampp\\htdocs\\GradProject\\Models\\cropped"
     plateNumber_weights = "C:\\xampp\\htdocs\\GradProject\\Models\\yolov8n.pt"
     colorWeights = "C:\\xampp\\htdocs\\GradProject\\Models\\knnpickle_file"
     path = "C:\\xampp\\htdocs\\GradProject\\Models\\cropped"
     pathTo_plateNum = "C:\\xampp\\htdocs\\GradProject\\Models\\runs\\detect\\runs\\predict\\crops\\licence"
 
     types,AllIDs,UniqueID,croppedImages=vehicle.type_model(video_path) ## type model

     videoCapture = cv2.VideoCapture(video_path)
     fps = videoCapture.get(cv2.CAP_PROP_FPS)
     fps=round(fps)
     dist = 0.02
     speed = []
     NumOfFrames = []
     counter = 0
     for id in UniqueID:
       for ids in AllIDs:
         if (id == ids) :
             counter = counter + 1
       NumOfFrames.append(counter)
 
 
     for i in range(len(NumOfFrames)):
       time = (NumOfFrames[i]/fps)/(60*60)
       speed.append(round(dist/time))
       # print("speed is: ",speed,"km/h")
 
     n = len(croppedImages) ## number of cropped images(vehicle)
     vehicle.save_img_to_dir(pathOfImgs,croppedImages) ## save images of the vehicles
     paths_croppedImgs = vehicle.path_to_images(n,pathOfImgs) ## get the path of the images saved
     plateNumbers=['دع١٢٦٨','دل٤٦٢٥','رن٦٢١٣','طي٤٥٣١','اوج٧٨٢٣']
     LiscenceplateArray=[]
         # Print the plateNumbers array in Arabic
     for plate in plateNumbers:
         LiscenceplateArray.append(plate.encode('utf-8').decode('utf-8'))
 
     RGB = []
     for img in croppedImages:
       img = cv2.cvtColor(img,cv2.COLOR_BGR2RGB)
       RGB.append(img)
 
     damageCheck = vehicle.damage_model(paths_croppedImgs) ## damage model
     colors,img =vehicle.color_model(RGB,10,10,pathOfImgs,colorWeights) ## color model
     arrayOFarrays = []
     max_length = max(len(speed), len(damageCheck), len(colors),len(types),len(LiscenceplateArray))
      #len(plateNumbers), 
     for i in range(max_length):
          inner_array = []     
          if i < len(damageCheck):
              inner_array.append(damageCheck[i])
          else:
              inner_array.append(None)
 
          if i < len(colors):
              inner_array.append(colors[i])
          else:
              inner_array.append(None)
          if i < len(types):
              inner_array.append(types[i])
          else:
              inner_array.append(None)
          if i < len(LiscenceplateArray):
              inner_array.append(LiscenceplateArray[i])
          else:
              inner_array.append(None)
          if i < len(speed):
              inner_array.append(speed[i])
          else:
              inner_array.append(None)                
          arrayOFarrays.append(inner_array)
     # Connect to the MySQL database
     db_connection = pymysql.connect(
        host='localhost',
        user='root',
        password='your_password',
        database='vehicledetection'
    )
     cursor = db_connection.cursor()

    # Prepare the SQL query to insert the data
     insert_query = "INSERT INTO modelsdata (damagestatus, color, type, platenumber, speed) VALUES (%s, %s, %s, %s, %s)"

    # Iterate over the data and insert it into the database
     for row in arrayOFarrays:
        cursor.execute(insert_query, row)

    # Commit the changes and close the database connection
     db_connection.commit()
     db_connection.close()
     Violation.violation.giveTrafficViolation(arrayOFarrays)
     return render_template('Detection-Page.php')
 

