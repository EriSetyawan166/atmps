import matplotlib.pyplot as plt
from collections import Counter
import seaborn as sns
import mysql.connector
import pandas as pd
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn import metrics
from sklearn.model_selection import train_test_split
import numpy as np
import joblib
from imblearn.over_sampling import SMOTE
from imblearn.under_sampling import RandomUnderSampler


mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="social_media"
)

#mengambil data dari database
text = []
sentiment = []
mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM Tweet2 where sentiment != 2")
myresult = mycursor.fetchall()

for tweet in myresult:
    text.append(tweet[3])
    sentiment.append(tweet[4])

dict = {'text': text, 'sentiment':sentiment}
df = pd.DataFrame(dict)

#mengubah teks string menjadi bentuk binary
cv = CountVectorizer()
text_counts = cv.fit_transform(df['text'])

#split data training dan testing
x_train, x_test, y_train, y_test= train_test_split(text_counts, df['sentiment'], test_size=0.25, random_state=5)
rus = RandomUnderSampler(random_state=42)
x_train_resampled, y_train_resampled = rus.fit_resample(x_train, y_train)

#modeling atau training data
MNB = MultinomialNB()
model = MNB.fit(x_train_resampled, y_train_resampled)
predicted = MNB.predict(x_test)

#hasil training
akurasi = metrics.accuracy_score(predicted, y_test)
print("Akurasi = " + str(akurasi))

Recall = metrics.recall_score(predicted, y_test)
print("Recall = " + str(Recall))

Presicion = metrics.precision_score(predicted, y_test)
print("Presicion = " + str(Presicion))

f_measure = metrics.f1_score(y_test, predicted)
print("F-measure = " + str(f_measure))



# # jumlah data sebelum undersampling
# print("Jumlah data sebelum undersampling: ", Counter(y_train))

# # jumlah data sesudah undersampling
# print("Jumlah data sesudah undersampling: ", Counter(y_train_resampled))

#menyimpan model
filename = 'model.ict'
joblib.dump(model, filename)
joblib.dump(cv, "cv.ict ")


