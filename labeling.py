import joblib
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
import matplotlib.pyplot as plt
import numpy as np
import sys
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="social_media"
)

#memuat model
model = joblib.load("model.ict")
cv = joblib.load('cv.ict')


mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM tweet3")
myresult = mycursor.fetchall()
for x in myresult:
    text = x[3]
    temp = cv.transform([text])
    res = model.predict(temp)
    akurasi = model.predict_proba(temp) 
    if(res==0):
        hasil = 0
    else:
        hasil = 1
    
    mycursor.execute("UPDATE tweet3 set sentiment=%s WHERE id = %s", (hasil, x[0]))

    # print("Kalimat = " + text)
    # print("Hasil prediksi: " + hasil + "\n")

#prediksi inputan menggunakan model yang ada
mydb.commit()

# #hasil


# if(res==0):
#     hasil = "Negatif"
# else:
#     hasil = "Positif"

# print("Kalimat = " + kalimat)
# print("Hasil prediksi: " + hasil)

# positif = akurasi[0][1]
# negatif = akurasi[0][0]

# print("probabilitas negatif= {ps:.2f}%".format(ps=negatif*100))
# print("probabilitas positif= {ps:.2f}%".format(ps=positif*100))

# #membuat visualisasi pie chart
# y = np.array([positif, negatif])
# mylabels = ["Positif", "Negatif"]
# mycolors = ["green", "red"]

# myexplode = [0.2, 0]

# def make_autopct(values):
#     def my_autopct(pct):
#         total = sum(values)
#         return '{p:.2f}%'.format(p=pct)
#     return my_autopct

# plt.pie(y, labels = mylabels, colors=mycolors, autopct=make_autopct(y), explode=myexplode)
# plt.savefig('testing.png',bbox_inches='tight')
