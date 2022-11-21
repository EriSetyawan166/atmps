import tweepy
import sys
import mysql.connector
from datetime import datetime, timedelta, timezone

consumer_key = 'AoghTU998Tv49kU4YIJF95dP5'
consumer_secret = 'aacT6ZwgQT9Bw3gZHdwunsJrcFY7DeK7HZgmPVR9zNRKqj7oms'
access_token = '2731103342-jEVVQd8S3Z6oJr3cE2jEi1Ys1j4jE2c9PqyPFDs'
access_secret = 'enNeRpgDWUaPihhQcVQA7E2GXEkf0ByhIiIkvLFuY7UvL'
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
        id = tweet.id
        id = str(id)
        created_at = tweet.created_at
        local_created_at = created_at.replace(tzinfo=timezone.utc).astimezone(tz=None)
        text = tweet.full_text.encode('utf-8')
        feeds_image = None
        feeds_video = None
        feeds_link = 'https://twitter.com/_/status/'+id
        source = tweet.source
        in_reply_to_status_id = tweet.in_reply_to_status_id_str
        in_reply_to_user_id = tweet.in_reply_to_user_id_str
        in_reply_to_screen_name = tweet.in_reply_to_screen_name
        username = tweet.user.name
        user_screen_name = tweet.user.screen_name
        user_location = tweet.user.location
        user_url = tweet.user.url
        user_description = tweet.user.description
        user_verified_str = tweet.user.verified
        user_verified = 0
        if user_verified_str == True:
            user_verified = 1
        user_followers_count = tweet.user.followers_count
        user_friends_count = tweet.user.friends_count
        user_listed_count = tweet.user.listed_count
        user_favourites_count = tweet.user.favourites_count
        user_created_at = tweet.user.created_at
        user_id = tweet.user.id
        user_profile_image_url_https = tweet.user.profile_image_url_https
        if tweet.coordinates == True:
            coordinates_lat = tweet.coordinates.coordinates[0]
            coordinates_lon = tweet.coordinates.coordinates[1]
        else:
            coordinates_lat = None
            coordinates_lon = None
                    
        if tweet.place == True:
            place_country = tweet.place.country
            place_country_code = tweet.place.country_code
            place_full_name = tweet.place.full_name
            place_id = tweet.place.id
            place_type = tweet.place.type
        else:
            place_country = None
            place_country_code = None
            place_full_name = None
            place_id = None
            place_type = None

        if tweet.is_quote_status == True:
            quoted_status_id = tweet.quoted_status_id
            quote_count = 0
        else:
            quoted_status_id = None
            quote_count = 0
            retweeted_status = None
        try:
            reply_count = tweet.reply_count
        except:
            reply_count = 0
        retweet_count = tweet.retweet_count
        favorite_count = tweet.favorite_count
        retweeted_txt = tweet.retweeted
        entities = str(tweet.entities)
        retweeted = 0
        if retweeted_txt == True:
            retweeeted = 1
        lang = tweet.lang
        tweet_tuple = (
            hashtag,
            created_at,
            id,
            text,
            source,
            in_reply_to_status_id,
            in_reply_to_user_id,
            in_reply_to_screen_name,
            username,
            user_screen_name,
            user_location,
            user_url,
            user_description,
            user_verified,
            user_followers_count,
            user_friends_count,
            user_listed_count,
            user_favourites_count,
            user_created_at,
            user_id,
            user_profile_image_url_https,
            coordinates_lat,
            coordinates_lon,
            place_country,
            place_country_code,
            place_full_name,
            place_id,
            place_type,
            quoted_status_id,
            retweeted_status,
            quote_count,
            reply_count,
            retweet_count,
            favorite_count,
            retweeted,
            entities,
            lang,
            feeds_link,
            feeds_video,
            feeds_image
        ) 
        print(str(id)+":"+str(text)+"\n\n")
        val.append(tweet_tuple)

    mycursor = mydb.cursor()
    sql = '''
        INSERT INTO tweet (search_val, created_at, tweet_id, text, source, in_reply_to_status_id, in_reply_to_user_id,
        in_reply_to_screen_name, user_name, user_screen_name, user_location, user_url, user_description, user_verified,
        user_followers_count, user_friends_count, user_listed_count, user_favourites_count, user_created_at, user_id,
        user_profile_image_url_https, coordinates_lat, coordinates_lon, place_country, place_country_code, place_full_name,
        place_id, place_type, quoted_status_id, retweeted_status, quote_count, reply_count, retweet_count, 
        favorite_count, retweeted, entities, lang, feeds_link, feeds_video, feeds_image) 
        VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,
        %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,
        %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,
        %s,%s,%s,%s,%s,%s,%s,%s,%s,%s
        )
    '''
    mycursor.executemany(sql, val)
    mydb.commit()
    tweetCount += len(newTweets)	
    maxId = newTweets[-1].id
