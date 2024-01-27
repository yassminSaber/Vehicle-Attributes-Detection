# your code goes herefrom flask import Flask, request, render_template
import pymysql
import mysql.connector
import shutil
from roboflow import Roboflow
from ultralytics import YOLO
import matplotlib.pyplot as plt
import numpy as np

class violation:
    def retrieve_governmentdata():
    # Connect to the database
        connection = mysql.connector.connect(
        host='localhost',
        user='root',
        password='123',
        database='vehicledetection'
    )

    # Create a cursor object to execute SQL queries
        cursor = connection.cursor()

        # Select the attributes from the table
        query = "SELECT platenumber, color FROM governmentdata"
        cursor.execute(query)

        # Fetch the data
        attributes = []
        for row in cursor.fetchall():
            platenumber, color = row
            attributes.append({"platenumber": platenumber, "color": color})
        #print(attributes)
        # Close the cursor and the database connection
        cursor.close()
        connection.close()
        return attributes 
    def getGovernmentData(platenumber: str):
        # Connect to the database
        connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='123',
            database='vehicledetection'
        )
        # Create a cursor object to execute SQL queries
        cursor = connection.cursor()
        # Select the attributes from the table where platenumber matches the given value
        query = "SELECT nationalID, color, platenumber FROM governmentdata WHERE platenumber = %s"
        cursor.execute(query, (platenumber,))

        # Fetch the data
        attributes = []
        for row in cursor.fetchall():
            nationalID, color, platenumber = row
            attributes.append(nationalID)
            attributes.append(color)
            attributes.append(platenumber)
        #print(attributes)

        # Close the cursor and the database connection
        cursor.close()
        connection.close()
        return attributes

    def giveTrafficViolation(array_of_arrays):
        platenumbers = []
        for i, sub_array in enumerate(array_of_arrays):
            if len(sub_array) >= 4:
                platenumbers.append((sub_array[3], i))  # Store the plate number and its index

        # Establish a connection to the MySQL database
        db_connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='123',
            database='vehicledetection'
        )
        cursor = db_connection.cursor()

        # Prepare the SQL query to insert the data
        insert_query = "INSERT INTO violation (PlatNumber, Violation, nationalID, Price) VALUES (%s, %s, %s, %s)"
        last_video = violation.getLastVideo()

        # Collect the values for insertion
        insert_values = []

        # Iterate over the data and collect the values
        for plateNumber, i in platenumbers:
            if plateNumber == '\u0661':
                print("No violation can be taken for this vehicle")
                continue  # Skip this iteration if plateNumber is '١'

            vehicle = violation.getGovernmentData(plateNumber)
            values = []  # Initialize values as a list

            if array_of_arrays[i][0] == "smash":
                pv_violation = violation.getViolation(platNumber=plateNumber, violation="vehicle damaged")
                if not pv_violation:
                    values.append((plateNumber, "vehicle damaged", vehicle[0], 300))

            if vehicle and vehicle[1] != array_of_arrays[i][1]:
                pv_violation = violation.getViolation(platNumber=plateNumber, violation="Color changed")
                if not pv_violation:
                    values.append((plateNumber, 'Color changed', vehicle[0], 1000))

            if vehicle and array_of_arrays[i][2] != last_video[1]:
                print(array_of_arrays[i][2])
                pv_violation = violation.getViolation(platNumber=plateNumber, violation="wrong Type")
                if not pv_violation:
                    values.append((plateNumber, 'wrong Type', vehicle[0], 500))
            print('array_of_arrays[i][4]:', array_of_arrays[i][4])
            print('last_video[6]:', last_video[6])
            if vehicle and len(vehicle) > 0 and array_of_arrays[i][4] > last_video[6]:
                pv_violation = violation.getViolation(platNumber=plateNumber, violation="Speed Limit")
                if not pv_violation:
                    values.append((plateNumber, 'speed exceeded', vehicle[0], 500))

            if values:  # Check if values list is not empty
                insert_values.extend(values)

        # Execute the query and insert all the collected values
        cursor.executemany(insert_query, insert_values)
        db_connection.commit()

        # Close the database connection
        cursor.close()
        db_connection.close()
        return array_of_arrays


    def getLastVideo():
        db_connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='123',
            database='vehicledetection'
        )
        cursor = db_connection.cursor()

        query = "SELECT * FROM video ORDER BY date DESC, time DESC LIMIT 1;"
        cursor.execute(query)

        last_video = cursor.fetchone()

        cursor.close()
        db_connection.close()
        
        return last_video

    def getViolation(platNumber, violation):
        connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='123',
            database='vehicledetection'
        )
        # Create a cursor object to execute SQL queries
        cursor = connection.cursor()
        query = "SELECT * FROM Violation WHERE PlatNumber = %s AND Violation = %s"
        params = (platNumber, violation)

        cursor.execute(query, params)

        db_violation = cursor.fetchone()
        
        # Close the cursor and connection
        cursor.close()
        connection.close()

        return db_violation   

    def getVideoData():
        # Connect to the database
        connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='123',
            database='vehicledetection'
        )
        # Create a cursor object to execute SQL queries
        cursor = connection.cursor()
        
        query = "SELECT vehicletype, speed FROM video"
        cursor.execute(query)

        # Fetch the data
        attributes = []
        for row in cursor.fetchall():
            vehicletype, speed = row
            attributes.append({"vehicletype": vehicletype, "speed": speed})
        #print(attributes)

        # Close the cursor and the database connection
        cursor.close()
        connection.close()
        return attributes
