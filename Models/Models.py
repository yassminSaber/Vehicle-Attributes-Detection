# your code goes herefrom flask import Flask, request, render_template
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

def create_directory(path):
    if os.path.exists(path):
        shutil.rmtree(path)  # Delete the directory if it exists
    os.makedirs(path)  # Create the directory
class VehicleIdentification:
  def __init__(self, type, damage, plateNumber,color  ):
    self.type = type
    self.damage = damage
    self.plateNumber = plateNumber
    self.color = color
 ## return vehicle id , type,and cropped image of vehicle
  def type_model(self,video_path): ## video_path : the main viedo path
    trackerID = []
    types=[]
    cropped_images = []
    unique_ID = []
    unique_classID = []
    unique_croppedImgs = []
 
    model = YOLO('yolov8n.pt')
    results = model.track(source = video_path , conf = 0.5 , show=True , classes = [2,3,4,6,8],verbose = False,save =True)
 
    for i, r in enumerate(results):
      for index, box in enumerate(r.boxes):
          vehicleID = box.id
          Data = box.data.cpu().numpy()
          if (Data[0][2] >= 550):
            ID = box.id
            classID = box.cls
            trackerID.append(ID)
            types.append(classID)
            ## crop part
            image = r.orig_img
            xmin = int(Data[0][0])
            ymin = int(Data[0][1])
            xmax = int(Data[0][2])
            ymax = int(Data[0][3])
            cropped_images.append(image[ymin: ymax , xmin:xmax ])
    for i in range(len(trackerID)):
      if(trackerID[i] not in unique_ID):
        if(trackerID[i] is not None):
          unique_ID.append(trackerID[i])
          unique_classID.append(types[i])
          img = cropped_images[i]
          RGB_cropped =  cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
          unique_croppedImgs.append(RGB_cropped)
 
    for i, item in enumerate(unique_classID):
      if unique_classID[i] == 2:
        unique_classID[i] = "car"
      if unique_classID[i] == 3:
        unique_classID[i] = "motorcycle"
      if unique_classID[i] == 4:
        unique_classID[i] = "bus"
      if unique_classID[i] == 6:
        unique_classID[i] = "train"
      if unique_classID[i] == 8:
        unique_classID[i] = "truck"
 
    return unique_classID, trackerID,unique_ID ,unique_croppedImgs
 
 
  ## save the cropped images to a dirctory
  def save_img_to_dir(self,dir_path,listOfImages): ## dir_path : directory will be created to save the images in it , listOfImages: cropped mages from type model
    create_directory(dir_path)
    i = 1
    for img in listOfImages:
      img = cv2.cvtColor(img,cv2.COLOR_BGR2RGB)
      cv2.imwrite(dir_path+"/img"+str(i)+".jpg",img)
      i = i+1
 
 
  ## return the correct sequence of image paths
  def path_to_images(self,numOfImgs,dir): ## numOfImgs : number of images extracted from type model , dir : the directory that the images saved in
 
    paths = []
    for i in range(numOfImgs):
      paths.append(dir+"/img"+str(i+1)+".jpg")
    return paths
 
 
  # return the damage status for each vehicle (list)
  def damage_model(self,pathOfImgs):
    predections = []
    imgs_path = []
    jsonResults = []
    damage_result=[]
 
    rf = Roboflow(api_key="bfrzVdmWOf1qUeu5K6eo")
    project = rf.workspace().project("damage-type-nogzj")
    model = project.version(2).model
 
    for img in pathOfImgs:
      jsonResults.append(model.predict(img).json())
 
    for i in range(len(jsonResults)):
      list = jsonResults[i]['predictions']
      if len(list) == 0 :
        damage_result.append("no damage")
      else:
        damage_result.append(jsonResults[i]['predictions'][0]["class"])
 
    return damage_result
 
  ## detect and exctract plate number from each vehicle image (list)
  def plateNumber_model1(self,numOfImages, model_weight):
    # Predict on the image file
    result = []
    # n = len(image_file)
    model = YOLO(model_weight)
    for img in numOfImages:
      result.append(model.predict(img, imgsz=320, conf=0.3, save_crop=True,verbose = True))
 
    return result
 
  ## use the plate number results from the previous model to detect letters and numbers of the plate (2D list)
  ## each row represents a plate number
  def plateNumber_model2(self,folder_path):
      image_results = []
      plateNumbers =[]
      class_mapping = {
          '0': 'أ','1': 'ب','2': 'ت','3': 'د','4': 'ر','5': 'س',
          '6': 'ص','7': 'ط', '8': 'ع', '9': 'ف','10': 'ق',
          '11': 'ل','12': 'م','13': 'ن','14': 'ه','15': 'و',
          '16': 'ى','18': '١','19': '٢','20': '٣','21': '٤',
          '22': '٥','23': '٦','24': '٧','25': '٨','26': '٩'
      }
 
      rf = Roboflow(api_key="HQmVPGlDqljH8mic5I9b")
      project = rf.workspace().project("char3")
      model = project.version(1).model
 
      for img in  os.listdir(folder_path):
          img = folder_path +"/"+ img
          result = model.predict(img, confidence=40, overlap=30).json()
          # Sort the predictions based on 'x' value
          sorted_predictions = sorted(result['predictions'], key=lambda x: x['x'])
          # Store image result in a dictionary
          image_result = {
              'image': img,
              'predictions': []
          }
          # Add each prediction to the image result
          for prediction in sorted_predictions:
              class_value = prediction['class']
              replaced_class = class_mapping.get(class_value, class_value)
              image_result['predictions'].append(replaced_class)
 
          # Add the image result to the list
          image_results.append(image_result)
 
 
        # Add the image result to the list
      n = len(image_results)
      for i in range(n):
          x = image_results[i]["predictions"]
          x.reverse()
          plateNumbers.append(x)
 
      return image_results,plateNumbers
 
  ## return the colors of each vehicles (list)
  ## cropx, and cropy : size of the cropped part from the vehicle image
  def color_model(self,listOfImages,cropx,cropy,path_to_imgs,path_to_weights):  ## path_to_weights : weights of color model, path_to_imgs: paths returned from path to images fn
    cropped_imgs = []
    rgb2 = []
    for img in listOfImages:
       y,x, channels = img.shape
       startx = x//2-(cropx//2)
       starty = y//2-(cropy//2)
       crop_img = img[starty:starty+cropy,startx:startx+cropx]
       crop_img_RGB = cv2.cvtColor(crop_img,cv2.COLOR_BGR2RGB)
       cropped_imgs.append(crop_img_RGB)
       rgb2.append(crop_img_RGB[5][5])
 
    np_rgb2 = np.array(rgb2)
    model = pickle.load(open(path_to_weights, 'rb'))
    predections = model.predict(np_rgb2)
    cropped_img_np = np.array(cropped_imgs)
 
    return predections,cropped_img_np
 




