import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="latihan"
)

mycursor = mydb.cursor()

#mycursor.execute("CREATE DATABASE latihan")

mycursor.execute("CREATE TABLE pegawai (nip VARCHAR(10), nama VARCHAR(255), alamat VARCHAR(255))")

sql = "INSERT INTO pegawai (nip, nama, alamat) VALUES (%s, %s, %s)"
val = ("2011501778", "ERI", "Bogor")
mycursor.execute(sql, val)
mydb.commit()

sql = "INSERT INTO pegawai (nip, nama, alamat) VALUES (%s, %s, %s)"
val = ("2011501123", "Siapa", "Jakarta")
mycursor.execute(sql, val)
mydb.commit()

sql = "INSERT INTO pegawai (nip, nama, alamat) VALUES (%s, %s, %s)"
val = ("2011501111", "Aku", "Cilacap")
mycursor.execute(sql, val)

mydb.commit()

mycursor.execute("SELECT * FROM pegawai")

myresult = mycursor.fetchall()

for x in myresult:
  print(x)

