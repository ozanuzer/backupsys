import mysql.connector as mysql
import os, uuid, ftplib, sys
from os.path import join, dirname
from datetime import datetime
from dotenv import load_dotenv
dotenv_path = join(dirname(__file__), '../../.env')
config = load_dotenv(dotenv_path)
#print(os.environ.get("DB_DATABASE"))
print('Please wait while the program is loading...')
db = mysql.connect(
    host = os.environ.get("DB_HOST"),
    user = os.environ.get("DB_USERNAME"),
    passwd = os.environ.get("DB_PASSWORD"),
    database = os.environ.get("DB_DATABASE")
)
cursor = db.cursor()
query = "SELECT * FROM queue WHERE locked = 0 LIMIT 1"
cursor.execute(query)
queue = cursor.fetchone()
if queue is None:
    print('queue empty')
    query = "SELECT COUNT(*) FROM queue LIMIT 1"
    cursor.execute(query)
    queuecount = cursor.fetchone()
    if queuecount[0] == 0:
        os.system('rm -Rf /tmp/backupsys/*')
    exit()

query = "UPDATE queue SET locked = 1 WHERE id = %s"
bind = (queue[0], )
cursor.execute(query, bind)
db.commit()
now = datetime.now() # current date and time

periodStr = ''
if queue[14] == 0:
    periodStr = 'daily'
elif queue[14] == 1:
    periodStr = 'weekly'
if queue[14] == 2:
    periodStr = 'monthly'
if queue[5] == 1 or queue[5] == 2:
    os.system('rm -Rf '+queue[13]+'/*')
    query = "SELECT * FROM database_users WHERE hid = %s"
    bind = (queue[2], )
    cursor.execute(query, bind)
    databases = cursor.fetchall()
    for database in databases:
        print(database)
        if (database[2] == 'no' or database[3] == 'no'):
            os.system('mysqldump '+database[4]+' > '+queue[13]+'/'+database[4]+'-'+uuid.uuid4().hex[:6].upper()+'-'+now.strftime("%m-%d-%Y-%H-%M-%S")+'.sql')
        else:
            os.system('mysqldump -u'+database[2]+' -p'+database[3]+' '+database[4]+' > '+queue[13]+'/'+database[4]+'-'+uuid.uuid4().hex[:6].upper()+'-'+now.strftime("%m-%d-%Y-%H-%M-%S")+'.sql')
os.system('mkdir -p /tmp/backupsys/'+str(queue[0]))
if queue[5] != 1:
    os.system('tar -czvf /tmp/backupsys/'+str(queue[0])+'/'+queue[3]+'-'+uuid.uuid4().hex[:6].upper()+'-'+now.strftime("%m-%d-%Y-%H-%M-%S")+'.tar.gz '+queue[12])
os.system('tar -czvf /tmp/backupsys/'+str(queue[0])+'/databases-'+uuid.uuid4().hex[:6].upper()+'-'+now.strftime("%m-%d-%Y-%H-%M-%S")+'.tar.gz '+queue[13])
if queue[11] == 'ftp':
    myFTP = ftplib.FTP()
    myFTP.connect(queue[6], int(queue[10]))
    myFTP.login(queue[7], queue[8])
    try:
        myFTP.mkd(queue[9]+'/'+now.strftime("%m-%d-%Y")+'-'+periodStr)
        myFTP.cwd(queue[9]+'/'+now.strftime("%m-%d-%Y")+'-'+periodStr)
    except:
        e = sys.exc_info()[0]
        print( "<p>Error: %s</p>" % e )
    #myFTP = ftplib.FTP(queue[6], queue[7], queue[8])
    myPath = r'/tmp/backupsys/'+str(queue[0])
    def uploadThis(path):
        files = os.listdir(path)
        os.chdir(path)
        for f in files:
            if os.path.isfile(f):
                fh = open(f, 'rb')
                myFTP.storbinary('STOR %s' % queue[9]+'/'+now.strftime("%m-%d-%Y")+'-'+periodStr+'/'+f, fh)
                fh.close()
            elif os.path.isdir(f):
                myFTP.mkd(f)
                myFTP.cwd(f)
                uploadThis(f)
        myFTP.cwd('..')
        os.chdir('..')
    uploadThis(myPath) 
print(queue[5])

os.system('rm -Rf /tmp/backupsys/'+str(queue[0]))

query = "DELETE FROM queue WHERE id = %s"
bind = (queue[0], )
cursor.execute(query, bind)
db.commit()