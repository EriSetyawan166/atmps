import tweepy
import sys
import mysql.connector
from datetime import datetime, timedelta, timezone
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory

consumer_key = 'prtMkWR1urcFryQlZiHirvZsz'
consumer_secret = 'SsZQUhxfpww5dvmezkK8tYaVJk4k8uafXF5kXg03zhlCqd8cJq'
access_token = '1203340032330715136-ykATveLYSYYGzGAah3kLCxygdz4y4T'
access_secret = 'c4Sc68bEAbZR7q2JGlcaJJRA6HDgFSn4l3Rym49grl3b8'
tweetsPerQry = 10
maxTweets = 200
for arg in sys.argv:
    print(arg)
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
newTweets = tweepy.Cursor(api.search_tweets, q=hashtag, tweet_mode="extended").items(maxTweets)

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
    if 'retweeted_status' in dir(tweet):
        text = tweet.retweeted_status.full_text
    else:
        text = tweet.full_text
    user_screen_name = tweet.user.screen_name
    tweet_tuple = (
        user_screen_name,
        text
    ) 
    query = "SELECT * FROM tweet2 WHERE text=%s"
    mycursor.execute(query, (text,))

    x = [i for i in mycursor]

    if x == []:
        # print(str(id)+":"+str(text)+"\n\n")
        val.append(tweet_tuple)
    # total+=1

# print("Total tweet yang berhasil di dapatkan : " + str(total))









sql = '''
    INSERT INTO tweet2 (user_screen_name, text) 
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



    