from collections import Counter
import mysql.connector
import pandas as pd
import os
# import matplotlib.pyplot as plt
# os.remove("wordcloud_negatif.png")

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="social_media"
)

text = []
sentiment = []

mycursor = mydb.cursor()

mycursor.execute("SELECT * FROM Tweet3 where sentiment != 2")
myresult = mycursor.fetchall()

for tweet in myresult:
    text.append(tweet[3])
    sentiment.append(tweet[4])

# print(sentiment)

dict = {'text': text, 'sentiment':sentiment}
df = pd.DataFrame(dict)
df

count1 = Counter(" ".join(df[df['sentiment']== 1]['text']).\
                 split()).most_common(20)
df1 = pd.DataFrame.from_dict(count1)
df1 = df1.rename(columns={0: "teks", 1 : "jumlah"})


output = df1.head()
hasil = output.plot.bar(x='teks', y='jumlah', rot=0)
hasil.figure.savefig('sering2.png')

# print(output)
# print(text)