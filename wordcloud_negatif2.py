import mysql.connector
import os
import pandas as pd
from wordcloud import WordCloud
import matplotlib.pyplot as plt

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

plt.figure(figsize = (15,15))
wc = WordCloud(width = 1000 , height = 400 , max_words = 3000, colormap='Reds').generate(" ".join(df[df.sentiment == 0].text))
# plt.tight_layout(pad=0)
plt.imshow(wc , interpolation = 'bilinear')
plt.savefig('wordcloud_negatif2.png',bbox_inches='tight')

