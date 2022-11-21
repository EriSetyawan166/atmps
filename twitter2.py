import tweepy
import sys
import mysql.connector
from datetime import datetime, timedelta, timezone
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory

consumer_key = '9hmHN42iptZPWIEneza9DFx1K'
consumer_secret = 'NYt0wAEc4Bh1dk5npOlotVzfxzvUSpw3In6IXO2NFXLIEpAHU7'
access_token = '2731103342-wzBq5KeyrtXUMLyt02pcjS43h9esXAPK9mtXfRj'
access_secret = 'Krw0cAoq7oiRTUz6wXDoLakNuEqSeNuD60es0Dc303Z0s'
tweetsPerQry = 10
maxTweets = 100
hashtag = sys.argv[1]

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="social_media"
)

authentication = tweepy.OAuthHandler(consumer_key, consumer_secret)
authentication.set_access_token(access_token, access_secret)
api = tweepy.API(authentication, wait_on_rate_limit=True)#, wait_on_rate_limit_notify=True)'
maxId = -1
tweetCount = 0
while tweetCount < maxTweets:
    if(maxId <= 0):
        newTweets = api.search_tweets(q=hashtag, count=tweetsPerQry, result_type="recent", tweet_mode="extended")
    else:
        newTweets = api.search_tweets(q=hashtag, count=tweetsPerQry, max_id=str(maxId - 1), result_type="recent", tweet_mode="extended")

    if not newTweets:
        print("Tweet Habis")
        break

    val = []
    for tweet in newTweets:
        text = tweet.full_text.encode('utf-8')
        user_screen_name = tweet.user.screen_name
        tweet_tuple = (
            user_screen_name,
            text
        ) 
    #     print(str(id)+":"+str(text)+"\n\n")
        val.append(tweet_tuple)

    mycursor = mydb.cursor()
    sql = '''
        INSERT INTO tweet2 (user_screen_name, text) 
        VALUES (%s,%s)
    '''
    mycursor.executemany(sql, val)
    mydb.commit()
    tweetCount += len(newTweets)	
    maxId = newTweets[-1].id

    factory = StemmerFactory()
    stemmer = factory.create_stemmer()

    stop_factory = StopWordRemoverFactory()
    stopword = stop_factory.create_stop_word_remover()

    temp = []
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM tweet2")
    myresult = mycursor.fetchall()
    
    sql = "DELETE FROM tweet2"
    mycursor.execute(sql)
    mydb.commit()

    for x in myresult:
        #stemming
        hasil = stemmer.stem(str(x[2]))

        #stopword
        hasil_stop = stopword.remove(hasil)

        mycursor.execute("INSERT INTO tweet2 (user_screen_name, text) VALUES (%s, %s)", (x[1], hasil_stop))
        mydb.commit()



    