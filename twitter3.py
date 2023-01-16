import tweepy
import sys
import mysql.connector
from datetime import datetime, timedelta, timezone
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory

consumer_key = 'SwdcgILvEZaWRyK0IMT2DdAxe'
consumer_secret = '6waeB6lxCtJExj2wtTgjZT0WX5qOrv9DN1Vm6ET86BHRqc1rYA6'
access_token = '802299183709372416-mDKPckyQg442t4tFhnZoVytmSmJKwjx'
access_secret = 'CgVg6kco3ftvgJANoalsr1jGJA4KeYExqsuiPbIjxb7Vu'
tweetsPerQry = 10
maxTweets = 200
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
mycursor = mydb.cursor()
newTweets = tweepy.Cursor(api.search_tweets, q=hashtag).items(maxTweets)
newTweets = [x for x in newTweets]

# while tweetCount < maxTweets:
#     if(maxId <= 0):
#         newTweets = api.search_tweets(q=hashtag, count=tweetsPerQry, result_type="recent", tweet_mode="extended")
#     else:
#         newTweets = api.search_tweets(q=hashtag, count=tweetsPerQry, max_id=str(maxId - 1), result_type="recent", tweet_mode="extended")

#     if not newTweets:
#         print("Tweet Habis")
#         break
total = 0
val = []
for tweet in newTweets:
    text = tweet.text
    user_screen_name = tweet.user.screen_name
    tweet_tuple = (
        user_screen_name,
        text
    ) 
    query = "SELECT * FROM tweet3 WHERE text=%s"
    mycursor.execute(query, (text,))

    x = [i for i in mycursor]

    if x == []:
        # print(str(id)+":"+str(text)+"\n\n")
        val.append(tweet_tuple)
    # total+=1

# print("Total tweet yang berhasil di dapatkan : " + str(total))









sql = '''
    INSERT INTO tweet3 (user_screen_name, text) 
    VALUES (%s,%s)
'''
mycursor.executemany(sql, val)
mydb.commit()
tweetCount += len(newTweets)	
maxId = newTweets[-1].id

    # factory = StemmerFactory()
    # stemmer = factory.create_stemmer()

    # stop_factory = StopWordRemoverFactory()
    # stopword = stop_factory.create_stop_word_remover()

    # temp = []
    # mycursor = mydb.cursor()
    # mycursor.execute("SELECT * FROM tweet2")
    # myresult = mycursor.fetchall()
    
    # sql = "DELETE FROM tweet2"
    # mycursor.execute(sql)
    # mydb.commit()

    # for x in myresult:
    #     #stemming
    #     hasil = stemmer.stem(str(x[2]))

    #     #stopword
    #     hasil_stop = stopword.remove(hasil)

    #     mycursor.execute("INSERT INTO tweet2 (user_screen_name, text) VALUES (%s, %s)", (x[1], hasil_stop))
    #     mydb.commit()



    