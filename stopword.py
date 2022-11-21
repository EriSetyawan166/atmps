import mysql.connector
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
stop_factory = StopWordRemoverFactory()
stopword = stop_factory.create_stop_word_remover()



mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="social_media"
)

temp = []
mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM tweet2")
myresult = mycursor.fetchall()
# for x in myresult:
    
    # hasil = stemmer.stem(str(x))
    # print(hasil)
    

sql = "DELETE FROM tweet2"
mycursor.execute(sql)
mydb.commit()



for x in myresult:
    hasil = stopword.remove(str(x[1]))
    mycursor.execute("INSERT INTO tweet2 (user_screen_name, text) VALUES (%s, %s)", (x[0], hasil))
    mydb.commit()

# stopword.remove(kalimat)

    

